<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Barryvdh\DomPDF\Facade as PDF;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Barryvdh\DomPDF\PDF as DomPDFPDF;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    public function getOrderLunas()
    {
        $order = Order::where('status_pembayaran', 'Lunas')->where('status_makanan', 'Proses')->get();
        return view('Employee.daftar_pesanan', compact('order'));
    }


    public function getOrderBelumBayar()
    {
        $order = Order::where('status_pembayaran', 'Belum Bayar')->get();
        return view('Employee.daftar_pesananPending', compact('order'));
    }


    public function getOrderSelesai()
    {
        $order = Order::where('status_makanan', 'Selesai')->get();
        return view('Employee.daftar_pesananSelesai', compact('order'));
    }
    public function updateStatusPembayaranLunas($id)
    {
        $order = Order::findOrFail($id);
        $order->status_pembayaran = 'Lunas';
        $order->save();

        return redirect()->route('employee.daftarPesanan')->with('success', 'Status pembayaran telah diupdate menjadi Lunas.');
    }

    public function updateStatusMakananSelesai($id)
    {
        $order = Order::findOrFail($id);
        $order->status_makanan = 'Selesai';
        $order->save();

        return redirect()->route('employee.daftarPesanan')->with('success', 'Status makanan telah diupdate menjadi Selesai.');
    }

    public function deleteOrder($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return redirect()->route('employee.daftarPesanan')->with('success', 'Order berhasil dihapus.');
    }
    public function downloadNota($id)
    {
        $order = Order::findOrFail($id); // Menggunakan findOrFail untuk menghandle kasus jika order tidak ditemukan
        $pdf = FacadePdf::loadView('Layouts.nota', compact('order'));
        return $pdf->download('nota-order-' . $id. '.pdf'); // Menambahkan ID order pada nama file untuk memudahkan identifikasi
    }

    public function printNota($id)
    {
        $order = Order::findOrFail($id); // Menggunakan findOrFail untuk menghandle kasus jika order tidak ditemukan
        $pdf = FacadePdf::loadView('Layouts.nota', compact('order'));
        return $pdf->stream('nota-order-' . $id. '.pdf'); // Menampilkan PDF di browser
    }
}
