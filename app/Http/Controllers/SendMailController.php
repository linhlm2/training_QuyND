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
use App\Department;
use App\Position;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use config\constants ;
use Illuminate\Support\Facades\Crypt;
//use Illuminate\Support\Facades\Mail;
class SendMailController extends Controller
{

    public function getSendMail()
    {
        return view('sendmail');
    }
    
    public function postSendMail(Request $request)
    {
       if (Staff::where('email', '=', $request->email)->exists()) {
            $data = ['email'=>'nguyendinhquy94@gmail.com','password'=>'12345678','name'=>'quynd'];
            $mail = \Mail::send('sendmail',$data,function ($message) {               
                $message->to('khocvolebk@gmail.com','zzzzz');
                $message->from('nguyendinhquy94@gmail.com','Laravel');      
            });
        return redirect('login')->with('note','send password to email');
        }else return redirect('sendmail')->with('note','email not exists');
    }
}