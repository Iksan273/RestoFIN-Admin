<?php

namespace App\Exports;

use App\Models\Order;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

// class TransactionsExport implements FromCollection
// {
//     /**
//      * @return \Illuminate\Support\Collection
//      */
//     public function collection()
//     {
//         Log::info('Fetching orders data');

//         return Order::select('order_number', 'total_price', 'payment_method', 'order_date','status_pembayaran')
//             ->get();
//     }

//     /**
//      * Define the headings for the columns.
//      *
//      * @return array
//      */
//     public function headings(): array
//     {
//         Log::info('Defining column headings');

//         return [
//             'Order Number',
//             'Payment Method',
//             'Total Amount',
//             'Status',
//             'Order Date'
//         ];
//     }

//     /**
//      * Map the data to the format you want.
//      *
//      * @param \App\Models\Order $order
//      * @return array
//      */
//     public function map($order): array
//     {
//         Log::info('Mapping order data');

//         return [
//             $order->order_number,
//             ucfirst($order->payment_method),
//             number_format($order->total_price, 2),
//             ucfirst($order->status_makanan),
//             Carbon::parse($order->order_date)->format('Y-m-d')
//         ];
//     }
// }
class TransactionsExport implements FromView,ShouldAutoSize
{
    protected $month;
    protected $year;

    public function __construct($month, $year)
    {
        $this->month = $month;
        $this->year = $year;
    }

    public function view(): View
    {
        return view('Excel.table', [
            'transactions' => Transaction::whereMonth('order_date', $this->month)
                                         ->whereYear('order_date', $this->year)
                                         ->get()
        ]);
    }
}
