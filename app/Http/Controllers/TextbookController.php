<?php

namespace App\Http\Controllers;

use App\Http\Requests\TextbookRequest;
use Illuminate\Http\Request;
use App\Models\ItemCondition;
use App\Models\Stock;
use App\Models\Textbook;
use Illuminate\Support\Facades\Auth;
use App\Models\University;
use App\Services\ImageService;
use DB;
use Illuminate\Support\Facades\Log;

class TextbookController extends Controller
{

    public function index(Request $request)
    {
        $query = Textbook::with(['university', 'faculty'])->sortOrder($request->sort);

        // キーワード検索を適用
        if ($request->filled('keyword')) {
            $query->searchKeyword($request->keyword);
        }

        // 教科書IDでフィルタリング
        if ($request->filled('textbook_id')) {
            $query->where('id', $request->textbook_id);
        }

        // ページネーションを適用
        $textbooks = $query->paginate($request->pagination ?? '10')->appends($request->query());

        // universitiesテーブルと外部キー制約であるfacultiesテーブルも同時に取得
        $universities = University::with('faculties')->get();

        return view('textbooks.index', compact('textbooks', 'universities'));
    }

    public function show(Textbook $textbook)
    {
        return view('textbooks.detail')->with('item', $textbook);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //universitiesテーブルと外部キー制約であるfacultiesテーブルも同時に取得
        $universities = University::with('faculties')->get();
        //商品の状態は sort_no の順に並べ替えられる
        $conditions = ItemCondition::orderBy('sort_no')->get();

        return view('textbooks.create', compact('universities', 'conditions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TextbookRequest $request)
    {
        $user = Auth::user();

        DB::beginTransaction();
        try {
            // 画像ファイル取得
            $imageFile = $request->textbook;
            if (!is_null($imageFile) && $imageFile->isValid()) {
                // 画像とフォルダ名を渡す
                $fileNameToStore = ImageService::upload($imageFile, 'textbooks');
                $user->image_file_name = $fileNameToStore;
            }

            $item = new Textbook();
            $item->name = $request->input('name');
            // DBに画像保存
            if (!is_null($imageFile)) {
                $item->image_file_name = $fileNameToStore;
            }
            $item->description = $request->input('description');
            $item->price = $request->input('price');
            $item->state = Textbook::STATE_SELLING;
            $item->seller_id = $user->id;
            $item->university_id = $request->input('university_id');
            $item->faculty_id = $request->input('faculty_id');
            $item->item_condition_id = $request->input('condition');

            // ここで一度アイテムを保存して、IDを取得する
            $item->save();

            // 在庫テーブルに在庫を登録する
            Stock::create([
                'textbook_id' => $item->id,
                'quantity' => 1  // 初期在庫数を1に設定
            ]);

            DB::commit();
            return redirect()->route('textbooks.create')->with(['message' => '商品を出品しました。', 'status' => 'info']);
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error during textbook creation: ' . $e->getMessage());
            return redirect()->route('textbooks.create')->with([
                'message' => '登録エラー：登録時にエラーが発生しました。少し時間をおいてから再度お試しください。',
                'status' => 'alert',
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //idに紐づく情報をtextbookテーブルから取得
        $textbook = Textbook::with(['university', 'faculty', 'condition'])->findOrFail($id);

        //universitiesテーブルと外部キー制約であるfacultiesテーブルも同時に取得
        $universities = University::with('faculties')->get();

        //商品の状態は sort_no の順に並べ替えられる
        $conditions = ItemCondition::orderBy('sort_no')->get();

        return view('textbooks.edit', compact('textbook', 'universities', 'conditions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TextbookRequest $request, string $id)
    {
        $textbook = Textbook::findOrFail($id);
        $user = Auth::user();

        DB::beginTransaction();
        try {
            //在庫数のチェック。楽観的ロック（編集中に商品が買われていないか）
            $currentStock = Stock::where('textbook_id', $textbook->id)->first();

            if ($currentStock->quantity != 1) {
                return redirect()->route('textbooks.edit', ['textbook' => $id])->with(['message' => '在庫数が変更されています。再度確認してください', 'status' => 'alert']);
            }

            // 画像ファイル取得
            $imageFile = $request->file('textbook_image');
            if (!is_null($imageFile) && $imageFile->isValid()) {
                // 画像とフォルダ名を渡す
                $fileNameToStore = ImageService::upload($imageFile, 'textbooks');
                $user->image_file_name = $fileNameToStore;
            }

            $textbook->name = $request->input('name');
            if (!is_null($imageFile)) {
                $textbook->image_file_name = $fileNameToStore;
            }
            $textbook->description = $request->input('description');
            $textbook->price = $request->input('price');
            $textbook->state = Textbook::STATE_SELLING;
            $textbook->seller_id = $user->id;
            $textbook->university_id = $request->input('university_id');
            $textbook->faculty_id = $request->input('faculty_id');
            $textbook->item_condition_id = $request->input('condition');
            $textbook->save();


            DB::commit();
            return redirect()->route('textbooks.create')->with(['message' => '商品を更新しました。', 'status' => 'info']);
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('textbooks.edit')->with([
                'message' => '登録エラー：更新時にエラーが発生しました。少し時間をおいてから再度お試しください。',
                'status' => 'alert',
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Textbook::findOrFail($id)->delete();

        return redirect()->route('textbooks.index')->with(['message' => '商品を削除しました。', 'status' => 'alert']);
    }
}
