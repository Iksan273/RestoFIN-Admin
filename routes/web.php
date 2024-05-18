<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::view('/','index')->name('dashboard');

// Master ADMIN ROUTE///
Route::view('/Master', 'Master.index')->name('master.dashboard');
Route::view('/Master-Member', 'Master.member')->name('master.member');
Route::view('/Master-Employee', 'Master.employee')->name('master.employee');

Route::view('/Master-EditEmployee','Master.edit_employee')->name('edit-employee');


//Menu Admin Route
Route::view('/Menu', 'Employee.menu')->name('employee.menu');
Route::view('/Menu-EditMenu','Employee.edit_menu')->name('employee.editMenu');
Route::view('/Menu-TambahMenu','Employee.add_menu')->name('employee.addMenu');

Route::view('/Rekomendasi-Menu','Employee.rekomendasi')->name('employee.rekomendasi');
Route::view('/Rekomendasi-EditMenu','Employee.edit_rekomendasi')->name('employee.editRekomendasi');
Route::view('/Rekomendasi-AddMenu','Employee.add_rekomendasi')->name('employee.addRekomendasi');

Route::view('/Promo','Employee.promo')->name('employee.promo');
Route::view('/Promo-editPromo','Employee.edit_promo')->name('employee.editPromo');
Route::view('/Promo-addPromo','Employee.add_promo')->name('employee.addPromo');

Route::view('/StrukPembelian','Employee.struk_pembelian')->name('employee.struk');
Route::view('/StrukPembelian-Add','Employee.add_strukPembelian')->name('employee.addStruk');

Route::view('/MemberPoint-Pengurangan','Employee.member_point')->name('employee.pointMinus');
Route::view('/MemberPoint-PenguranganAdmin','Employee.member_pointAdmin')->name('employee.pointMinusAdmin');

Route::view('/daftar-pesanan','Employee.daftar_pesanan')->name('employee.daftarPesanan');
Route::view('/daftar-pesanan-pending','Employee.daftar_pesananPending')->name('employee.daftarPesananPending');

Route::view('/daftar-transaksi','Employee.daftar_transaksi')->name('employee.daftarTransaksi');
Route::view('/daftar-pesanan-pending','Employee.daftar_pesananPending')->name('employee.daftarPesananPending');


Route::view('/reservasi','Employee.reservasi')->name('employee.reservasi');
Route::view('/reservasi-addReservasi','Employee.add_reservasi')->name('employee.addReservasi');
Route::view('/reservasi-editReservasi','Employee.edit_reservasi')->name('employee.editReservasi');

Route::get('/Login', function () {
    return view('Auth.Login');
});
