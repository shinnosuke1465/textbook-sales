<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TextbookController;
use App\Http\Controllers\MyPage\ProfileController;
use App\Http\Controllers\MyPage\SoldItemsController;
use App\Http\Controllers\UniversityController;
use App\Http\Controllers\FacultyController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\PostController;

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

//詳細検索
Route::get('/university', [UniversityController::class, 'index'])->name('university');
Route::get('/university/search', [UniversityController::class, 'search'])->name('university.search');
Route::get('/faculty/search', [FacultyController::class, 'search'])->name('faculty.search');
Route::get('/item/search', [ItemController::class, 'search'])->name('item.search');
Route::get('/faculty', [FacultyController::class, 'index'])->name('faculty');
Route::get('/item', [ItemController::class, 'index'])->name('item');

//教科書の処理
Route::resource('textbooks', TextbookController::class)->middleware('auth');

//掲示板
Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
Route::post('/posts', [PostController::class, 'store'])->name('posts.store');

require __DIR__.'/auth.php';
