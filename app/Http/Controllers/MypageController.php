<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\CustomUser;
use App\Models\Ticket;
use App\Models\Project;

class MypageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      /**$users=CustomUser::all();*/
      $tickets=Ticket::orderBy('created_at','desc')->get();
        return view('mypage.mypage_index')->with(['tickets' => $tickets]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(CustomUser $mypage)
    {
        $mypage=Auth::user();
        return view('mypage.mypage_update',['mypage' => $mypage,'auth'=>$mypage ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CustomUser $mypage)
    {
         $validated = $request->validate([
            'name' => 'required',
            'password' => 'required|min:|confirmed'
            
        ], [
            'name.required' => '名前は必須項目です。',
            'password.required' => 'パスワードは必須項目です。',
            'password.min' => 'パスワードは文字以上で指定してください。',
            'password.confirmed' => '確認用のパスワードが一致していません。',
        ]);
   
        $mypage->name = $request->name;
        $mypage->email = $request->email;
        $mypage->password = bcrypt($request->get('password'));
        $mypage->save();
        return redirect('/mypage');
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
    
   public function ChangePasswordForm(CustomUser $mypage)
   {
      
      return view('mypage.mypage_password',['mypage' => $mypage,'auth'=>$mypage ]);
   }
    
    public function SearchForm(Request $request)
    {
        $search = $request->input('search');
        $projects = Project::orderBy('created_at', 'desc');
        /*$tickets = Ticket::orderBy('created_at', 'desc');*/
        $query = Project::query();
    
        // 検索キーワードがある場合の処理
        if ($search) {
            // 全角スペースを半角に変換
            $spaceConversion = mb_convert_kana($search, 's');
    
            // 単語を半角スペースで区切り、配列にする（例："山田 翔" → ["山田", "翔"]）
            $wordArraySearched = preg_split('/[\s,]+/', $spaceConversion, -1, PREG_SPLIT_NO_EMPTY);
            // 単語をループで回し、検索条件に追加
            foreach ($wordArraySearched as $value) {
                  $query->where('title', 'like', '%'.$value.'%')
                  ->orWhere('explanation', 'like', '%'.$value.'%')
                    ->orWhereHas('Tickets', function ($query) use ($search){
                    $query->where('title', 'like', '%' .$search. '%')
                    ->orWhere('explanation', 'like', '%'.$search.'%')
                    ->orWhere('user_id', 'like', '%'.$search.'%');
                     });
            }
        }
         $projects =  $query->orderBy('created_at', 'desc')->get();
         /**$tickets =  $query->orderBy('created_at', 'desc')->get();*/
    
        return view('search')
            ->with([
                'projects' =>  $projects,
                /*'tickets' => $tickets,*/
                'search' => $search,
            ]);
    }
}
