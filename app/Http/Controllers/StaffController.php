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
use Illuminate\Support\Facades\Hash;
use config\constant;
class StaffController extends Controller
{
 
    
  

    public function getList(){
 		 $list = Staff::all();
 		 
    	return view('admin.staff.list',['list'=>$list]);
    }

    public function getEdit($id){
        $staff = Staff::find($id);
        $department = Department::all();
        $position = Position::all();
        return view('admin.staff.edit',['staff'=>$staff,'department'=>$department,'position'=>$position]);
    }
    
    public function postEdit(Request $request,$id){
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
        if(strlen($request->password)==0){   
        }elseif(!nullOrEmptyString($request->password) && strlen($request->password)>5){$staff->password = Hash::make($request->password);
        }else return redirect('admin/staff/edit/'.$id)->with('note','password wrong');
        $staff->email = $request->email;
        $staff->is_admin = $request->admin;
        $staff->active = $request->active;
        $staff->update();       


        return redirect('admin/staff/edit/'.$id)->with('note','edit success');


    }

    public function getAdd(){
        $department = Department::all();
        $position = Position::all();
    	return view('admin.staff.add',['department'=>$department,'position'=>$position]);

    }
    
    public function postAdd(Request $request){
    	$this->validate($request,
    		[
    		'name'=>'required|min:3|max:30',
                'birthday'=>'required',
                'address'=>'max:80',
                'country'=>'max:20',
                'sex'=>'max:1',
                'phone'=>'max:20',
                'department',
                'position',
                'password'=>'required|min6|max:20',
                'email'=>'required|max:40',
                'admin'=>'required|max:1',
                'active'=>'required|max:1',
                'password'=>'required|min:6|max:20'
    		],
    		[
    		'name.required'=>'not fill name',
                'name.unique'=>'name existed',
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
        $staff->password = Hash::make($request->password);
        $staff->email = $request->email;
        $staff->is_admin = $request->admin;
        $staff->active = $request->active;    	
        $staff->save();
        return redirect('admin/staff/add')->with('note','add success');
    }
    public function postXoa($id){
        $theloai = Staff::find($id);
        $theloai->delete();
        return redirect('admin/staff/list')->with('note','delete success');
    }
}

