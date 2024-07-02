<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\MemberPointController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PromoController;
use App\Http\Controllers\RecommendationController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\StrukOnlineController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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




Route::get('/login', [EmployeeController::class, 'showLoginForm'])->name('login');
Route::post('/login', [EmployeeController::class, 'login'])->name('login');
// Route::get('/check-new-orders', [OrderController::class, 'checkNewOrders']);


Route::get('/printNota/{id}', [OrderController::class, 'printNota'])->name('printNota');
Route::get('/printNotaKitchen/{id}', [OrderController::class, 'printNotaKitchen'])->name('printNotaKitchen');

Route::post('/logout', [EmployeeController::class, 'logout'])->name('logout');
Route::get('/get-sales-data', [DashboardController::class, 'getSalesData']);
Route::get('/get-yearly-sales-data', [DashboardController::class, 'getYearlySalesData']);
Route::get('/excel', [TransactionController::class, 'excel_export'])->name('exportExcel');
// // Master ADMIN ROUTE///
// Route::view('/Master', 'Master.index')->name('master.dashboard');
// Route::view('/Master-Member', 'Master.member')->name('master.member');
// Route::view('/Master-Employee', 'Master.employee')->name('master.employee');

// Route::view('/Master-EditEmployee', 'Master.edit_employee')->name('edit-employee');


