<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Mail;
use App\Staff;
use config\constans;
use Illuminate\Support\Facades\Hash;

class SendMailController extends Controller
{
    /*
     * get send mail function
     */
    public function getSendMail()
    {
        return view('sendmail');
    }
    
    /*
     * post send mail function
     */
    public function postSendMail(Request $request)
    {
       if (Staff::where('email', '=', $request->email)->exists()) {
            $password = str_random(8);
            $staff = Staff::where('email', '=', $request->email)->first();
            $staff->codepass = bcrypt($password);
            $staff->save();
            Mail::send('resetmail',['password' => $password, 'staff' => $staff], function ($message) use ($request) {               
                $message->to($request->email, 'user')->subject('reset password');
                $message->from('nguyendinhquy94@gmail.com', 'admin');      
            });
            return redirect('login')->with('note', 'send password to email');
        } else 
            return redirect('sendmail')->with('note', 'email not exists');
    }
    
    /*
     * get reset login function
     */
    public function getResetLogin()
    {
        return view('resetlogin');
    }
    
    /*
     * post reset login function
     */
    public function postResetLogin(Request $request)
    {
       if (Staff::where('email', '=', $request->email)->exists()) {
            $staff = Staff::where('email', '=', $request->email)->first();
            if (Hash::check($request->passcode, $staff->codepass)) {
               if (($request->passwordnew == $request->passwordagain)) {
                    if(strlen($request->passwordnew) >= \constants::LENGTHPASSWORD) {
                         $staff->password = bcrypt($request->passwordnew);
                         $staff->save();
                         return redirect('login')->with('note','reset password success');
                    } else 
                        return redirect ('resetlogin')->with('note','your new password too short');
                } else 
                    return redirect ('resetlogin')->with('note','your new password different');
            } else
                return redirect('resetlogin')->with('note', 'code wrong');;
        } else 
            return redirect('resetlogin')->with('note', 'email not exists');
    }
}