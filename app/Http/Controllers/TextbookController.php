<?php

namespace App\Http\Controllers;

use App\Http\Requests\TextbookRequest;
use Illuminate\Http\Request;
use App\Models\ItemCondition;
use App\Models\Textbook;
use Illuminate\Support\Facades\Auth;
use App\Models\University;
use App\Services\ImageService;
use DB;

class TextbookController extends Controller
{
    public function index()
    {

        //orderByRawメソッド...ORDER BY句のSQLを直接記述することが可能。メソッドの中身のsqlを展開すると以下のようになる
        //ORDER BY FIELD(state, 'selling', 'bought')
        //FIELDはSQLの関数で、第一引数で指定した値が第二引数以降の何番目に該当するかを返えす
        //stateがsellingの場合は1、boughtの場合は2を返しており、これを昇順で並べ替えることで、出品中(selling)の商品が先に、購入済み(bought)の商品が後になるようにソートされ
        $textbooks = Textbook::with(['university', 'faculty'])->orderByRaw("FIELD(state, '" . Textbook::STATE_SELLING . "', '" . Textbook::STATE_BOUGHT . "')")
            //出品中の商品と購入済みの商品の中でさらにidの降順（最近出品された順）で並べ替え
            ->orderBy('id', 'DESC')
            ->paginate(5);

        return view('textbooks.index')
            ->with('textbooks', $textbooks);
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
            $item->save();

            DB::commit();
            return redirect()->route('textbooks.create')->with(['message' => '商品を出品しました。', 'status' => 'info']);
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('textbooks.create')->with([
                'message' => '登録エラー：登録時にエラーが発生しました。少し時間をおいてから再度お試しください。', 'status' => 'alert',
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