Route::middleware(['role:Master'])->group(function () {
    Route::get('/register', [EmployeeController::class, 'showRegisterForm'])->name('add.employee');
    Route::post('/register', [EmployeeController::class, 'register'])->name('register');
    Route::get('/', [DashboardController::class, 'dashboard'])->name('dashboard');


    // Master ADMIN ROUTE///
    Route::get('/Master', [DashboardController::class, 'index'])->name('master.dashboard');
    Route::get('/Master-Member', [UserController::class, 'index'])->name('master.member');
    Route::get('/Master-Employee', [EmployeeController::class, 'employee'])->name('master.employee');
    Route::put('/Master-Employee/{id}', [EmployeeController::class, 'update'])->name('employee.update');
    Route::delete('/Master-Employee/Delete/{id}', [EmployeeController::class, 'delete'])->name('employee.delete');
    Route::get('/Master-EditEmployee/{id}', [EmployeeController::class, 'edit'])->name('edit-employee');

    //Menu Admin Route
    Route::get('/AdminMenu', [MenuController::class, 'index'])->name('employee.menu');
    Route::get('/Menu-EditMenu/{id}', [MenuController::class, 'edit'])->name('employee.editMenu');
    Route::get('/Menu-TambahMenu', [MenuController::class, 'create'])->name('employee.addMenu');
    Route::post('/Menu-Store', [MenuController::class, 'store'])->name('menu.store');
    Route::put('/Menu-Update/{id}', [MenuController::class, 'update'])->name('menu.update');
    Route::delete('/Menu-Delete/{id}', [MenuController::class, 'destroy'])->name('menu.delete');
    //route untuk kategori
    Route::get('/Kategori', [CategoryController::class, 'index'])->name('employee.kategori');
    Route::get('/Kategori/editKategori/{id}', [CategoryController::class, 'edit'])->name('edit.kategori');
    Route::get('/Kategori-TambahKategori', [CategoryController::class, 'create'])->name('employee.addKategori');
    Route::post('/Kategori-Store', [CategoryController::class, 'store'])->name('kategori.store');
    Route::put('/Kategori-Update/{id}', [CategoryController::class, 'update'])->name('kategori.update');
    Route::delete('/Kategori-Delete/{id}', [CategoryController::class, 'destroy'])->name('kategori.delete');

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

    //route untuk memberpoint
    Route::post('/MemberPoint-StoreAdd', [MemberPointController::class, 'tambahPoint'])->name('memberpoint.addPoint');
    Route::post('/MemberPoint-Store', [MemberPointController::class, 'store'])->name('memberpoint.minusAdmin');
    Route::post('/MemberPoint-MinusPromo', [MemberPointController::class, 'minusPromo'])->name('memberpoint.minusPromo');
    Route::post('/MemberPoint-MinusPromoDouble', [MemberPointController::class, 'minusPromoDouble'])->name('memberpoint.minusPromoDouble');
    Route::get('/MemberPoint-Pengurangan', [MemberPointController::class, 'formPoinPromo'])->name('employee.pointMinus');
    Route::view('/MemberPoint-PenguranganAdmin', 'Employee.member_pointAdmin')->name('employee.pointMinusAdmin');
    Route::view('/MemberPoint-PenambahanAdmin', 'Employee.add_memberPoint')->name('employee.pointAddAdmin');
    Route::post('/fetch-user', [MemberPointController::class, 'checkMember'])->name('fetch-user');

    //ROUTE UNTUK PESANAN
    Route::get('/daftar-pesanan', [OrderController::class, 'getOrderLunas'])->name('employee.daftarPesanan');
    Route::get('/daftar-pesanan-pending', [OrderController::class, 'getOrderBelumBayar'])->name('employee.daftarPesananPending');
    Route::get('/daftar-pesanan-selesai', [OrderController::class, 'getOrderSelesai'])->name('employee.daftarPesananSelesai');
    Route::put('/daftar-pesanan-lunas/{id}', [OrderController::class, 'updateStatusPembayaranLunas'])->name('order.updateLunas');
    Route::put('/daftar-pesanan-selesai/{id}', [OrderController::class, 'updateStatusMakananSelesai'])->name('order.updateSelesai');
    Route::delete('/hapus-pesanan/{id}', [OrderController::class, 'deleteOrder'])->name('order.delete');
    Route::get('/download-nota/{id}', [OrderController::class, 'downloadNota'])->name('download-nota');
    Route::get('/daftar-transaksi', [TransactionController::class, 'index'])->name('employee.daftarTransaksi');
    Route::view('/nota', 'Layouts.invoice')->name('nota');
    Route::get('/order', [OrderController::class, 'orderForm'])->name('employee.Addorder');
    Route::post('/order/store', [OrderController::class, 'store'])->name('employee.StoreOrder');

    // route untuk reservasi
    Route::get('/reservasi-Employee', [ReservationController::class, 'index'])->name('employee.reservasi');
    Route::get('/reservasi/tambahReservasi', [ReservationController::class, 'create'])->name('employee.addReservasi');
    Route::post('/reservasi/store', [ReservationController::class, 'store'])->name('reservasi.store');
    Route::get('/reservasi/editReservasi/{id}', [ReservationController::class, 'edit'])->name('employee.editReservasi');
    Route::put('/reservasi/update/{id}', [ReservationController::class, 'update'])->name('reservasi.update');
    Route::put('/reservasi/accept/{id}', [ReservationController::class, 'acceptReservation'])->name('reservasi.accept');
    Route::delete('/reservasi/delete/{id}', [ReservationController::class, 'destroy'])->name('reservasi.delete');

    // Route untuk Struk Online
    Route::get('/struk-online', [StrukOnlineController::class, 'index'])->name('employee.struk');
    Route::view('/StrukPembelian-Add', 'Employee.add_strukPembelian')->name('employee.addStruk');
    Route::post('/struk-online/store', [StrukOnlineController::class, 'store'])->name('struk.store');
    Route::put('/struk-online/update/{id}', [StrukOnlineController::class, 'updatePointdanStatus'])->name('struk.update');
    Route::delete('/struk-online/delete/{id}', [StrukOnlineController::class, 'destroy'])->name('struk.delete');
});

