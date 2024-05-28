<?php

namespace App\Http\Controllers\MyPage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ProfileUpdateRequest;
use Intervention\Image\Facades\Image;
use App\Services\ImageService;


class ProfileController extends Controller
{
    public function showProfileEditForm()
   {
     return view('mypage.profile_edit_form')
         ->with('user', Auth::user());
   }

   public function editProfile(ProfileUpdateRequest $request) {
    $user = Auth::user();

    //名前更新
    $user->name = $request->input('name');

    //画像更新
    $imageFile = $request->avatar;
    if (!is_null($imageFile) && $imageFile->isValid()) {
        //画像とフォルダ名を渡す
        $fileNameToStore = ImageService::upload($imageFile, 'images');
    }
    if (!is_null($imageFile)) {
        $user->avatar_file_name = $fileNameToStore;
    }

    //保存
    $user->save();

    return redirect()->back()
        ->with('status', 'プロフィールを変更しました。');
   }
}
