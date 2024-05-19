<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TextbookController;
use App\Http\Controllers\MyPage\ProfileController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::prefix('mypage')
    ->middleware('auth')
    ->namespace('MyPage')
    ->group(function () {
        Route::get('edit-profile', [ProfileController::class, 'showProfileEditForm'])->name('mypage.edit-profile');
        Route::post('edit-profile', [ProfileController::class,'editProfile'])->name('mypage.edit-profile');
        Route::get('bought-items', [BoughtItemsController::class,'showBoughtItems'])->name('mypage.bought-items');
    });

Route::get('/faculties/{university}', function ($university) {
    $faculties = \App\Models\University::find($university)->faculties;
    return response()->json($faculties);
});

Route::resource('textbooks', TextbookController::class);
require __DIR__.'/auth.php';
