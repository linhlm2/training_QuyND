<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Department;
use App\Staff;
use Illuminate\Support\Facades\DB;
class DepartmentController extends Controller
{
    /*
     * Get List function. 
     * Get department list. 
     */
    public function getList()
    {
        $list = Department::all();
        foreach ($list as $de)
        {
            if (DB::table('staff')->where('id_department',$de->id)->first()) {
                $listcantdelete[] = $de->id;
            };
        };		 
    	return view('admin.department.list',['list'=>$list,'deid'=>$listcantdelete]);
    }
    
    /**
     * 
     * get edit function
     *  
     */
    public function getEdit($id)
    {
        $department = Department::find($id); 
        return view('admin.department.edit',['department'=>$department]);
    }    
    
    /**
     * 
     * post edit function
     * 
     * 
     */
    public function postEdit(Request $request,$id)
    {       
        $department = Department::find($id);
        $this->validate($request,
            [
                'name'=>'required|max:30',
                'address'=>'required|max:80',
                'phone'=>'required|numeric|digits_between:8,12'
            ],
            [
            'name.required'=>'not fill name',
            'name.max'=>'too long'
            ]);
        $department->name = $request->name;
        $department->address = $request->address;
        $department->phone = $request->phone;
        $department->save();       
       return redirect('admin/department/edit/'.$id)->with('note','edit success');
   }
   
   /*
    * get add funtion
    */
    public function getAdd()
    {
    	return view('admin.department.add');
    }    
    /**
     * 
     * @param Request $request
     * @return type
     */
    
    public function postAdd(Request $request)
    {
        
    	$this->validate($request,
    		[
    		'name'=>'required|max:30',
                'address'=>'required|max:80',
                'phone'=>'required|numeric|digits_between:8,12'
    		],
    		[
    		'name.required'=>'not fill name',
    		'name.max'=>'too long'
    		]);
    	$department= new Department;
        $department->name = $request->name;
        $department->address = $request->address;
        $department->phone = $request->phone;
        $department->save();
        return redirect('admin/department/add')->with('note', 'add success');
    }
    
    /**
     * 
     * delete function
     * 
     */
    public function postDelete($id)
    {
        if (!Staff::where('id_department',$id)->exists()) {
            $department = Department::find($id);
            $department->delete();
            return redirect('admin/department/list')->with('note', 'delete success');
        } else 
            return redirect('admin/department/list')->with('note', 'cant delete this department');
    }
}

