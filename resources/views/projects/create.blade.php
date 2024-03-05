@extends('layouts.app')

@section('content')
<div class="container">
    <h2>新規プロジェクト登録画面</h2>
    <form action="{{ route('projects.store') }}" method="POST">
        @csrf <!-- CSRFトークンを含める -->

        <div class="form-group">
            <label for="title">プロジェクト名</label>
            <input type="text" name="title" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="explanation">プロジェクトの説明</label>
            <textarea id="explanation" name="explanation" class="form-control"></textarea>
        </div>

        <div class="form-group">
            <label for="status" class="status-field">ステータス</label>
            <select name="status" class="form-control status-field">
                <option value="0">未着手</option>
                <option value="1">進行中</option>
                <option value="2">完了</option>
            </select>
        </div>

        <div class="form-group">
            <label class="date-field">開始日～期限日</label>
            <input type="date" name="start_day" class="form-control date-field" required>
            <input type="date" name="limit_day" class="form-control date-field" required>
        </div>
        
        <div class="members-list">
            <!-- メンバーリストとメンバ選択リストを横並びにする -->
            <div class="form-group" style="display: inline-block; width: 40%; vertical-align: top;">
                <label for="members" style="height: 30px; display: block;">参加メンバー選択欄</label>
               <select name="members[]" id="members" class="form-control" multiple style="width: 100%;">
                    <!-- ユーザーの選択肢を表示 -->
                    @foreach ($users as $user)
                        @php
                            $selected = in_array($user->ID, $selectedMembersIds) ? 'selected' : '';
                        @endphp
                        <option value="{{ $user->ID }}" {{ $selected }}>{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>
    
             <!-- 追加されたメンバーリスト -->
            <div class="selected-members-container" style="display: inline-block; vertical-align: top; margin-left: 60px; max-height: 200px;">
                <label for="selectedMembers" style="height: 30px; display: block;">選択されたメンバー</label>
                <ul id="selectedMembers" class="selected-members-list" style="max-height: 100px; overflow-y: auto;">
                    <!-- 選択されたメンバーはここに表示されます -->
                    @foreach ($selectedMembersIds as $memberId)
                        @php
                            $member = App\Models\CustomUser::find($memberId);
                        @endphp
                        <li class="selected-member" data-value="{{ $member->id }}">{{ $member->name }}</li>
                    @endforeach
                </ul>
            </div>
            
            <!-- 選択されたメンバーのIDを保存するための隠しフィールド -->
            @foreach ($selectedMembersIds as $memberId)
                <input type="hidden" name="members[]" value="{{ $memberId }}">
            @endforeach
        </div>
        
        <!-- メンバー追加ボタン -->
        <!-- 操作ボタン -->
        <div class="operation-buttons" style="display: inline-block; vertical-align: bottom; margin-left: 30px;">
            <button type="button" id="addMemberBtn" class="btn btn-primary">メンバーを追加</button>
            <button type="button" id="removeMemberBtn" class="btn btn-danger">メンバーをリセット</button>
        </div>

        <!-- 管理者選択欄 -->
        <div class="form-group">
            <label for="admin">管理者</label>
            <select name="admin" class="form-control">
                @foreach ($users as $user)
                    <option value="{{ $user->ID }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- 選択されたメンバーのIDを保存するための隠しフィールド -->
        <div id="selectedMembersContainer" style="display: none;">
            <!-- ここに選択されたメンバーのIDが動的に追加されます -->
        </div>

        <button type="submit" class="btn btn-primary">プロジェクトを作成</button>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const addMemberBtn = document.getElementById('addMemberBtn');
        const removeMemberBtn = document.getElementById('removeMemberBtn');
        const membersSelect = document.getElementById('members');
        const selectedMembersList = document.getElementById('selectedMembers');
        const selectedMembersContainer = document.getElementById('selectedMembersContainer');
    
        addMemberBtn.addEventListener('click', function() {
            const selectedOptions = Array.from(membersSelect.selectedOptions);
            selectedOptions.forEach(option => {
                // 選択されたメンバーをリストに追加
                const listItem = document.createElement('li');
                listItem.textContent = option.text;
                listItem.dataset.value = option.value; // メンバーIDをデータ属性に設定
                listItem.classList.add('selected-member');
                selectedMembersList.appendChild(listItem);
    
                // 選択されたメンバーのIDを隠しフィールドに保存
                const hiddenInput = document.createElement('input');
                hiddenInput.type = 'hidden';
                hiddenInput.name = 'selected_members[]';
                hiddenInput.value = option.value;
                selectedMembersContainer.appendChild(hiddenInput);
    
                // プルダウンから選択されたメンバーを削除
                option.remove();
            });
        });
    
        removeMemberBtn.addEventListener('click', function() {
            const selectedMembers = document.querySelectorAll('.selected-member');
            selectedMembers.forEach(member => {
                member.remove(); // 選択されたメンバーを削除
    
                // 対応する隠しフィールドも削除
                const memberId = member.dataset.value;
                const hiddenInput = selectedMembersContainer.querySelector(`input[value="${memberId}"]`);
                if (hiddenInput) {
                    hiddenInput.remove();
                }
    
                // 削除されたメンバーのIDをプルダウンに戻す
                const option = document.createElement('option');
                option.value = memberId;
                option.textContent = member.textContent;
                membersSelect.appendChild(option);
            });
        });
    
        // 選択されたメンバーをクリックした時の処理
        selectedMembersList.addEventListener('click', function(event) {
            if (event.target.classList.contains('selected-member')) {
                event.target.remove(); // 選択されたメンバーを削除
    
                // 対応する隠しフィールドも削除
                const memberId = event.target.dataset.value;
                const hiddenInput = selectedMembersContainer.querySelector(`input[value="${memberId}"]`);
                if (hiddenInput) {
                    hiddenInput.remove();
                }
    
                // 削除されたメンバーのIDをプルダウンに戻す
                const option = document.createElement('option');
                option.value = memberId;
                option.textContent = event.target.textContent;
                membersSelect.appendChild(option);
            }
        });
    });
