<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Ticket;
use App\Models\CustomUser;

class SearchController extends Controller
{
    public function result(Request $request)
    {
        // フォームから送信された検索キーワードを取得
        $searchKeyword = $request->input('search');

        // 全角スペースを半角に変換
        $spaceConversion = mb_convert_kana($searchKeyword, 's');

        // 単語を半角スペースで区切り、配列にする（例："山田 翔" → ["山田", "翔"]）
        $wordArraySearched = preg_split('/[\s,]+/', $spaceConversion, -1, PREG_SPLIT_NO_EMPTY);

        // 初期化
        $projectResults = [];
        $ticketResults = [];
        $userResults = [];

        // ① Projectsテーブルからの検索
        $projectResults = Project::where(function ($query) use ($wordArraySearched) {
            foreach ($wordArraySearched as $word) {
                $query->where('title', 'like', "%$word%")
                      ->orWhere('explanation', 'like', "%$word%");
            }
        })->get();

        // ② Ticketsテーブルからの検索
        $ticketResults = Ticket::where(function ($query) use ($wordArraySearched) {
            foreach ($wordArraySearched as $word) {
                $query->where('title', 'like', "%$word%")
                      ->orWhere('explanation', 'like', "%$word%");
            }
        })->get();

        // ③ Usersテーブルからの検索
        $userResults = CustomUser::where(function ($query) use ($wordArraySearched) {
            foreach ($wordArraySearched as $word) {
                $query->where('name', 'like', "%$word%");
            }
        })->select('id', 'name')->get();

        // ③の結果を元にTicketsテーブル再検索
        if ($userResults->isNotEmpty()) {
            $userIdArray = $userResults->pluck('id')->toArray();

            $ticketResults = Ticket::whereIn('user_id', $userIdArray)
                ->get();
        }

        // 結果がない場合のエラーメッセージ
        if ($projectResults->isEmpty() && $ticketResults->isEmpty() && $userResults->isEmpty()) {
            return view('result')->with('error', '該当するデータが見つかりませんでした。');
        }

        // 検索結果をビューに渡す
        return view('result', [
            'projectResults' => $projectResults,
            'ticketResults' => $ticketResults,
            'userResults' => $userResults,
            'searchKeyword' => $searchKeyword
        ]);
    }
}
