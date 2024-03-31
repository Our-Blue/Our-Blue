@extends('layouts.app')
@section('content')
    <p class="top_mypage">パスワード編集</p>
    @if ($errors->any())
    <div>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <form action="{{ route('mypage.update', $auth->ID)}}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="name" value="{{$mypage->name}}">
    <input type="hidden" name="mail" value="{{$mypage->mail}}">
    <div class="input">
        <input type="hidden" name="_method" value="PUT">
        <span>新パスワード&emsp;&emsp;&emsp;&emsp;</span>
        <input type="password" name="password">
    </div><br>
    <div class="input">
        <span>新パスワード確認&emsp;&emsp;</span>
        <input type="password" name="password_confirmation">
    </div><br>
    <div class="input">
        <a href="{{ route('mypage.index')}}">
            <input type='submit'　value="更新">
        </a>
    </form>
    &emsp;&emsp;
     <a href="mypage/{{$mypage->ID}}/edit" class="mypage1">
    <button type='button'>戻る</button>
    </a>
    </div>
    
@endsection

<style>
/*マイページ編集情報*/
.top_mypage{
    text-align: center;
    font-size: 20px;
}

.input{
    display: flex;
    justify-content: center;
}

</style>
