<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\NhanVien;
use App\PhongBan;

class DanhSachController extends Controller
{
 
    
  

    public function getDanhSach(){
 		 $danhsach = NhanVien::all();
 		 
    	return view('admin.nhanvien.danhsach',['danhsach'=>$danhsach]);
    }

    public function getSua($id){
        $nhanvien = NhanVien::find($id);
        return view('admin.nhanvien.sua',['nhanvien'=>$nhanvien]);
    }
    public function postSua(Request $request,$id){
        $theloai = NhanVien::find($id);
        $this->validate($request,
            [
                'hoten'=>'required|unique:NhanVien,hoten|min:3|max:100'
            ],
            [
            'hoten.required'=>'Bạn chưa nhập tên thể loại',
            'hoten.unique'=>'Tên thể loại đã tồn tại',
            'hoten.min'=>'Độ dài phải có độ dài từ 3 đến 100 kí tự',
            'hoten.max'=>'Độ dài phải có độ dài từ 3 đến 100 kí tự'
            ]);
        $theloai->hoten = $request->hoten;
//        $theloai->TenKhongDau =changeTitle($request->Ten);
        $theloai->save();

        return redirect('admin/theloai/sua/'.$id)->with('thongbao','Sửa thành công');


    }

    public function getThem(){
    	return view('admin.theloai.them');

    }
    public function postThem(Request $request){
    	$this->validate($request,
    		[
    			'Ten'=>'required|unique:TheLoai,Ten|min:3|max:100'
    		],
    		[
    			'Ten.required'=>'Bạn chưa nhập thể loại',
                'Ten.unique'=>'Tên thể loại đã tồn tại',
    			'Ten.min'=>'Độ dài phải có độ dài từ 3 đến 100 kí tự',
    			'Ten.max'=>'Độ dài phải có độ dài từ 3 đến 100 kí tự'
    		]);
    	$theloai= new TheLoai;
    	$theloai->Ten = $request->Ten;
    	$theloai->TenKhongDau = changeTitle($request->Ten);
        $theloai->save();
        return redirect('admin/theloai/them')->with('thongbao','Thêm thành công');
    }
    public function postXoa($id){
        $theloai = TheLoai::find($id);
        $theloai->delete();
        return redirect('admin/nhanvien/xem')->with('thongbao','Đã xoá thành công');
    }
}

