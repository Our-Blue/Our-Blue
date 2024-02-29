<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your App Name</title>
    <!-- CSS や JavaScript ファイルのリンクを追加 -->
</head>
<body>
    <header>
        <a href="{{ url('/') }}" class="header_home">ホーム</a>
        @if(Auth::check())
        @endif　　　　　　　<!--ログイン認証完成後、検索とマイページをif文の中に移動*/-->
        <div class="search_div">
            <form action="{{ route('serach_form')}}" method="GET" class="search_from"><!--form action""のところにroute-->
                <input type="search" placeholder="フリーワード検索" name="search" value="@if (isset($search)) {{ $search }} @endif">
                <input type="submit" value="検索" class="search_button">
            </form>
        </div>
         <a href="{{ route('mypage.index')}}" class="header_mypage">マイページ</a>
        <div class="logout">
           <form action="{{route('logout')}}" method="post">@csrf <button type="submit" class="out-btn">ログアウト</button></form>
        </div>
    </header>
    <main class="container">
        @yield("content")
    </main>
</body>
</html>

<style>
header {
    width: 100%;
    height: 60px;
    background-color: skyblue;
    color: #fff;
    display: flex;
    justify-content: space-between;
    align-items: center;
}
.container{
    width:100%;
}
.search_div{
   display:flex;
   text-align:center;
   margin-right:auto;
   margin-left:20%;

   
}
.search_button{
    width:20%;
}

.search_from {
    display: flex;
    flex-direction: row;
    margin-top:auto;
    margin-bottom:auto;
}
.header_home{
   margin-left:3%;
}
.header_notice{
   margin-left:20%;
}
.header_mypage{
    margin-left:auto;
    margin-right:3%;
}
</style>