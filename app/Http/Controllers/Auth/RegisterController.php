<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CustomUser;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    // 新規登録フォームの表示
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    // 新規登録の処理
    public function register(Request $request)
    {
        // バリデーションルールの定義
        $validatedData = $request->validate([
            'name' => 'required|string|max:100',
            'mail' => 'required|string|email|max:100|unique:Users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        // パスワードをハッシュ化して保存
        $hashedPassword = Hash::make($request->password);

        // ユーザーを作成して保存
        $user = new CustomUser();
        $user->name = $validatedData['name'];
        $user->mail = $validatedData['mail'];
        $user->password = $hashedPassword;
        $user->role = $request->role; // hiddenフィールドで受け取った値を設定

        $user->save();

        // 登録成功時の処理
        return view('auth.login')->with('success', 'ユーザー登録が完了しました。ログインしてください。');
    }
}
