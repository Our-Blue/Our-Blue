@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>新規ユーザー登録</h2>
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="form-group">
                <label for="name">名前</label>
                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
            </div>

            <div class="form-group">
                <label for="email">メールアドレス</label>
                <input id="email" type="email" class="form-control" name="mail" value="{{ old('mail') }}" required autocomplete="email">
            </div>

            <div class="form-group">
                <label for="password">パスワード</label>
                <input id="password" type="password" class="form-control" name="password" required autocomplete="new-password">
            </div>

            <div class="form-group">
                <label for="password-confirm">パスワード確認</label>
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
            </div>

            <button type="submit" class="btn btn-primary">登録</button>
        </form>
    </div>
@endsection
