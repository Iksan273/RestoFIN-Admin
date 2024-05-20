<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PromoController;
use App\Http\Controllers\RecommendationController;
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
Route::get('/AdminMenu', [MenuController::class, 'index'])->name('employee.menu');
Route::get('/Menu-EditMenu/{id}', [MenuController::class, 'edit'])->name('employee.editMenu');
Route::get('/Menu-TambahMenu', [MenuController::class, 'create'])->name('employee.addMenu');
Route::post('/Menu-Store', [MenuController::class, 'store'])->name('menu.store');
Route::put('/Menu-Update/{id}', [MenuController::class, 'update'])->name('menu.update');
Route::delete('/Menu-Delete/{id}', [MenuController::class, 'destroy'])->name('menu.delete');

Route::get('/Kategori',[CategoryController::class, 'index'])->name('employee.kategori');
Route::get('/Kategori/editKategori/{id}', [CategoryController::class, 'edit'])->name('edit.kategori');
Route::get('/Kategori-TambahKategori',[CategoryController::class, 'create'])->name('employee.addKategori');
Route::post('/Kategori-Store',[CategoryController::class, 'store'])->name('kategori.store');
Route::put('/Kategori-Update/{id}',[CategoryController::class, 'update'])->name('kategori.update');
Route::delete('/Kategori-Delete/{id}',[CategoryController::class, 'destroy'])->name('kategori.delete');

// Route untuk Rekomendasi
Route::get('/Rekomendasi', [RecommendationController::class, 'index'])->name('employee.rekomendasi');
Route::get('/Rekomendasi/editRekomendasi/{id}', [RecommendationController::class, 'edit'])->name('employee.editRekomendasi');
Route::get('/Rekomendasi/tambahRekomendasi', [RecommendationController::class, 'create'])->name('employee.addRekomendasi');
Route::post('/Rekomendasi/store', [RecommendationController::class, 'store'])->name('rekomendasi.store');
Route::put('/Rekomendasi/update/{id}', [RecommendationController::class, 'update'])->name('rekomendasi.update');
Route::delete('/Rekomendasi/delete/{id}', [RecommendationController::class, 'destroy'])->name('rekomendasi.delete');

// Route untuk Promo
Route::get('/promo-employee', [PromoController::class, 'index'])->name('employee.promo');
Route::get('/Promo/editPromo/{id}', [PromoController::class, 'edit'])->name('employee.editPromo');
Route::get('/Promo/tambahPromo', [PromoController::class, 'create'])->name('employee.addPromo');
Route::post('/Promo/store', [PromoController::class, 'store'])->name('promo.store');
Route::put('/Promo/update/{id}', [PromoController::class, 'update'])->name('promo.update');
Route::delete('/Promo/delete/{id}', [PromoController::class, 'destroy'])->name('promo.delete');

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
