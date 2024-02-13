@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>パスワードリセット</h2>
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="form-group">
                <label for="email">メールアドレス</label>
                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
            </div>

            <button type="submit" class="btn btn-primary">パスワードリセットリンクを送信</button>
        </form>
    </div>
@endsection