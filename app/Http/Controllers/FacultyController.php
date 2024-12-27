<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Textbook;
use App\Models\University;

class FacultyController extends Controller
{

    public function index(Request $request)
    {
        $textbooks = Textbook::with(['university', 'faculty']);

        // universitiesテーブルと外部キー制約であるfacultiesテーブルも同時に取得
        $universities = University::with('faculties')->get();

        return view('faculty.index', compact('textbooks', 'universities'));
    }
}
