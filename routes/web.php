<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HelloController;
use App\Http\Controllers\MypageController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/hello',[HelloController::class,'index'])->name('hello');

Route::resource('mypage', MypageController::class);
Route::get('/password', [MypageController::class,'ChangePasswordForm'])->name('password_form');
Route::post('/logout', [MypageController::class,'logout']) -> name('logout');