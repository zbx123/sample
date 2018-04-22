<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Auth;
//use Illuminate\Support\Facades\Auth;

class SessionsController extends Controller
{  
    public function __construct()
    {
      $this->middleware('guest',[
        'only'=>['create']
      ]);
    }
    public function create()
    {
    	return view('sessions.create');
    }
    public function store(Request $request)
    {
    	/*$credentials = $this->validate($request,[
    		'email' =>'required|email|max:255',
    		'password' =>'required'
    	]);
    	if(Auth::attempt($credentials)){
    		session()->flash('success','欢迎回来');
    		return redirect()->route('users.show',[Auth::user()]);
    	}else{
    		session()->flash('danger','抱歉,邮箱跟密码不符合');
    		return redirect()->back();
    	}*/
       $credentials = $this->validate($request, [
           'email' => 'required|email|max:255',
           'password' => 'required'
       ]);
       
       /*var_dump($credentials);*/

       if (Auth::attempt($credentials,$request->has('remembe='))) {
           session()->flash('success', '欢迎回来！');
          // return redirect()->route('users.show', [Auth::user()]);
           return redirect()->intended(route('users.show',[Auth::user()]));
       } else {
           session()->flash('danger', '很抱歉，您的邮箱和密码不匹配');
           return redirect()->back();
       }
    }
    public function destroy()
    {
      Auth::logout();
      session()->flash('success','成功退出');
      return redirect('login');

    }
}
