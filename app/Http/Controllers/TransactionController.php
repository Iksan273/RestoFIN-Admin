<?php

namespace App\Http\Controllers;

use App\Exports\TransactionsExport;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::all();
        return view('Employee.daftar_transaksi', compact('transactions'));
    }
    public function excel_export(Request $request)

    {
        $month = $request->input('month');
        $year = $request->input('year');

        return Excel::download(new TransactionsExport($month, $year), 'transactions_' . $month . '_' . $year . '.xlsx');
    }
}
