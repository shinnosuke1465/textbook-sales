<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Textbook;

class ItemController extends Controller
{

    public function index()
    {
        return view('item.index');
    }

    public function search(Request $request)
    {
        $universityId = $request->input('university_id');
        $facultyId = $request->input('faculty_id');

        // 該当する大学と学部に関連する教科書を取得
        $textbooks = Textbook::where('university_id', $universityId)
            ->where('faculty_id', $facultyId)
            ->select('id', 'name') // 必要なフィールドだけを取得
            ->get();

        return response()->json($textbooks);
    }
}
