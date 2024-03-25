<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OurBlue</title>
    <link rel="stylesheet" href="https://cdn.dhtmlx.com/gantt/edge/dhtmlxgantt.css">
    <script src="https://cdn.dhtmlx.com/gantt/edge/dhtmlxgantt.js"></script>
</head>
    <body class="antialiased">
        <div class="relative flex items-top justify-center bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0" style="margin-left:5%;">


            <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
                {{-- $projectDetails が存在する場合のみ表示 --}}
                @if(isset($projectDetails))
                    <!-- ここに $projectDetails の値を使用した表示を記述 -->
                    <p>{{ $projectDetails->title }}</p>
                    <p>管理者: {{$admin}}</p>
                    <p>{{ $projectDetails->explanation }}</p>
                    <!-- 他のプロパティに関する表示を追加 -->
                    
                    <!-- Ticket登録画面への遷移ボタン -->
                    <a href="{{ route('tickets.create') }}">Ticket編集画面へ</a>
        
                    <!-- チケットの編集画面への遷移ボタン -->
                    <select onchange="window.location.href=this.value">
                        <option value="" selected>チケットを選択してください</option>
                        @foreach($tickets as $ticket)
                            <option value="{{ route('tickets.edit', ['id' => $ticket->ID]) }}">{{ $ticket->title }}</option>
                        @endforeach
                    </select>
                    
                    <!-- Ticket登録画面への遷移ボタン -->
                    </br>
                    
                    <a href="{{ route('tickets.create') }}">Ticket登録画面へ</a>
            
            
                @else
                    <!-- $projectDetails が存在しない場合の表示 -->
                    <p>Project not found.</p>
                @endif
            </div>

        </div>

        <div id="gantt_here" style="width:90%; height:600px; margin-left:5%;"></div>

        <script>
            gantt.config.date_format = "%Y-%m-%d %H:%i:%s";
            gantt.init("gantt_here");
            
            // チャートの設定やデータの読み込みなどを行う
            var ticketData = [
              @foreach($tickets as $ticket)
                {
                  text: "{{ $ticket->title }}",
                  start_date: "{{ $ticket->start_day }}",
                  end_date: "{{ $ticket->limit_day }}",
                  progress: {{ $ticket->progress }},  // 進捗率
                },
              @endforeach
            ];
    
            // チャートの表示処理
            
            gantt.parse({
                data: ticketData
            });
        </script>
        <script>
            gantt.config.date_format = "%Y-%m-%d %H:%i:%s"; // オプション：日付フォーマット設定
            gantt.i18n.setLocale("jp"); // オプション：言語設定
            gantt.init("gantt_here"); // 表示　※最低限この行だけあれば表示は可能
        </script>

    </body>
</html>