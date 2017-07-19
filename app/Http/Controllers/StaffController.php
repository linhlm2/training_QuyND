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
use config\constants;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

class StaffController extends Controller
{
    /*
     * get list function
     */
    public function getList()
    {
        $list = Staff::all();	 
    	return view('admin.staff.list',['list'=>$list]);
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
                'address'=>'max:80',
                'country'=>'max:20',
                'sex'=>'max:1',
                'phone'=>'required|numeric|digits_between:8,12',
                'department',
                'position',
                'password',
                'email'=>'required|unique:staff,email,'.$id.',id|max:40',
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
        if ($request->position == \constants::ISBOSS) {
            if (DB::table('staff')->where([['id_department',$request->department],['id_position',$request->position],['id','!=',$id]])->first()) {
                return redirect('admin/staff/edit/'.$id)->with('fail','this department had boss');
            };
        };
        if (strlen($request->password) == 0) {
        } elseif (strlen($request->password) > 8) {
               $staff->password = bcrypt($request->password);
        } else 
               return redirect('admin/staff/edit/'.$id)->with('note','password wrong');
        $staff->email = $request->email;
        $staff->is_admin = $request->admin;
        $staff->active = $request->active;
        $staff->update();       
        return redirect('admin/staff/list')->with('note','edit success');
    }

    /*
     * get add function
     */
    public function getAdd()
    {
        $department = Department::all();
        $position = Position::all();
    	return view('admin.staff.add',['department'=>$department,'position'=>$position]);
    }
    
    /*
     * post add function
     */
    public function postAdd(Request $request)
    {
        
    	$this->validate($request,
    		[
    		'name'=>'required|min:3|max:30',
                'birthday'=>'required',
                'address'=>'max:80',
                'country'=>'max:20',
                'sex'=>'max:1',
                'phone'=>'numeric|digits_between:8,12',
                'department',
                'position',
                'password'=>'required|min6|max:20',
                'email'=>'required|unique:staff,email|max:40',
                'admin'=>'required|max:1',
                'password'=>'required|min:6|max:20'
    		],
    		[
    		'name.required'=>'not fill name',
    		'name.min'=>'too short',
    		'name.max'=>'too long'
    		]);
    	$staff= new Staff;
        $staff->name = $request->name;
        $staff->birthday = $request->birthday;
        $staff->address = $request->address;
        $staff->country = $request->country;
        $staff->sex = $request->sex;
        $staff->phone = $request->phone;
        $staff->id_department = $request->department;
        $staff->id_position = $request->position;
        if ($request->position == \constants::ISBOSS) {
            if (DB::table('staff')->where([['id_department',$request->department],['id_position',$request->position]])->first()) {
                return redirect('admin/staff/add')->with('fail','this department had boss');
            };
        };
        $staff->password = bcrypt($request->password);
        $staff->email = $request->email;
        $staff->is_admin = $request->admin;
        $staff->active = 2;    	
        $staff->save();
        $password = $request->password;
        Mail::send('admin.staff.sendpassword',['password' => $password, 'staff' => $staff], function ($message) use ($request) {               
                $message->to($request->email, 'user');
                $message->from('nguyendinhquy94@gmail.com', 'admin');      
            });
        return redirect('admin/staff/list')->with('note','add success');
    }
    
    /*
     * Delete function
     */
    public function postDelete($id)
    {
        if($id == \constants::ID_ADMIN){
           return redirect('admin/staff/list')->with('fail','can not delete'); 
        }
        $staff = Staff::find($id);
        $staff->delete();
        return redirect('admin/staff/list')->with('note','delete success');
    }
    
    /*
     * get export staff function
     */
    public function getExport()
    {
        $user = Auth::user();
        $list = DB::table('department')->where('id',$user->id_department)->first();
    	return view('admin.excel.export',['department'=>$list]);
    }
    
    /*
     * post export staff function
     */
    public function postExport(Request $request)
    {
        $user = Auth::user();
        $department = DB::table('department')->where('id',$user->id_department)->first();
        if ($user->id_position != \constants::ISBOSS) {
            return redirect()->back()->with('fail','you cant access');
        };
        $list = DB::table('staff')->where('id_department',$user->id_department)->get() ;
        $data = [['name','birthday']];
        foreach ($list as $l) {
            $arrayData = [$l->name, $l->birthday];
            $data[] = array_merge($arrayData);
        }
        Excel::create('list staff', function($excel) use ($data) {
            $excel->sheet('list staff', function($sheet) use ($data) {
                $sheet->fromArray($data);
            });
        })->export('xlsx'); 
        return redirect()->back()->with('success','export access');  
    }
    
    /*
     * 
     */
    public function getAdminReset()
    {
        $list = Staff::all();	 
    	return view('admin.staff.adminreset',['list'=>$list]);
    }
    
    /*
     * 
     */
    public function postAdminReset(Request $request)
    {
        $user = $request->user;
        $list = Staff::all();
        if($request->user == NULL) 
            return view('admin.staff.adminreset',['list'=>$list])->with('fail', 'no acount reset');
        foreach ($user as $id)
        {
            $password = str_random(8);
            $staff = Staff::find($id);
            $staff->codepass = bcrypt($password);
            $staff->save();
            Mail::send('resetmail',['password' => $password, 'staff' => $staff], function ($message) use ($staff) {               
                $message->to($staff->email, 'user');
                $message->from('nguyendinhquy94@gmail.com', 'admin')->subject('reset password');      
            });
        };
    	return view('admin.staff.adminreset',['list'=>$list])->with('note', 'reset pass word success');
    }
}

