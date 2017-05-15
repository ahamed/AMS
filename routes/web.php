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
    //return view('welcome');
});




Auth::routes();
/*Route::post('/register','Auth\RegisterController@register');*/


//Route::post('/register','Auth\RegisterController@register');

Route::get('/', 'HomeController@index')->name('home');
Route::get('/show','HomeController@show');
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');




//route section for user role 2(admin)
Route::get('create-member','MemberController@createMember');
Route::post('set-member','MemberController@setMember');
Route::get('get-member/{id}','MemberController@getMember');
Route::get('member-list','MemberController@memberList');
Route::get('admin-reports-view','AppointmentController@adminReportsView');
Route::get('admin-report/{id1}/{id2}/{id3}','AppointmentController@adminReport');



//route sector for user role 3 (operator)
Route::get('create-visitor','VisitorController@createVisitor');
Route::get('get-member-list/{id}','VisitorController@getMemberList');
Route::get('get-visitor/{id}','VisitorController@getVisitor');
Route::post('set-visitor','VisitorController@setVisitor');
Route::get('visitor-list','VisitorController@visitorList');
Route::get('get-visitor-list','AppointmentController@getVisitorList');
Route::get('deo-institute-list','AppointmentController@deoInstituteList');
Route::get('deo-member-list/{id}','AppointmentController@deoMemberList');
Route::get('deo-reports-view','AppointmentController@deoReportsView');
Route::get('deo-report/{id1}/{id2}/{id3}','AppointmentController@deoReport');


//verify
Route::get('/getVerify/{id}','VerificationController@getVerify');

Route::post('/setVerify','VerificationController@verify');




//Route::post('/login','\App\Http\Controllers\Auth\LoginController@authenticate');


//accept or reject
Route::get('set-accept/{id}','AppointmentController@setAccept');
Route::get('set-reject/{id}','AppointmentController@setReject');


//Appointee report view
Route::get('appointee-reports-view','AppointmentController@appointeeReportsView');
Route::get('appointee-report/{id1}/{id2}/{id3}','AppointmentController@appointeeReport');
