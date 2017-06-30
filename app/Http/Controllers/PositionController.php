<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Position;
class PositionController extends Controller
{
 

    public function getList()
    {
        $list = Position::all();		 
    	return view('admin.position.list',['list'=>$list]);
    }

    public function getEdit($id)
    {
        $position = Position::find($id);
        return view('admin.position.edit',['position'=>$position]);
    }
    
    public function postEdit(Request $request,$id)
    {
        $position = Position::find($id);
        $this->validate($request,
            [
                'name'=>'required|max:30',    
            ],
            [
            'name.required'=>'not fill name',
            'name.max'=>'too long'
            ]);
        $position->name = $request->name;
        $position->update();       
       return redirect('admin/position/edit/'.$id)->with('note','edit success');
   }

    public function getAdd()
    {
    	return view('admin.position.add');
    }
    
    public function postAdd(Request $request)
    {
    	$this->validate($request,
    		[
    		'name'=>'required|min:3|max:30',
    		],
    		[
    		'name.required'=>'not fill name',
    		'name.max'=>'too long'
    		]);
    	$position= new Position;
        $position->name = $request->name; 	
        $position->save();
        return redirect('admin/position/add')->with('note','add success');
    }
    public function postXoa($id)
    {
        $position = Position::find($id);
        $position->delete();
        return redirect('admin/position/list')->with('note','delete success');
    }
}

