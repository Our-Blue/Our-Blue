@extends('layouts.app')
@section('content')
    <p class="top_mypage">ユーザー情報編集</p>
    <div class="input"><span>ユーザー名&emsp;&emsp;&emsp;&emsp;</span><input type="text"></div><br>
    <div class="input"><span>メールアドレス&emsp;&emsp;</span><input type="text"></div><br>
     <div class="input">
    <button onclick=""　id="exampleModalLabel">更新</button>
    &emsp;&emsp;
    <button onclick="">戻る</button>
    </div>
    <a href=""><p class="pass_change">パスワード変更はこちら</p></a>
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