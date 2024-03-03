@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>{{ $ticket->title }}</h2>
        <p>{{ $ticket->explanation }}</p>
        <p>ステータス: {{ $ticket->status }}</p>
        <p>開始日: {{ $ticket->start_day }}</p>
        <p>期日: {{ $ticket->limit_day }}</p>
        <p>担当者: {{ $ticket->user->name }}</p>
        <p>優先度: {{ $ticket->priority }}</p>
        <p>進捗率: {{ $ticket->progress }}%</p>
    </div>
@endsection