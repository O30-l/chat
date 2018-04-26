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
    return view('home.login');
});

//注册页面
Route::get('/register/index','RegisterController@index');


//注册发送邮箱验证码
Route::post('/register/sendEmail','RegisterController@sendEmail');

//注册发送短信验证码
Route::post('/register/sendMobile','RegisterController@sendMobile');

Route::post('/register/verification','RegisterController@verification');

Route::post('/register/create','RegisterController@create');



//查看session
Route::get('/looksession',function(){
    dump($_SESSION);
});

Route::get('/logout',function(){
    unset($_SESSION['user']);
});
