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
        $universityId = $request->input('university_id');

        $faculties = Faculty::select('id', 'name')
        ->where('university_id', $universityId)
        ->distinct()
        ->get();

        return response()->json($faculties);
    }
}
