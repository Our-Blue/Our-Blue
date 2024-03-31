@extends('layouts.app')
@section('content')
    <p class="top_mypage">マイページ</p>
    <div class="user_info">
        <div class="user_name">
            <p>ユーザー名</p>
            <p>{{$mypage->name}}</p>
            <a href="mypage/{{$mypage->ID}}/edit" class="mypage1">
             <button type='button' class='btn btn-primary'>ユーザー情報変更</button>
            </a>
            <br>

           
        </div>
        <div class="notice_div">
            <p class="notice_p">通知</p>
            @if(count($tickets) > 0)
                @foreach($tickets as $ticket)
                 <a href="{{ route('tickets.show', ['id' => $ticket->ID]) }}" class="ticket_a_button"><p>・@if(is_null($ticket->read_flg))<span class="read_flg_null">未読</span><span>　</span>@endif{{$ticket->created_at}}　チケットが登録されました。</p></a>
                @endforeach
            @endif
        </div>
    </div>
    
        <div>
        <p class="ticket">プロジェクト一覧</p>
        <div class="ticket2">
            @if(count($projects) > 0)
            @foreach($projects as $project)
            <a href="/project/{{$project->ID}}">
                <p class="pj_title">プロジェクト名:{{ $project->title }}</p>
                <p>{{ $project->explanation }}</p>
                <p>ステータス: {{ $project->status }}</p>
                <p>期日: {{ $project->limit_day }}</p>
            </a>
            @endforeach
            @endif
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
button{
    margin-top: 20px;

}
.ticket{
    text-align:center;
}
.ticket2{
    margin-left: 10%;
    border: 1px solid black;
    width: 80%;
    height: 200px;
    overflow-y: scroll;
}
.read_flg_null{
  background-color: red;
  color:white;
}
.ticket_a_button{
    text-decoration: none;
}

.pj_title{
    font-size:20px;
}
</style>