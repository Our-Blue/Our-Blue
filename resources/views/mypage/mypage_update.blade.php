@extends('layouts.app')
@section('content')
    <p class="top_mypage">ユーザー情報編集</p>
    @if ($errors->any())
    <div>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    
    <form action="{{ route('mypage.update', $auth->id)}}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="input"><span>ユーザー名&emsp;&emsp;&emsp;&emsp;</span>
      <input type="text" name="name" value="{{$mypage->name}}">
    </div><br>
    <div class="input"><span>メールアドレス&emsp;&emsp;</span>
      <input type="text" name="email" value="{{$mypage->email}}">
    </div><br>
    <div>
      <input type="hidden" name="_method" value="PUT">
      <input type="hidden" name="password" value="{{$mypage->password}}">
      <input type="hidden" name="password_confirmation" value="{{$mypage->password}}">
    </div>
     <div class="input">
    <a href="{{route('mypage.index')}}">
     <input type='submit' class='btn btn-primary' value='更新'>
    </a>
    </form>
    &emsp;&emsp;
    <a href="{{ route('mypage.index')}}">
        <button type='button' class='btn btn-primary'>マイページに戻る</button>
    </a>
    </div>
    <a href="{{ route('password_form')}}"><p class="pass_change">パスワード変更はこちら</p></a>
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
button{
  width:10%;
  height:30px;
}
.pass_change{
    text-align:center;
}
</style>