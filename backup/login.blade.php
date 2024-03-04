<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ログイン</title>
</head>
<body>
    <h2>ログイン画面</h2>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div>
            <label for="email">Email</label>
            <input id="email" type="mail" name="mail" value="{{ old('mail') }}" required autofocus>
        </div>

        <div>
            <label for="password">Password</label>
            <input id="password" type="password" name="password" required autocomplete="current-password">
        </div>

        <div>
            <input type="checkbox" name="remember" id="remember">
            <label for="remember">Remember Me</label>
        </div>

        <div>
            <button type="submit">Login</button>
        </div>
    </form>

    <!-- 新規登録画面へのリンク -->
    <p>アカウントをお持ちでない方はこちらから<a href="{{ route('register') }}">新規登録</a>してください。</p>

    <!-- パスワードリセット画面へのリンク -->
    <p>パスワードをお忘れの方はこちらから<a href="{{ route('password.request') }}">パスワードリセット</a>してください。</p>
</body>
</html>