<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use App\Models\CustomUser;

class ResetPasswordController extends Controller
{
    // パスワードリセットフォームの表示
    public function showResetForm($token)
    {
        return view('auth.passwords.reset', ['token' => $token]);
    }

    // パスワードリセットの実行処理
    public function reset(Request $request)
    {
        $request->validate([
            'mail' => 'required|email', 
            'password' => 'required|min:8|confirmed',
            'token' => 'required'
        ]);
    
        $status = Password::reset(
            $request->only('mail', 'password', 'password_confirmation', 'token'), 
            function ($user, $password) {
                $user->forceFill([
                    'password' => bcrypt($password)
                ])->save();
            }
        );
    
        return $status == Password::PASSWORD_RESET
            ? redirect()->route('login')->with('status', __($status))
            : back()->withErrors(['mail' => __($status)]);
    }
}
