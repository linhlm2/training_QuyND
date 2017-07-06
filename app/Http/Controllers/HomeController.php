<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /*
     * login function
     */
    public function getLogin()
    {
        return view('login');
    }
    
    /*
     * signin function
     */
    public function getSignin()
    {
        return view('signin');
    }
    
    /*
     * post signin function
     */
    public function postSignin(Request $req)
    {
        $this->validate($req,
            [
                'email'=>'required|email|unique:users,email',
                'password'=>'required|min:6|max:20',
                'fullname'=>'required',
                're_password'=>'required|same:password'
            ],
            [
                'email.required'=>'input email',
                'email.email'=>'do not type email',
                'email.unique'=>'Email existed',
                'password.required'=>'input password',
                're_password.same'=>'dont same password',
                'password.min'=>'too short'
            ]);
        $user = new Staff();
        $user->full_name = $req->fullname;
        $user->email = $req->email;
        $user->password = Hash::make($req->password);
        $user->phone = $req->phone;
        $user->address = $req->address;
        $user->save();
        return redirect()->back()->with('success', 'creat account success');
    }

    /*
     * post login function
     */
    public function postLogin(Request $req)
    {
        $this->validate($req,
            [
                'email'=>'required|email',
                'password'=>'required|min:8|max:20'
            ],
            [
                'email.required'=>'input email',
                'email.email'=>'type is not Email type',
                'password.required'=>'input password',
                'password.min'=>'too short',
                'password.max'=>'password too long'
            ]
        );
        $credentials = array('email'=>$req->email, 'password'=>$req->password);
        $user = User::where([
                ['email','=',$req->email],
                ['status','=','1']
            ])->first();
        if ($user) {
            if (Auth::attempt($credentials)) {
                return redirect()->back()->with(['flag' => 'success', 'message' => 'login success']);
            } else {
                   return redirect()->back()->with(['flag' => 'danger', 'message' => 'can not login']);
            }
        } else {
            return redirect()->back()->with(['flag' => 'danger', 'message' => 'account not active']); 
        }
        
    }
    
    /*
     * logout function
     */
    public function postLogout()
    {
        Auth::logout();
        return redirect()->route('signin');
    }
}


