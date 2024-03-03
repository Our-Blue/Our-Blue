@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>新規チケット登録</h2>
        <form method="POST" action="{{ route('tickets.store') }}">
            @csrf

            <div class="form-group">
                <label for="project_id">プロジェクト</label>
                <select id="project_id" class="form-control" name="project_id">
                    @foreach($projects as $project)
                        <option value="{{ $project->ID }}">{{ $project->title }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="title">チケットタイトル</label>
                <input id="title" type="text" class="form-control" name="title" required autofocus>
            </div>

            <div class="form-group">
                <label for="explanation">チケット説明</label>
                <textarea id="explanation" class="form-control" name="explanation" rows="4" required></textarea>
            </div>

            <div class="form-group">
                <label for="status">ステータス</label>
                <select id="status" class="form-control" name="status">
                    <option value="1">未着手</option>
                    <option value="2">進行中</option>
                    <option value="3">完了</option>
                </select>
            </div>

            <div class="form-group">
                <label for="start_day">開始日</label>
                <input id="start_day" type="date" class="form-control" name="start_day" required>
            </div>

            <div class="form-group">
                <label for="limit_day">期日</label>
                <input id="limit_day" type="date" class="form-control" name="limit_day" required>
            </div>

            <div class="form-group">
                <label for="user_id">担当者</label>
                <select id="user_id" class="form-control" name="user_id">
                    @foreach($users as $user)
                        <option value="{{ $user->ID }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="priority">優先度</label>
                <select id="priority" class="form-control" name="priority">
                    <option value="1">低</option>
                    <option value="2">中</option>
                    <option value="3">高</option>
                </select>
            </div>

            <div class="form-group">
                <label for="progress">進捗率</label>
                <input id="progress" type="number" class="form-control" name="progress" min="0" max="100" required>
            </div>

            <button type="submit" class="btn btn-primary">登録</button>
        </form>
    </div>
@endsection