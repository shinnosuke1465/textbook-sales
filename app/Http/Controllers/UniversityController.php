<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\University;

class UniversityController extends Controller
{

    public function index()
    {
        return view('university.index');
    }

    public function search(Request $request)
    {
        // ローカルスコープを使用して部分一致検索
        $universities = University::query()
            ->when($request->filled('keyword'), function ($query) use ($request) {
                $query->searchKeyword($request->input('keyword'));
            })
            ->get();

        return response()->json($universities);
    }
}
