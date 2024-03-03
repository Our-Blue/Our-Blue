@extends('layouts.app')

@section('content')
<div class="container">
    <h2>プロジェクト編集</h2>
    <form action="{{ route('projects.update', $project->ID) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="title">プロジェクト名</label>
            <input type="text" name="title" class="form-control" value="{{ $project->title }}" required>
        </div>

        <div class="form-group">
            <label for="explanation">プロジェクトの説明</label>
            <textarea id="explanation" name="explanation" class="form-control">{{ $project->explanation }}</textarea>
        </div>

        <div class="form-group">
            <label for="status" class="status-field">ステータス</label>
            <select name="status" class="form-control status-field">
                <option value="0" {{ $project->status == 0 ? 'selected' : '' }}>未着手</option>
                <option value="1" {{ $project->status == 1 ? 'selected' : '' }}>進行中</option>
                <option value="2" {{ $project->status == 2 ? 'selected' : '' }}>完了</option>
            </select>
        </div>

        <div class="form-group">
            <label class="date-field">開始日～期限日</label>
            <input type="date" name="start_day" class="form-control date-field" value="{{ $project->start_day }}" required>
            <input type="date" name="limit_day" class="form-control date-field" value="{{ $project->limit_day }}" required>
        </div>
        
        <div class="form-group">
            <label for="members">参加メンバー</label>
            <select name="members[]" id="members" class="form-control" multiple>
                @foreach ($users as $user)
                    <option value="{{ $user->ID }}" {{ in_array($user->ID, $selectedMembersIds) ? 'selected' : '' }}>{{ $user->name }}</option>
                @endforeach
            </select>
        </div>
        
        <div class="form-group">
            <label for="admin">管理者</label>
            <select name="admin" class="form-control">
                @foreach ($users as $user)
                    <option value="{{ $user->ID }}" {{ $project->admin == $user->ID ? 'selected' : '' }}>{{ $user->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">更新</button>
        <a href="{{ route('projects.show', $project->ID) }}" class="btn btn-secondary">キャンセル</a>
    </form>
</div>
@endsection