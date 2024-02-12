@extends('layouts.app')
@section('content')
    <p class="top_mypage">パスワード編集</p>
    <div class="input"><span>パスワード&emsp;&emsp;&emsp;&emsp;</span><input type="password"></div><br>
    <div class="input"><span>パスワード確認&emsp;&emsp;</span><input type="password"></div><br>
     <div class="input">
    <button onclick=""　id="exampleModalLabel">更新</button>
    &emsp;&emsp;
    <button onclick="">戻る</button>
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
button{
  width:10%;
  height:30px;
}
</style>
