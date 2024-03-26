<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\Project;
use App\Models\Member;
use App\Models\CustomUser;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       $projects = Project::all();
        $members = Member::all();
        $users = [];
        
        foreach ($members as $member) {
            $user = CustomUser::find($member->user_id);
            if ($user) {
                $users[] = $user;
            }
        }
        
        return view('tickets.create', compact('projects', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'project_id' => 'required|exists:Projects,ID', // プロジェクトが存在することを確認
            'title' => 'required|string|max:100|unique:Tickets', // タイトルは必須、最大100文字、一意であることを確認
            'status' => 'nullable|integer', // ステータスは整数であることを確認
            'user_id' => 'nullable|exists:Users,ID', // ユーザーが存在することを確認
            'explanation' => 'nullable|string|max:500', // 説明は最大500文字まで
            'start_day' => 'required|date', // 開始日は必須で日付形式であることを確認
            'end_day' => 'nullable|date', // 終了日は日付形式であることを確認
            'limit_day' => 'required|date', // 期日は必須で日付形式であることを確認
            'time' => 'nullable|integer', // 時間は整数であることを確認
            'progress' => 'nullable|integer|min:0|max:100', // 進捗率は0から100の間の整数であることを確認
        ]);
        
        $ticket = Ticket::create($validatedData); // チケットを作成して$ticket変数に代入
        //新規に作成されたチケットのプロジェクトIDを取得
        $projectId = $ticket->project_id;
        // プロジェクト詳細画面へリダイレクトする際にプロジェクトIDを提供する
        return redirect()->route('project', ['id' => $ticket->project_id])->with('success', 'チケットが正常に登録されました。');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ticket = Ticket::findOrFail($id);
        return view('tickets.show', compact('ticket'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ticket = Ticket::findOrFail($id);
        $members = Member::all();
        $users = CustomUser::all(); // すべてのユーザーを取得
        return view('tickets.edit', compact('ticket', 'members', 'users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $ticket = Ticket::findOrFail($id);
        $validatedData = $request->validate([
            'title' => 'required|string|max:100|unique:Tickets,title,' . $id, // 既存のチケットとの一意性を確認するために $id を追加
            'status' => 'nullable|integer', // ステータスは整数であることを確認
            'user_id' => 'nullable|exists:Users,ID', // ユーザーが存在することを確認
            'explanation' => 'nullable|string|max:500', // 説明は最大500文字まで
            'start_day' => 'required|date', // 開始日は必須で日付形式であることを確認
            'end_day' => 'nullable|date', // 終了日は日付形式であることを確認
            'limit_day' => 'required|date', // 期日は必須で日付形式であることを確認
            'time' => 'nullable|integer', // 時間は整数であることを確認
            'progress' => 'nullable|integer|min:0|max:100', // 進捗率は0から100の間の整数であることを確認
        ]);
       //\Log::info('Updating ticket', ['ticket_id' => $ticket->ID, 'updated_data' => $validatedData]);
        $ticket->update($validatedData);
        //\Log::info('Ticket updated successfully', ['ticket_id' => $ticket->ID]);
        $projectId = $ticket->project_id;
        // プロジェクト詳細画面へリダイレクトする際にプロジェクトIDを提供する
        return redirect()->route('project', ['id' => $ticket->project_id])->with('success', 'チケットが正常に更新されました。');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}