</script>

<style>
    /* スタイルの追加 */
    .selected-members-container {
        margin-top: 20px; /* 上部に余白を追加 */
        max-height: 100px; /* 最大の高さを指定 */
        display: inline-block;
    }

    .selected-members-list {
        padding: 10px; /* リストの内側の余白を追加 */
        list-style-type: none; /* リストのマーカーを非表示 */
        background-color: #f0f0f0; /* 背景色を設定 */
        border-radius: 5px; /* 角丸にする */
        overflow-y: auto; /* スクロール可能にする */
        max-height: 150px; /* 最大の高さを設定 */
    }

    .selected-members-list li {
        margin-bottom: 5px; /* 各メンバーの間に余白を追加 */
    }

    /* フォーム要素のスタイル */
    .form-group {
        margin-bottom: 15px; /* フォーム要素間に余白を追加 */
         width: 80%;
    }

    .form-group label {
        font-weight: bold;
        color: #333; /* 通常のテキストカラーに設定 */
        display: block; /* ラベルをブロック要素として表示 */
        margin-bottom: 5px; /* ラベル下に余白を追加 */
        margin-top: 5px;
    }

    .form-control {
        border: 1px solid #ccc; /* 入力フィールドのボーダーを設定 */
        border-radius: 5px;
        padding: 10px;
        width: 100%; /* テキストボックスの幅を100%に設定 */
    }

    /* ボタンのスタイル */
    .btn-primary {
        background-color: #0056b3; /* プライマリーボタンの背景色を設定 */
        border: none;
        border-radius: 5px;
        color: #fff;
        padding: 10px 20px;
        cursor: pointer;
    }

    .btn-primary:hover {
        background-color: #0043a2; /* マウスホバー時の背景色を変更 */
    }

    /* プロジェクト説明のスタイル */
    #explanation {
        margin-left: 0; /* 左側の余白を0に設定 */
        height: 150px; /* プロジェクト説明の高さを150pxに設定 */
    }

    /* 開始日と期限日のスタイル */
    .date-field {
        width: 40%; /* 開始日と期限日の幅を40%に設定 */
        display: inline-block; /* 開始日と期限日を横に並べるためにインラインブロック要素にする */
    }

    /* ステータスのスタイル */
    .status-field {
        width: 40%; /* ステータスの幅を40%に設定 */
        display: inline-block; /* ステータスを横に並べるためにインラインブロック要素にする */
    }
</style>

@endsection
