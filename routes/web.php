<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TextbookController;
use App\Http\Controllers\MyPage\ProfileController;
use App\Http\Controllers\MyPage\SoldItemsController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [TextbookController::class, 'index'])->name('top');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

//プロフィール
Route::prefix('mypage')
    ->middleware('auth')
    ->namespace('MyPage')
    ->group(function () {
        Route::get('edit-profile', [ProfileController::class, 'showProfileEditForm'])->name('mypage.edit-profile');
        Route::post('edit-profile', [ProfileController::class,'editProfile'])->name('mypage.edit-profile');
        //出品した教科書一覧画面
        Route::get('sold-items', [SoldItemscontroller::class,'showSoldItems'])->name('mypage.sold-items');
    });

//大学と学部のセレクトボックスの実装
Route::get('/faculties/{university}', function ($university) {
    $faculties = \App\Models\University::find($university)->faculties;
    return response()->json($faculties);
});

//教科書の処理
Route::resource('textbooks', TextbookController::class)->middleware('auth')->except('show');


require __DIR__.'/auth.php';
