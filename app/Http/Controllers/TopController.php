<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;

class TopController extends Controller
{
        public function index(Request $request)
    {
        $projects = Project::select('id','title', 'explanation', 'start_day')->get();
        return view('welcome', [
            'projects' => $projects
            ]);
    }
}
