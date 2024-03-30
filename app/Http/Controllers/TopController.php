<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Project;
use App\Models\CustomUser;
use App\Models\Member;



// class TopController extends Controller
// {
//         public function index(Request $request)
//     {
//         $projects = Project::select('id','title', 'explanation', 'start_day')->get();
//         return view('welcome', [
//             'projects' => $projects
//             ]);
//     }
// }

class TopController extends Controller
{
    public function index(Request $request)
    {
        // ログインしているユーザーのIDを取得
        $userId = Auth::id();

        // ログインしているユーザーが参加しているプロジェクトのIDのリストを取得
        $projectIds = Member::where('user_id', $userId)->pluck('project_id');

        // ログインしているユーザーが参加しているプロジェクトのみを取得
        $projects = Project::whereIn('id', $projectIds)
                            ->select('id', 'title', 'explanation', 'start_day')
                            ->get();
        return view('welcome', [
            'projects' => $projects
        ]);
    }
}