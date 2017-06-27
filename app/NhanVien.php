<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

class NhanVien extends Model
{
    //
    protected $table ='nhanvien';
    public function phongban(){
    	return $this->belongsTo('App\PhongBan','ma_phongban','id_pb');
    }
    public function chucvu(){
    	return $this->belongsTo('App\ChucVu','ma_chucvu','id_cv');
    }
}