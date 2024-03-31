<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OurBlue</title>
    <!-- CSS や JavaScript ファイルのリンクを追加 -->
</head>
<body>
    <header>
        <a href="{{ url('/') }}" class="header_home">ホーム</a>
        @if(Auth::check())
       　　
        <div class="search_div">
            <form action="{{ route('result') }}" method="GET" class="search_form">
                <input type="search" placeholder="フリーワード検索" name="search" value="@if (isset($search)) {{ $search }} @endif">
                <input type="submit" value="検索" class="search_button">
            </form>
        </div>
         <a href="{{route('mypage.index')}}" class="header_mypage">マイページ</a>
        <div class="logout">
           <form action="{{route('logout')}}" method="post">@csrf <button type="submit" class="out-btn">ログアウト</button></form>
        </div>
         @endif　
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
}
.container{
    width:100%;
}
.search_div{
    display: flex;
    justify-content: center;
    text-align: center;
    margin-right: auto;
    margin-left: 20%;
    margin-top:18px;
}
.search_from {
    display: flex;
    flex-direction: row;
    align-items: center;
}
.header_home{
   margin-left:3%;
   margin-top:18px;
}
.header_notice{
   margin-left:20%;
   margin-top:18px;
}
.header_mypage{
    margin-left:auto;
    margin-right:3%;
    margin-top:18px;
}
.out-btn{
　height:20px;
  width:100px;
  margin-top:18px;
}
</style>
