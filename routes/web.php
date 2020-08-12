<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Artisan;
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

Auth::routes();

Route::get('/home', 'HomeController@index')->middleware('verified')->name('home');

Route::get('/profile', 'ProfileController@index')->name('profile');
Route::put('/profile', 'ProfileController@update')->name('profile.update');
Route::get('/detail/{id}', 'HomeController@detail')->name('detail');
Route::get('/about', function () {
    return view('about');
})->name('about');
Route::get('/kelastersedia', 'HomeController@kelastersedia')->name('kelastersedia');
Auth::routes(['verify' => true]);

Route::get('/gembong', function () {
    return view('auth.login');
})->name('login.gembong');

Route::get('/admin', 'AdminController@index')->name('admin');
Route::get('/siswa', 'AdminController@siswa')->name('siswa');
Route::get('/kelas', 'AdminController@kelas')->name('kelas');
Route::post('/tugas', 'AdminController@tugas')->name('tugas');
Route::post('/materi', 'AdminController@materi')->name('materi');
Route::post('/jawaban', 'HomeController@jawaban')->name('jawaban');
Route::post('/kelas', 'AdminController@savekelas')->name('savekelas');
Route::get('/batch', 'AdminController@batch')->name('batch');
Route::post('/batch', 'AdminController@savebatch')->name('savebatch');
Route::get('/pembayaran', 'AdminController@pembayaran')->name('pembayaran');
Route::post('/carinama', 'AdminController@carinama')->name('carinama');
Route::get('/konfirm/{id}', 'AdminController@konfirm')->name('konfirm');
Route::get('/daftar/{id}/', 'HomeController@siswakelasbaru')->name('daftar');
Route::get('/detailkelas/{id}', 'AdminController@detailkelas')->name('detailkelas');

Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('config:clear');
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('config:cache');
    return 'DONE'; //Return anything
});
