@extends('layouts.app')
@section('content')
    <p class="top_mypage">マイページ</p>
    <div class="user_info">
        <div class="user_name">
            <p>ユーザー名</p>
            <p>開発テスト君</p>
            <a href="" class="mypage1">
             <button type='button' class='btn btn-primary'>ユーザー情報変更</button>
            </a>
            <br>

           
        </div>
        <div class="notice_div">
            <p class="notice_p">通知</p>
            <p class="">routeを入れる。</p>
            @if(count($tickets) > 0)
                @foreach($tickets as $ticket)
                 <a href=""><p>・{{$ticket->created_at}}　チケットが登録されました。</p></a>
                @endforeach
            @endif
        </div>
    </div>
    <div class="ticket">
        <p>チケット一覧</p>
        <div class="ticket2">
             <p class="">routeを入れる。</p>
            <p>チケット一覧</p>
            <p>チケット一覧</p>
            <p>チケット一覧</p>
            <p>チケット一覧</p>
        </div>
    </div>
@endsection

<style>
    
/*マイページ情報*/
.top_mypage{
 text-align: center;
 font-size: 20px;
}
.user_info{
    display: flex;
}
.icon{
    border: 4px solid black;
    border-radius: 30px;
    height: 150px;
    width: 12%;
    margin-left: 10%;
}
.user_name{
    margin-left: 15%;
}
.notice_div{
    margin-left: 10%;
    border: 1px solid black;
    width: 30%;
    height: 200px;
    overflow-y: scroll;
}

.notice_p{
    margin-left:50%;
}
.user_button{
    text-align: center;
}
button{height: 40px;
    margin-top: 20px;

}
.ticket{
    text-align: center;
    font-size: 20px;
}
.ticket2{
  border: 1px solid black;
  width: 80%;
  margin: 0 auto;

}
</style>