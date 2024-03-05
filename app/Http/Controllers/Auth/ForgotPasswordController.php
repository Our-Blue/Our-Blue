<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use App\Models\CustomUser;

class ForgotPasswordController extends Controller
{
    // パスワードリセットリクエストフォームの表示
    public function showLinkRequestForm()
    {
        return view('auth.passwords.email');
    }

    // パスワードリセットリンクの送信処理
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);
    
        $status = Password::sendResetLink(
            $request->only('mail') // email => mail に変更
        );
    
        return $status === Password::RESET_LINK_SENT
            ? back()->with('status', __($status))
            : back()->withErrors(['mail' => __($status)]); // email => mail に変更
    }
}