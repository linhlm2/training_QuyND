<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChucVu extends Model
{
    //
    protected $table ='chucvu';
    
    public function nhanvien(){
    	return $this->belongsTo('App\NhanVien','ma_chucvu','id_cv');
    }
}