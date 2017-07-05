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
Route::group(['prefix'=>'admin','middleware'=>'AdminMiddleware'],function(){
       
    Route::group(['prefix'=>'staff'],function()
    {
	Route::get('list','StaffController@getList');
	Route::get('edit/{id}','StaffController@getEdit');
	Route::post('edit/{id}','StaffController@postEdit');
	Route::get('add','StaffController@getAdd');
	Route::post('add','StaffController@postAdd');
	Route::get('delete/{id}','StaffController@postDelete');
    });
    Route::group(['prefix'=>'position'],function()
    {
	Route::get('list','PositionController@getList');
	Route::get('edit/{id}','PositionController@getEdit');
	Route::post('edit/{id}','PositionController@postEdit');
	Route::get('add','PositionController@getAdd');
	Route::post('add','PositionController@postAdd');
	Route::get('delete/{id}','PositionController@postDelete');
    }); 
    Route::group(['prefix'=>'department'],function()
    {
	Route::get('list','DepartmentController@getList');
	Route::get('edit/{id}','DepartmentController@getEdit');
	Route::post('edit/{id}','DepartmentController@postEdit');
	Route::get('add', 'DepartmentController@getAdd')->name('department.add');
	Route::post('add','DepartmentController@postAdd');
	Route::get('delete/{id}','DepartmentController@postDelete');
    });  
});
Route::group(['prefix'=>'user','middleware'=>'UserMiddleware'],function()
{
    Route::get('edit','UserController@getEditUser');
    Route::post('edit','UserController@postEditUser')->name('postedit');
    Route::get('liststaff','UserController@getListStaff');
});
Route::get('admin/loginadmin','UserController@getAdminlogin');
Route::post('admin/loginadmin','UserController@postAdminlogin');
Route::get('login','UserController@getLogin');
Route::post('login','UserController@postLogin');
Route::get('logout','UserController@getLogOut');
Route::post('resetpassword','UserController@postResetPassword');
Route::get('resetpassword','UserController@getResetPassword');
Route::post('sendmail','SendMailController@postSendMail');
Route::get('sendmail','SendMailController@getSendMail');
