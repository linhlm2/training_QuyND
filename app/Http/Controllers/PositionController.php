<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Position;
use App\Staff;
use Illuminate\Support\Facades\DB;

class PositionController extends Controller
{
 
    /*
     * get list function
     */
    public function getList()
    {
        $list = Position::all();
        foreach ($list as $po)
        {
            if (DB::table('staff')->where('id_position',$po->id)->first()) {
                $listcantdelete[] = $po->id;
            };
        };
    	return view('admin.position.list', ['list'=>$list,'poid'=>$listcantdelete]);
    }
    
    /*
     * get edit function
     */
    public function getEdit($id)
    {
        $position = Position::find($id);
        return view('admin.position.edit', ['position'=>$position]);
    }
    
    /*
     * post edit function
     */
    public function postEdit(Request $request,$id)
    {
        $position = Position::find($id);
        $this->validate($request,
            [
                'name'=>'required|unique:position,name|max:30',    
            ],
            [
            'name.required'=>'not fill name',
            'name.max'=>'too long'
            ]);
        $position->name = $request->name;
        $position->update();       
        return redirect('admin/position/edit/'.$id)->with('note', 'edit success');
    }
   
    /*
     * get add function
     */
    public function getAdd()
    {
    	return view('admin.position.add');
    }
    
    public function postAdd(Request $request)
    {
    	$this->validate($request,
    		[
    		'name'=>'required|unique:position,name|max:30',
    		],
    		[
    		'name.required'=>'not fill name',
    		'name.max'=>'too long'
    		]);
    	$position= new Position;
        $position->name = $request->name; 	
        $position->save();
        return redirect('admin/position/add')->with('note', 'add success');
    }
    
    /*
     * delete function
     */
    public function postDelete($id)
    {   
        if(!Staff::where('id_position',$id)->exists()) {
        $position = Position::find($id);
        $position->delete();
        return redirect('admin/position/list')->with('note', 'delete success');
        } else 
            return redirect('admin/position/list')->with('note', 'can not delete this position');
    }
}

