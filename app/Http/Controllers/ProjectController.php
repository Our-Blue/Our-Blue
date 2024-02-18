<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Ticket;
use App\Models\CustomUser as User;


class ProjectController extends Controller
{
    public function show($ID)
    {
        // プロジェクトの詳細情報を取得
        $projectDetails = Project::find($ID);

        $tickets = Ticket::where('project_id', $ID)->get();


        $admin = User::findOrFail($projectDetails->admin)->name;



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
}

