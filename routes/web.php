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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes([
    'register'=>false,
    'reset'=>false
]);

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/kategori','HomeController@kategori')->name('kategori');
Route::get('/kategori/tambah','HomeController@kategori_tambah');
Route::post('/kategori/aksi','HomeController@kategori_aksi');
Route::get('/kategori/edit/{id}','HomeController@kategori_edit');
Route::put('/kategori/update/{id}','HomeController@kategori_update');
Route::get('/kategori/hapus/{id}','HomeController@kategori_hapus');


Route::get('/transaksi','HomeController@transaksi');
Route::get('/transaksi/tambah','HomeController@transaksi_tambah');
Route::post('/transaksi/aksi','HomeController@transaksi_aksi');
Route::get('/transaksi/edit/{id}','HomeController@edit');
Route::put('/transaksi/update/{id}','HomeController@transaksi_update');
Route::get('/transaksi/hapus/{id}','HomeController@transaksi_hapus');

//routing pencarian
Route::get('/transaksi/cari','HomeController@cari');

// routing cetak laporan
Route::get('/laporan','HomeController@laporan');
Route::get('/laporan/hasil','HomeController@laporan_hasil');

//Ganti Password
Route::get('/ganti_password','HomeController@ganti_password');
Route::post('/ganti_password/aksi','HomeController@ganti_password_aksi');