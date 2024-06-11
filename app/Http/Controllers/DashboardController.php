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

        $promo = Promo::all();
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
    public function getSalesData(Request $request)
    {
        $month = $request->query('month');
        $monthNumber = date('m', strtotime($month));

        $salesData = DB::table('transactions')
            ->select(DB::raw('DAY(order_date) as day'), DB::raw('SUM(total_amount) as sales'))
            ->whereYear('order_date', now()->year)
            ->whereMonth('order_date', $monthNumber)
            ->groupBy(DB::raw('DAY(order_date)'))
            ->orderBy(DB::raw('DAY(order_date)'))
            ->get();

        $data = [['Day', 'Omset']];
        if ($salesData->isEmpty()) {
            return response()->json($data);
        }

        foreach ($salesData as $sales) {
            $data[] = [(int)$sales->day, (float)$sales->sales];
        }

        return response()->json($data);
    }
    public function getYearlySalesData(Request $request)
    {
        // Retrieve the selected year from the query string
        $selectedYear = $request->query('year', date('Y'));

        // Query your database to fetch yearly sales data
        $yearlySalesData = DB::table('transactions')
            ->select(DB::raw('MONTH(order_date) as month'), DB::raw('SUM(total_amount) as sales'))
            ->whereYear('order_date', $selectedYear)
            ->groupBy(DB::raw('MONTH(order_date)'))
            ->orderBy(DB::raw('MONTH(order_date)'))
            ->get();

        $data = [];
        $formattedData = [];

        foreach ($yearlySalesData as $sales) {
            // Simpan nilai asli dalam array $data
            $data[] = (float) $sales->sales;

            // Format nilai dengan mata uang Rupiah
            $formattedData[] =number_format($sales->sales, 0, ',', '.');
        }

        // Return both original and formatted data as JSON response
        return response()->json(['data' => $data, 'formattedData' => $formattedData]);
    }
}
