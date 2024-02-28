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
      $mypage =Auth::user();
      $tickets=Ticket::orderBy('created_at','desc')->get();
        return view('mypage.mypage_index')->with(['tickets' => $tickets,'mypage' => $mypage]);
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
            'email' => 'required|unique:Users,email',
            'password' => 'required|confirmed'
        ], [
            'name.required' => '名前は必須項目です。',
            'email.required' => 'メールアドレスは必須項目です。',
            'email.unique' => 'そのメールアドレスはすでに使われています。',
            'password.required' => 'パスワードは必須項目です。',
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
       $mypage=Auth::user();
      return view('mypage.mypage_password',['mypage' => $mypage,'auth'=>$mypage ]);
   }
   
    public function logout(Request $request){	
        $user = CustomUser::find(auth()->user()->id);
        Auth::logout();
        return redirect("/");
    }
    

}
