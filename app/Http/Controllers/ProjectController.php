<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CustomUser;
use App\Models\Project;
use App\Models\Member;
use App\Models\Ticket;

class ProjectController extends Controller
{
    // プロジェクトの登録画面を表示
    public function create()
    {
        $users = CustomUser::all();
        $selectedMembersIds = []; // 初期化
        // ここで $selectedMembersIds を生成する必要がある
        return view('projects.create', compact('users', 'selectedMembersIds'));
    }

    // プロジェクトのデータを保存
    public function store(Request $request)
    {
        // バリデーションルールを定義
        $validatedData = $request->validate([
            'title' => 'required|string|max:100',
            'admin' => 'required|integer',
            'status' => 'required|integer',
            'explanation' => 'nullable|string|max:500',
            'start_day' => 'required|date',
            'limit_day' => 'required|date',
            'selected_members' => 'required|array', // selected_members のバリデーションを追加する
            'selected_members.*' => 'integer|exists:Users,ID', // selected_members 配列内の要素のバリデーションを追加する
        ]);

        // プロジェクトを作成
        $project = Project::create([
            'title' => $validatedData['title'],
            'admin' => $validatedData['admin'],
            'status' => $validatedData['status'],
            'explanation' => $validatedData['explanation'],
            'start_day' => $validatedData['start_day'],
            'limit_day' => $validatedData['limit_day'],
        ]);

        // 選択されたメンバーを Members テーブルに追加
        foreach ($validatedData['selected_members'] as $memberId) {
            Member::create([
                'user_id' => $memberId,
                'project_id' => $project->ID,
            ]);
        }

        return redirect()->route('projects.confirm', ['project' => $project->ID])->with('success', 'プロジェクトが登録されました！');
    }

    // プロジェクトの編集画面を表示
    public function edit(Project $project)
    {
        $users = CustomUser::all();
        $selectedMembersIds = $project->users()->pluck('ID')->toArray();
        return view('projects.edit', compact('project', 'users', 'selectedMembersIds'));
    }

    // プロジェクトの更新処理
    public function update(Request $request, Project $project)
    {
        // バリデーションルールを定義
        $validatedData = $request->validate([
            'title' => 'required|string|max:100',
            'admin' => 'required|integer',
            'status' => 'required|integer',
            'explanation' => 'nullable|string|max:500',
            'start_day' => 'required|date',
            'limit_day' => 'required|date',
            'members' => 'required|array',
            'members.*' => 'integer|exists:custom_users,id',
        ]);

        // プロジェクトを更新
        $project->update($validatedData);

        // メンバーを更新
        $project->users()->sync($validatedData['members']);

        // プロジェクト詳細ページへリダイレクト
        return redirect(route('projects.show', $project))->with('success', 'プロジェクトが更新されました！');
    }
    
    public function show($ID)
    {
        // プロジェクトの詳細情報を取得
        $projectDetails = Project::find($ID);

        $tickets = Ticket::where('project_id', $ID)->get();


        $admin =  CustomUser::findOrFail($projectDetails->admin)->name;



        //     // ガントチャート用のデータを準備
        //     $ganttChart = [
        //         'title' => $projectDetails->title,
        //         'start' => $projectDetails->start_day,
        //         'end' => $projectDetails->limit_day,
        //         'admin' => $admin,
        //     ];

                // フロントにデータを渡す
            return view('project',compact('projectDetails','tickets','admin'));

        // } else {
        // // プロジェクトが存在しない場合の表示
        //     return view('projects')->with('projectDetails', null);
        // }
    }

    public function getJson()
  {
        $projectDetails = Project::find($id);

        $tickets = Ticket::where('project_id', $projectDetails->ID)->get();


    return response()->json([
      "tickets" => $tickets,
      "projectdetails" => $projectDetails,
    ]);
  }


    // プロジェクトの確認画面を表示
    public function confirm(Project $project)
    {
        return view('projects.confirm', compact('project'));
    }
}