Route::middleware(['role:Employee'])->group(function () {
    Route::get('/', [DashboardController::class, 'dashboard'])->name('dashboard');
    //Menu Admin Route
    Route::get('/AdminMenu', [MenuController::class, 'index'])->name('employee.menu');
    Route::get('/Menu-EditMenu/{id}', [MenuController::class, 'edit'])->name('employee.editMenu');
    Route::get('/Menu-TambahMenu', [MenuController::class, 'create'])->name('employee.addMenu');
    Route::post('/Menu-Store', [MenuController::class, 'store'])->name('menu.store');
    Route::put('/Menu-Update/{id}', [MenuController::class, 'update'])->name('menu.update');
    Route::delete('/Menu-Delete/{id}', [MenuController::class, 'destroy'])->name('menu.delete');
    //route untuk kategori
    Route::get('/Kategori', [CategoryController::class, 'index'])->name('employee.kategori');
    Route::get('/Kategori/editKategori/{id}', [CategoryController::class, 'edit'])->name('edit.kategori');
    Route::get('/Kategori-TambahKategori', [CategoryController::class, 'create'])->name('employee.addKategori');
    Route::post('/Kategori-Store', [CategoryController::class, 'store'])->name('kategori.store');
    Route::put('/Kategori-Update/{id}', [CategoryController::class, 'update'])->name('kategori.update');
    Route::delete('/Kategori-Delete/{id}', [CategoryController::class, 'destroy'])->name('kategori.delete');

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
    // route untuk member point
    //route untuk memberpoint
    Route::post('/MemberPoint-Store', [MemberPointController::class, 'store'])->name('memberpoint.minusAdmin');
    Route::post('/MemberPoint-MinusPromo', [MemberPointController::class, 'minusPromo'])->name('memberpoint.minusPromo');
    Route::post('/MemberPoint-MinusPromoDouble', [MemberPointController::class, 'minusPromoDouble'])->name('memberpoint.minusPromoDouble');
    Route::get('/MemberPoint-Pengurangan', [MemberPointController::class, 'formPoinPromo'])->name('employee.pointMinus');
    Route::view('/MemberPoint-PenguranganAdmin', 'Employee.member_pointAdmin')->name('employee.pointMinusAdmin');
    Route::post('/fetch-user', [MemberPointController::class, 'checkMember'])->name('fetch-user');
    //route untuk pesanan
    Route::get('/daftar-pesanan', [OrderController::class, 'getOrderLunas'])->name('employee.daftarPesanan');
    Route::get('/daftar-pesanan-pending', [OrderController::class, 'getOrderBelumBayar'])->name('employee.daftarPesananPending');
    Route::get('/daftar-pesanan-selesai', [OrderController::class, 'getOrderSelesai'])->name('employee.daftarPesananSelesai');
    Route::put('/daftar-pesanan-lunas/{id}', [OrderController::class, 'updateStatusPembayaranLunas'])->name('order.updateLunas');
    Route::put('/daftar-pesanan-selesai/{id}', [OrderController::class, 'updateStatusMakananSelesai'])->name('order.updateSelesai');
    Route::get('/download-nota/{id}', [OrderController::class, 'downloadNota'])->name('download-nota');
    Route::delete('/hapus-pesanan/{id}', [OrderController::class, 'deleteOrder'])->name('order.delete');


    Route::get('/daftar-transaksi', [TransactionController::class, 'index'])->name('employee.daftarTransaksi');

    Route::view('/nota', 'Layouts.invoice')->name('nota');

    // Route untuk Reservasi
    Route::get('/reservasi-Employee', [ReservationController::class, 'index'])->name('employee.reservasi');
    Route::get('/reservasi/tambahReservasi', [ReservationController::class, 'create'])->name('employee.addReservasi');
    Route::post('/reservasi/store', [ReservationController::class, 'store'])->name('reservasi.store');
    Route::get('/reservasi/editReservasi/{id}', [ReservationController::class, 'edit'])->name('employee.editReservasi');
    Route::put('/reservasi/update/{id}', [ReservationController::class, 'update'])->name('reservasi.update');
    Route::put('/reservasi/accept/{id}', [ReservationController::class, 'acceptReservation'])->name('reservasi.accept');
    Route::delete('/reservasi/delete/{id}', [ReservationController::class, 'destroy'])->name('reservasi.delete');

    // Route untuk Struk Online
    Route::get('/struk-online', [StrukOnlineController::class, 'index'])->name('employee.struk');
    Route::view('/StrukPembelian-Add', 'Employee.add_strukPembelian')->name('employee.addStruk');
    Route::post('/struk-online/store', [StrukOnlineController::class, 'store'])->name('struk.store');
    Route::put('/struk-online/update/{id}', [StrukOnlineController::class, 'updatePointdanStatus'])->name('struk.update');
    Route::delete('/struk-online/delete/{id}', [StrukOnlineController::class, 'destroy'])->name('struk.delete');
});
