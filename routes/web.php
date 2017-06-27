<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::group(['prefix'=>'admin'],function(){
//        Route::get('danhsachnhanvien','DanhSachController@getDanhSach');
        
	Route::group(['prefix'=>'nhanvien'],function(){

		Route::get('xem','DanhSachController@getDanhSach');

		Route::get('sua/{id}','DanhSachController@getSua');
		Route::post('sua/{id}','DanhSachController@postSua');

		Route::get('them','DanhSachController@getThem');
		Route::post('them','DanhSachController@postThem');

		Route::get('xoa/{id}','DanhSachController@postXoa');
	});

	    
});
