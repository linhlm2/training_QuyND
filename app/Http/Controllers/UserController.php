<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Staff;
use App\Department;
use App\Position;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use config\constants ;
use Illuminate\Support\Facades\Crypt;

class UserController extends Controller
{
    /*
     * get view function
     */
    public function getview()
    {
        $view = Staff::find($id);	 
    	return view('user.staff.view',['view'=>$view]);
    }

    /*
     * get edit function
     */
    public function getEdit($id)
    {
        $staff = Staff::find($id);
        $department = Department::all();
        $position = Position::all();
        return view('admin.staff.edit',['staff'=>$staff,'department'=>$department,'position'=>$position]);
    }
    
    /*
     * post edit function
     */
    public function postEdit(Request $request,$id)
    {
        $staff = Staff::find($id);  
        $this->validate($request,
            [
                'name'=>'required|min:3|max:30',
                'birthday'=>'required',
                'address'=>'min:3|max:80',
                'country'=>'min:3|max:20',
                'sex'=>'max:1',
                'phone'=>'max:20',
                'department',
                'position',
                'password',
                'email'=>'required|max:40',
                'admin'=>'required|max:1',
                'active'=>'required|max:1',   
            ],
            [
            'name.required'=>'not fill name',
            'name.unique'=>'name existed',
            'name.min'=>'too short',
            'name.max'=>'too long'
            ]);
        $staff->name = $request->name;
        $staff->birthday = $request->birthday;
        $staff->address = $request->address;
        $staff->country = $request->country;
        $staff->sex = $request->sex;
        $staff->phone = $request->phone;
        $staff->id_department = $request->department;
        $staff->id_position = $request->position;
        
        if(strlen($request->password) == 0){  
        }else if(strlen($request->password) >= \constants::LENGTHPASSWORD){
            $staff->password = bcrypt($request->password);
        }else{ 
            return redirect('admin/staff/edit/'.$id)->with('note','password wrong'); 
        };
        $staff->email = $request->email;
        $staff->is_admin = $request->admin;
        $staff->active = $request->active;
        $staff->update();       
        return redirect('admin/staff/edit/'.$id)->with('note','edit success');
    }
    
    /*
     * get admin login function
     */
    public function getAdminlogin()
    {
        $user = Auth::user();
        if ($user->is_admin == 1) {
            return  Redirect('admin/staff/list');
        } else
            return view('admin.loginadmin');
    }
    
    /*
     * post admin login function
     */
    public function postAdminlogin(Request $request)
    {
        $this->validate($request, [
            'email'=>'required|max:40',
            'password'=>'required||min:3|max:40'
        ]);
        if(Auth::attempt(['email' => $request->email,'password' => $request->password]))
        {
            return redirect('admin/staff/list');
        }else
        {
            return redirect('admin/loginadmin')->with('note','login false');
        }
        
    }
    
    /*
     * get logout function
     */
    public function getLogOut() 
    {		
	Auth::logout();
	return Redirect('login');
    }
    
    /*
     * get login function
     */
    public function getLogin()
    {
        if (Auth::check()) {
            return  Redirect('user/edit');
        } else 
            return view('login');
    }
    
    /*
     * post login function
     */
    public function postLogin(Request $request)
    {
        $this->validate($request, [
            'email'=>'required|max:40',
            'password'=>'required||min:3|max:40'
        ]);
        if(Auth::attempt(['email' => $request->email,'password' => $request->password]))
        {
            return redirect('user/edit');
        }else
        {
            return redirect('login')->with('note','login false');
        }
    }
    
    /*
     * get edit function
     */
    public function getEditUser()
    {
        $staff = Auth::user();
        return view('user.edit',['staff'=>$staff]);
    }
    
    /*
     * post edit user function
     */
    public function postEditUser(Request $request)
    {
        $id = Auth::id();  
        $staff = Staff::find($id);
        $this->validate($request,
            [
                'name'=>'required|min:3|max:30',
                'birthday'=>'required',
                'address'=>'max:80',
                'country'=>'max:20',
                'sex'=>'max:1',
                'phone'=>'max:20',
                'password',  
            ],
            [
            'name.required'=>'not fill name',
            'name.unique'=>'name existed',
            'name.min'=>'too short',
            'name.max'=>'too long'
            ]);
        $staff->name = $request->name;
        $staff->birthday = $request->birthday;
        $staff->address = $request->address;
        $staff->country = $request->country;
        $staff->sex = $request->sex;
        $staff->phone = $request->phone;
        $staff->email = $request->email;
        if(strlen($request->password)==0)   
        {}else if(strlen($request->password) >= \constants::LENGTHPASSWORD){$staff->password = bcrypt($request->password);
        }else{ return redirect('/user/edit/')->with('note','password wrong');};
        $staff->update();       
        return redirect('/user/edit/')->with('note','edit success');
    }
    
    /*
     * get view staff function
     */
    public function getListStaff()
    {
        $user = Auth::user();
        if($user->id_position == \constants::ISBOSS)
        {
            $view = DB::table('staff')->where('id_department',1)->get();
            return view('user/liststaff',['view'=>$view]);
        }else 
            return redirect('user/edit/')->with('note','you are not boss');
    }
    
    /*
     * get reset password function
     */
    public function getResetPassword() {
        return view('resetpassword');
    }
    
    /*
     * post reset password function
     */
    public function postResetPassword(Request $request) {
        $user = Auth::user();
        if(Hash::check($request->passwordold,$user->password)){
           if(($request->passwordnew == $request->passwordagain) ){
               if(strlen($request->passwordnew) >= \constants::LENGTHPASSWORD){
               $staff = Staff::find($user->id);
               $staff->active = 1;
               $staff->password = bcrypt($request->passwordnew);
               $staff->save();
               return redirect('login')->with('note','reset password success');
               }else return redirect ('resetpassword')->with('note','your new password too short');
            }else return redirect ('resetpassword')->with('note','your new password different');
        }else return redirect ('resetpassword')->with('note','your password wrong');
    }
}


