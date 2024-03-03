@extends('layouts.app')

@section('content')
<div class="container">
    <h2>プロジェクト登録確認</h2>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">プロジェクト名: {{ $project->title }}</h5>
            <p class="card-text">プロジェクトの説明: {{ $project->explanation }}</p>
            <p class="card-text">ステータス: {{ $project->status }}</p>
            <p class="card-text">開始日: {{ $project->start_day }}</p>
            <p class="card-text">期限日: {{ $project->limit_day }}</p>
            <p class="card-text">メンバー:</p>
            <ul>
                @foreach ($project->users as $user)
                    <li>{{ $user->name }}</li>
                @endforeach
            </ul>
            <a href="{{ route('projects.create') }}" class="btn btn-secondary">戻る</a>
        </div>
    </div>
</div>
@endsection
