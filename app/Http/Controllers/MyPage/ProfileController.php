<?php

namespace App\Http\Controllers\MyPage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Mypage\Profile\EditRequest;

class ProfileController extends Controller
{
    public function showProfileEditForm()
   {
     return view('mypage.profile_edit_form')
         ->with('user', Auth::user());
   }
}
