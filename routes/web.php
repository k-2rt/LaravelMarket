<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function() {
    return view('welcome');
});

Auth::routes();
Route::get('home', 'HomeController@index')->name('home');

Route::get('password-change', 'Auth\ChangePasswordController@index')->name('password.change');

Route::post('password-change', 'Auth\ChangePasswordController@changePassword')->name('password.change');

Route::get('user/logout', 'HomeController@logout')->name('user.logout');

// Admin Route
Route::get('admin/home', 'AdminController@index');

Route::get('admin', 'Admin\LoginController@showLoginForm')->name('admin.login');
Route::post('admin', 'Admin\LoginController@login');
Route::get('admin/logout', 'AdminController@logout')->name('admin.logout');

// Password Reset Routes
Route::get('admin/password/change','AdminController@showChangePasswordForm')->name('admin.password.change');
// Route::get('admin/Change/Password','AdminController@ChangePassword')->name('admin.password.change');
Route::post('admin/password/change','AdminController@changePassword')->name('admin.password.change');



Route::get('admin/password/reset', 'Admin\ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
// Route::post('admin-password/email', 'Admin\ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
// Route::get('admin/reset/password/{token}', 'Admin\ResetPasswordController@showResetForm')->name('admin.password.reset');
// Route::post('admin/update/reset', 'Admin\ResetPasswordController@reset')->name('admin.reset.update');
