<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Reservation;
use App\Models\StrukOnline;
use Illuminate\Http\Request;

class CheckController extends Controller
{
    public function getPendingOrders()
    {
        $pendingOrders = Order::where('status_pembayaran', 'Belum Bayar')->count();

        return response()->json(['pendingOrders' => $pendingOrders]);
    }

    public function getFoodStatus()
    {
        // Logika untuk mendapatkan status makanan
        $foodStatus = Order::where('status_makanan', 'proses')->where('status_pembayaran', 'lunas')->count();

        return response()->json(['foodStatus' => $foodStatus]);
    }

    public function getAllOrderStatus() {
        $pendingOrders = Order::where('status_pembayaran', 'Belum Bayar')->count();
        $foodStatus = Order::where('status_makanan', 'proses')->where('status_pembayaran', 'lunas')->count();
        $allOrders = $pendingOrders + $foodStatus;

        return response()->json(['allOrders' => $allOrders]);
    }

    public function getReserveStatus()
    {
        // Logika untuk mendapatkan status reservasi
        $reserveStatus = Reservation::where('status', 'Pending')->count();

        return response()->json(['reserveStatus' => $reserveStatus]);
    }

    public function getStrukStatus() {
        // Logika untuk mendapatkan status struk online
        $strukStatus = StrukOnline::where('status', 'Pending')->count();

        return response()->json(['strukStatus' => $strukStatus]);
    }
}
