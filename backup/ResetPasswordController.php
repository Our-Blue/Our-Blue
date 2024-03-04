<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password; // パスワードリセットの機能を提供するファサードをインポート

class ResetPasswordController extends Controller
{
    // パスワードリセットリクエストの送信フォームの表示
    public function showResetForm()
    {
        return view('auth.reset');
    }

    // パスワードリセットの処理
    public function reset(Request $request)
    {
        // パスワードリセットリクエストを送信
        $response = Password::sendResetLink($request->only('mail'));

        // パスワードリセットリクエストの結果に基づいてリダイレクト
        return $response == Password::RESET_LINK_SENT
                    ? back()->with('status', __($response))
                    : back()->withErrors(['mail' => __($response)]);
    }
}