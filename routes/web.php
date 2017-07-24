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
	Route::get('list','StaffController@getList')->name('admin.staff.list.get');
	Route::get('edit/{id}','StaffController@getEdit')->name('admin.staff.edit.get');
	Route::post('edit/{id}','StaffController@postEdit')->name('admin.staff.edit.post');
	Route::get('add','StaffController@getAdd')->name('admin.staff.add.get');
	Route::post('add','StaffController@postAdd')->name('admin.staff.add.post');
	Route::get('delete/{id}','StaffController@postDelete')->name('admin.staff.delete.get');
        Route::get('adminreset','StaffController@getAdminReset')->name('admin.staff.resetaccount.get');
	Route::post('adminreset','StaffController@postAdminReset')->name('admin.staff.resetaccount.post');
    });
    Route::group(['prefix'=>'position'],function()
    {
	Route::get('list','PositionController@getList')->name('admin.position.list.get');
	Route::get('edit/{id}','PositionController@getEdit')->name('admin.position.edit.get');
	Route::post('edit/{id}','PositionController@postEdit')->name('admin.position.edit.post');
	Route::get('add','PositionController@getAdd')->name('admin.position.add.get');
	Route::post('add','PositionController@postAdd')->name('admin.position.add.post');
	Route::get('delete/{id}','PositionController@postDelete')->name('admin.position.delete.get');
    }); 
    Route::group(['prefix'=>'department'],function()
    {
	Route::get('list','DepartmentController@getList')->name('admin.department.list.get');
	Route::get('edit/{id}','DepartmentController@getEdit')->name('admin.department.edit.get');
	Route::post('edit/{id}','DepartmentController@postEdit')->name('admin.department.edit.post');
	Route::get('add', 'DepartmentController@getAdd')->name('admin.department.add.get');
	Route::post('add','DepartmentController@postAdd')->name('admin.department.add.post');
	Route::get('delete/{id}','DepartmentController@postDelete')->name('admin.department.delete.get');
    });  
    
});

Route::group(['prefix'=>'user','middleware'=>'UserMiddleware'],function()
{
    Route::group(['prefix'=>'excel'],function()
    {
	Route::get('export','StaffController@getExport')->name('user.exportfile.get');
	Route::post('export','StaffController@postExport')->name('user.exportfile.post');
    });
    Route::get('edit','UserController@getEditUser')->name('user.edit.get');
    Route::post('edit','UserController@postEditUser')->name('user.edit.post');
    Route::get('liststaff','UserController@getListStaff')->name('user.liststaff.get');
});

Route::post('resetpassword','UserController@postResetPassword')->name('user.resetpassword.post');
Route::get('resetpassword','UserController@getResetPassword')->name('user.resetpassword.get');
    
Route::get('admin/loginadmin','UserController@getAdminlogin')->name('admin.login.get');
Route::post('admin/loginadmin','UserController@postAdminlogin')->name('admin.login.post');
Route::get('login','UserController@getLogin')->name('user.login.get');
Route::post('login','UserController@postLogin')->name('user.login.post');
Route::get('logout','UserController@getLogOut')->name('logout.get');
Route::post('sendmail','SendMailController@postSendMail')->name('findaccount.sendmail.post');
Route::get('sendmail','SendMailController@getSendMail')->name('findaccount.sendmail.get');
Route::post('resetlogin','SendMailController@postResetLogin')->name('resetpass.post');
Route::get('resetlogin','SendMailController@getResetLogin')->name('resetpass.get');