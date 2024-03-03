@extends('layouts.app')
@section('content')
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>OurBlue</title>
        <link rel="stylesheet" href="https://cdn.dhtmlx.com/gantt/edge/dhtmlxgantt.css">
        <script src="https://cdn.dhtmlx.com/gantt/edge/dhtmlxgantt.js"></script>
    </head>
    
    <body>
        <div class="container mt-5">
            @if(!empty($projectResults) || !empty($ticketResults))
                @if(!empty($projectResults))
                    @if(count($projectResults) > 0)
                    <h3>検索内容に該当するプロジェクト</h3>
                    <div class="list-group">
                        @foreach($projectResults as $project)
                            <a href="{{ route('project', $project -> ID) }}" class="list-group-item list-group-item-action">
                                <strong>{{ $project->title }}</strong><br>
                                <small>
                                    @if(strpos($project->explanation, $searchKeyword) !== false)
                                        {{ mb_strimwidth($project->explanation, strpos($project->explanation, $searchKeyword) - 10, 40) }}
                                    @else
                                        {{ mb_strimwidth($project->explanation, 0, 40) }}
                                    @endif
                                </small>
                                <br>
                                <span>期間: {{ $project->start_day }} 〜 {{ $project->limit_day }}</span>
                            <br>
                            <br>
                            </a>
                        @endforeach
                    </div>
                    @endif
                @endif
        
            @if(!empty($ticketResults))
                @if(count($ticketResults) > 0)
                <h3>検索内容に該当するチケット</h3>
                <div class="list-group">
                    @foreach($ticketResults as $ticket)
                        @php
                            $user = \App\Models\CustomUser::find($ticket->user_id);
                            $project = \App\Models\Project::find($ticket->project_id);
                            $projectTitle = $project ? $project->title : '該当なし';
                        @endphp
                        <a href="{{ route('tickets.show', ['id' => $ticket->ID]) }}" class="list-group-item list-group-item-action">
                            <strong>{{ $ticket->title }}</strong><br>
                            <small>
                                @if(strpos($ticket->explanation, $searchKeyword) !== false)
                                    {{ mb_strimwidth($ticket->explanation, strpos($ticket->explanation, $searchKeyword) - 10, 40) }}
                                @else
                                    {{ mb_strimwidth($ticket->explanation, 0, 40) }}
                                @endif
                            </small>
                            <br>
                            <span>担当者: {{ $user->name }}</span><br>
                            <span>プロジェクト: {{ $projectTitle }}</span>
                            <br>
                            <span>期間: {{ $ticket->start_day }} 〜 {{ $ticket->limit_day }}</span>
                            <br>
                            <br>
                        </a>
                    @endforeach
                </div>
                @endif
            @endif
            @else
                <p>該当するデータが見つかりませんでした。</p>
            @endif
        </div>
        
        <!-- Bootstrap JS and Popper.js -->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
        
    </body>
@endsection