<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\MemberPoint;
use App\Models\Menu;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Transaction;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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

    public function updateStatusPembayaranLunas(Request $request, $id)
    {
        try {

            $validatedData = $request->validate([
                'metode_pembayaran' => 'required|string',
                'user_id' => 'nullable|integer',
                'total_price' => 'required|numeric',
                'order_id' => 'required|integer'
            ]);
            $order = Order::findOrFail($id);
            $order->status_pembayaran = 'Lunas';
            $order->payment_method = $request->metode_pembayaran;
            $order->save();

            $transaction = Transaction::where('orders_id', $request->order_id)->first();
            $transaction->status = 'Lunas';
            $transaction->payment_method = $request->metode_pembayaran;
            $transaction->save();

            if ($request->has('user_id') && $validatedData['user_id'] != null) {
                $user = User::find($validatedData['user_id']);
                if ($user) {
                    $user->point += $validatedData['total_price'] * 0.01;
                    $user->save();

                    $memberPoint = new MemberPoint();
                    $memberPoint->users_id = $user->id;
                    $memberPoint->point = $validatedData['total_price'] * 0.01;
                    $memberPoint->keterangan = "Point dari total pembelian Rp." . number_format($validatedData['total_price'], 0, ',', '.');
                    $memberPoint->orders_id = $order->id;
                    $memberPoint->save();
                }
            }

            return redirect()->route('employee.daftarPesanan')->with('success', 'Status pembayaran telah diupdate menjadi Lunas.');
        } catch (Exception $e) {
            return back()->with('error', 'Gagal memproses data: ' . $e->getMessage());
        }
    }

    public function orderForm()
    {

        $categories = Category::with('menus')->get();
        return view('Employee.add_order', compact('categories'));
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
        $pdf = Pdf::loadView('Layouts.invoice', ['order' => $order]);
        return $pdf->download('invoice.pdf');
    }
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'no_meja' => 'required|integer',
                'customer_name' => 'nullable|string|max:255',
                'member_id' => 'nullable|integer',
                'total_price' => 'required|numeric',
                'cart' => 'required|array',
                'cart.*.quantity' => 'required|integer|min:1',
                'cart.*.price' => 'required|numeric|min:0',
            ]);

            DB::transaction(function () use ($validatedData) {
                $orderNumber = 'TRX' . date('dmY');
                $orderCount = Order::whereDate('created_at', now()->format('Y-m-d'))->count();
                $order = Order::create([
                    'order_number' => $orderNumber . str_pad($orderCount + 1, 4, '0', STR_PAD_LEFT),
                    'total_price' => $validatedData['total_price'],
                    'payment_method' => '-',
                    'order_date' => now(),
                    'status_pembayaran' => 'Belum Bayar',
                    'no_meja' => $validatedData['no_meja'],
                    'guest' => $validatedData['customer_name'] ?? null,
                    'users_id' => $validatedData['member_id'] ?? null,
                ]);



                foreach ($validatedData['cart'] as $id => $item) {
                    OrderItem::create([
                        'orders_id' => $order->id,
                        'menus_id' => $id,
                        'jumlah' => $item['quantity'],
                        'price' => $item['price'],
                        'total_price' => $item['quantity'] * $item['price'],
                    ]);
                }

                Transaction::create([
                    'orders_id' => $order->id,
                    'payment_method' => '-',
                    'order_date' => now(),
                    'total_amount' => $validatedData['total_price'],
                    'status' => 'Belum Bayar',
                ]);
            });

            return response()->json(['success' => true, 'message' => 'Order successfully created!']);
        } catch (\Exception $e) {
            Log::error('Error creating order: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Error creating order'], 500);
        }
    }
}
