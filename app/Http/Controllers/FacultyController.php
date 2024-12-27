<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Faculty;

class FacultyController extends Controller
{

    public function index()
    {
        return view('faculty.index');
    }

    public function search(Request $request)
    {
        // キーワード検索を適用しつつ、学部名を重複排除
        $faculties = Faculty::select('name')
            ->when($request->filled('keyword'), function ($query) use ($request) {
                $query->searchKeyword($request->input('keyword'));
            })
            ->distinct() // 重複する学部名を排除
            ->get();

        return response()->json($faculties);
    }
}
