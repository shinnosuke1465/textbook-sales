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

        $keyword = $request->input('keyword');
        $universityId = $request->input('university_id');

        $faculties = Faculty::select('id', 'name')
            ->when($universityId, function ($query, $universityId) {
                $query->where('university_id', $universityId);
            })
            ->when($keyword, function ($query, $keyword) {
                $query->where('name', 'LIKE', '%' . $keyword . '%');
            })
            ->distinct()
            ->get();

        return response()->json($faculties);
    }
}
