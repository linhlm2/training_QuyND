<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    //
    protected $table ='position';
    
    public function staff(){
    	return $this->hasMany('App\Staff','id_position','id');
    }
}