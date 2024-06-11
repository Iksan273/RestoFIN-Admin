<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Promo;
use App\Models\Review;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    public function index()
    {
        $todayOrders = Order::whereDate('order_date', today())->get();
        $totalOrdersToday = $todayOrders->count();
        $todaySales = Transaction::whereDate('order_date', today())->sum('total_amount');
        $averageRating = Review::avg('rating');
        $totalMembers = User::count();
        $todayOrders = Order::whereMonth('order_date', now()->month)->get();
        $totalOrdersThisMonth = $todayOrders->count();
        $lastMonthOrders = Order::whereMonth('order_date', now()->subMonth()->month)->get();
        $totalLastMonthOrders = $lastMonthOrders->count();
        $percentageIncrease = $totalLastMonthOrders != 0 ? number_format((($totalOrdersThisMonth - $totalLastMonthOrders) / $totalLastMonthOrders) * 100, 2) : 0;

        return view('Master.index', [
            'todayOrders' => $todayOrders,
            'totalOrdersToday' => $totalOrdersToday,
            'todaySales' => $todaySales,
            'averageRating' => $averageRating,
            'totalMembers' => $totalMembers,
            'totalOrdersThisMonth' => $totalOrdersThisMonth,
            'totalLastMonthOrders' => $totalLastMonthOrders,
            'percentageIncrease' => $percentageIncrease,
        ]);
    }
    public function dashboard()
    {
        $todayOrders = Order::whereDate('order_date', today())->get();
        $totalOrdersToday = $todayOrders->count();
        $todaySales = Transaction::whereDate('order_date', today())->sum('total_amount');
        $averageRating = Review::avg('rating');
        $totalMembers = User::count();
        $todayOrders = Order::whereMonth('order_date', now()->month)->get();
        $totalOrdersThisMonth = $todayOrders->count();
        $lastMonthOrders = Order::whereMonth('order_date', now()->subMonth()->month)->get();
        $totalLastMonthOrders = $lastMonthOrders->count();
        $percentageIncrease = $totalLastMonthOrders != 0 ? number_format((($totalOrdersThisMonth - $totalLastMonthOrders) / $totalLastMonthOrders) * 100, 2) : 0;
        $topItems = OrderItem::select('menus_id', DB::raw('COUNT(*) as order_count'))
            ->groupBy('menus_id')
            ->orderBy('order_count', 'desc')
            ->with('menu')
            ->get();

        $promo=Promo::all();
        // dd($topItems);
        return view('index', [
            'promo' => $promo,
            'topMenu' => $topItems,
            'todayOrders' => $todayOrders,
            'totalOrdersToday' => $totalOrdersToday,
            'todaySales' => $todaySales,
            'averageRating' => $averageRating,
            'totalMembers' => $totalMembers,
            'totalOrdersThisMonth' => $totalOrdersThisMonth,
            'totalLastMonthOrders' => $totalLastMonthOrders,
            'percentageIncrease' => $percentageIncrease,
        ]);
    }
}
