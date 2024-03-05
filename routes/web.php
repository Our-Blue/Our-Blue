<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;

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

// ログイン関連のルート
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login'); // ログイン画面の表示
Route::post('/login/', [LoginController::class, 'login']); // ログイン処理

Route::get('/password/request', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/password/update', [ResetPasswordController::class, 'reset'])->name('password.update');

// ユーザー新規登録関連のルート
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register'); // ユーザー新規登録画面へのルート
Route::post('/register/store', [RegisterController::class, 'register'])->name('users.register'); // ユーザー登録処理へのルート // ユーザー登録処理へのルート

// プロジェクト関連のルート
Route::get('/projects/create', [ProjectController::class, 'create'])->name('projects.create');
Route::get('/projects/{project}/edit', [ProjectController::class, 'edit'])->name('projects.edit');
Route::get('/projects/{project}/confirm', [ProjectController::class, 'confirm'])->name('projects.confirm');
Route::post('/projects/store/', [ProjectController::class, 'store'])->name('projects.store');
Route::put('/projects/{project}/update', [ProjectController::class, 'update'])->name('projects.update');
Route::get('/project/{id}',[ProjectController::class, 'show'])->name('project');


// チケット関連のルート
Route::get('/tickets/create', [TicketController::class, 'create'])->name('tickets.create');
Route::post('/tickets/', [TicketController::class, 'store'])->name('tickets.store');
Route::get('/tickets/{id}', [TicketController::class, 'show'])->name('tickets.show');
Route::get('/tickets/{id}/edit', [TicketController::class, 'edit'])->name('tickets.edit');
Route::put('/tickets/{id}/edit', [TicketController::class, 'update'])->name('tickets.update');

Route::resource('mypage', MypageController::class);
Route::get('/password', [MypageController::class,'ChangePasswordForm'])->name('password_form');

Route::get('/result/{projectId}/{ticketId}', [SearchController::class, 'result'])->name('result');
