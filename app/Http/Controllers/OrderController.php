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
use charlieuki\ReceiptPrinter\ReceiptPrinter;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Mike42\Escpos\EscposImage;
use TCPDF;

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
    public function checkNewOrders()
    {
        // Mengambil jumlah orderan hari ini dari session atau cache jika ada
        $todayOrdersCount = session('today_orders_count', function () {
            // Jika tidak ada dalam session atau cache, hitung kembali
            $count = Order::whereDate('created_at', now()->toDateString())->count();
            session(['today_orders_count' => $count]);
            return $count;
        });

        return response()->json(['count' => $todayOrdersCount]);
    }

    public function resetOrdersCount()
    {
        session()->forget('today_orders_count');
    }




    public function downloadNota($id)
    {
        $order = Order::findOrFail($id); // Menggunakan findOrFail untuk menghandle kasus jika order tidak ditemukan
        $pdf = Pdf::loadView('Layouts.invoice', ['order' => $order]);
        return $pdf->download('invoice.pdf');
    }
    public function printNotaKitchen($id)
    {
        $order = Order::findOrFail($id);
        // Set params
        $mid = '123123456';
        $meja = $order->no_meja;
        $store_name = 'Vinautism Art & Resto';
        $store_address = 'Vinautism Galery Gwalk Junction TL6 no 11';
        $store_phone = '08123032006';
        $store_email = 'yourmart@email.com';
        $store_website = 'vinresto.com';
        $tax_percentage = 10;
        $transaction_id = $order->order_number;
        $currency = 'Rp';
        $image_path = url("assets/images/vin/Logo-Putih.png");
        $items = [];

        foreach ($order->orderItems as $item) {
            $items[] = [
                'name' => $item->menu->title, // Sesuaikan dengan atribut yang sesuai di objek $orderItem
                'qty' => $item->jumlah,
                'price' => $item->price,
            ];
        }



        // Init printer
        $printer = new ReceiptPrinter;
        $printer->init(
            config('receiptprinter.connector_type'),
            config('receiptprinter.connector_descriptor')
        );

        // Set store info
        $printer->setStore($mid, $store_name, $store_address, $store_phone, $store_email, $store_website);
        $printer->setNoMeja($meja);

        // Set currency
        $printer->setCurrency($currency);

        // Add items
        foreach ($items as $item) {
            $printer->addItem(
                $item['name'],
                $item['qty'],
                $item['price']
            );
        }
        // Set tax
        $printer->setTax($tax_percentage);

        // Calculate total
        $printer->calculateSubTotal();
        $printer->calculateGrandTotal();

        // Set transaction ID
        $printer->setTransactionID($transaction_id);

        // Set logo
        // Uncomment the line below if $image_path is defined
        // $printer->setLogo($image_path);



        // Print receipt
        $printer->printKitchen();
    }

    // public function printNota($id)
    // {
    //     $order = Order::findOrFail($id);
    //     // Set params
    //     $mid = '123123456';
    //     $meja = $order->no_meja;
    //     $store_name = 'Vinautism Art & Resto';
    //     $store_address = 'Vinautism Galery Gwalk Junction TL6 no 11';
    //     $store_phone = '08123032006';
    //     $store_email = 'yourmart@email.com';
    //     $store_website = 'vinresto.com';
    //     $tax_percentage = 10;
    //     $transaction_id = $order->order_number;
    //     $currency = 'Rp';
    //     $image_path = url("assets/images/vin/Logo-Putih.png");
    //     $items = [];

    //     foreach ($order->orderItems as $item) {
    //         $items[] = [
    //             'name' => $item->menu->title, // Sesuaikan dengan atribut yang sesuai di objek $orderItem
    //             'qty' => $item->jumlah,
    //             'price' => $item->price,
    //         ];
    //     }



    //     // Init printer
    //     $printer = new ReceiptPrinter;
    //     $printer->init(
    //         config('receiptprinter.connector_type'),
    //         config('receiptprinter.connector_descriptor')
    //     );

    //     // Set store info
    //     $printer->setStore($mid, $store_name, $store_address, $store_phone, $store_email, $store_website);
    //     $printer->setNoMeja($meja);

    //     // Set currency
    //     $printer->setCurrency($currency);

    //     // Add items
    //     foreach ($items as $item) {
    //         $printer->addItem(
    //             $item['name'],
    //             $item['qty'],
    //             $item['price']
    //         );
    //     }
    //     // Set tax
    //     $printer->setTax($tax_percentage);

    //     // Calculate total
    //     $printer->calculateSubTotal();
    //     $printer->calculateGrandTotal();

    //     // Set transaction ID
    //     $printer->setTransactionID($transaction_id);

    //     // Set logo
    //     // Uncomment the line below if $image_path is defined
    //     // $printer->setLogo($image_path);

    //     // // Set QR code
    //     // $printer->setQRcode([
    //     //     'tid' => $transaction_id,
    //     // ]);

    //     // Print receipt
    //     $printer->printReceipt();
    // }

    public function printNota($id)
    {
        $order = Order::findOrFail($id);
        $meja = $order->no_meja;
        $store_name = 'Vinautism Art & Resto';
        $store_address = 'Vinautism Galery Gwalk Junction TL6 no 11';
        $store_website = 'VinResto.com';
        $tax_percentage = 10;
        $transaction_id = $order->order_number;
        $currency = 'Rp';
        $items = [];

        foreach ($order->orderItems as $item) {
            $items[] = [
                'name' => $item->menu->title,
                'qty' => $item->jumlah,
                'price' => $item->price,
            ];
        }

        $subtotal = array_sum(array_map(function ($item) {
            return $item['qty'] * $item['price'];
        }, $items));
        $tax = ($subtotal * $tax_percentage) / 100;
        $grand_total = $subtotal + $tax;

        // Create PDF using TCPDF
        $pdf = new TCPDF('P', 'mm', [48, 297], true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Vinautism Art & Resto');
        $pdf->SetTitle('Receipt');
        $pdf->SetMargins(1, 1, 1);
        $pdf->SetAutoPageBreak(true, 1);
        $pdf->AddPage();
        $pdf->SetFont('helvetica', '', 8); // Reduced font size to 8

        $logo_path = public_path('assets/images/vin/Logo-Hitam.png');
        $pdf->Image($logo_path, 10, 5, 28); // Adjust the path and size as needed
        $pdf->Ln(20);

        // Center-aligned header
        $pdf->SetFont('', 'B', 8); // Set font to bold
        $pdf->Cell(0, 0, $store_name, 0, 1, 'C');
        $pdf->SetFont('', '', 8); // Reset font
        $pdf->Ln(2);
        $pdf->SetFont('helvetica', '', 6); // Set font size to 6
        $pdf->Cell(0, 0, substr($store_address, 0, 31), 0, 1, 'C');
        $pdf->Cell(0, 0, substr($store_address, 30), 0, 1, 'C');
        $pdf->Ln(2); // Add a line break

        // Center-aligned transaction details
        $pdf->Cell(0, 0, "Order: $transaction_id", 0, 1, 'C');
        $pdf->Cell(0, 0, "No Meja: $meja", 0, 1, 'C');
        $pdf->Ln(2); // Add a line break

        // Receipt title and separator
        $pdf->Cell(0, 0, "RECEIPT", 0, 1, 'C');
        $pdf->SetFont('courierB', '', 8); // Reduced font size to 8

        $pdf->Cell(0, 0, str_repeat('-', 50), 0, 1, 'C');
        $pdf->Ln(2); // Add a line break
        $pdf->SetFont('helvetica', '', 8); // Reduced font size to 8

        // Items and pricing
        foreach ($items as $item) {
            $pdf->Cell(0, 0, $item['name'], 0, 1, 'L');
            $pdf->Cell(20, 0, $currency . number_format($item['price'], 0, ',', '.') . " x " . $item['qty'], 0, 0, 'L');
            $pdf->Cell(0, 0, $currency . number_format($item['price'] * $item['qty'], 0, ',', '.'), 0, 1, 'R');
            $pdf->Ln(2); // Add a line break
        }

        // Subtotal, Tax, Total

        $pdf->Cell(20, 0, "Subtotal", 0, 0, 'L');
        $pdf->Cell(0, 0, $currency . number_format($subtotal, 0, ',', '.'), 0, 1, 'R');
        $pdf->Cell(20, 0, "Tax ($tax_percentage%)", 0, 0, 'L');
        $pdf->Cell(0, 0, $currency . number_format($tax, 0, ',', '.'), 0, 1, 'R');
        $pdf->SetFont('courierB', '', 8); // Reduced font size to 8
        $pdf->Cell(0, 0, str_repeat('-', 50), 0, 1, 'C');
        $pdf->SetFont('helvetica', '', 8); // Reduced font size to 8
        $pdf->SetFont('', 'B', 8); // Set font to bold
        $pdf->Cell(20, 0, "TOTAL", 0, 0, 'L');
        $pdf->Cell(0, 0, $currency . number_format($grand_total, 0, ',', '.'), 0, 1, 'R');
        $pdf->SetFont('', '', 8); // Reset font
        $pdf->Ln(2); // Add a line break

        // Footer
        $pdf->SetFont('', '', 6); // Set font size to 6
        $pdf->Cell(0, 0, "Thank you and Have a Nice Day!", 0, 1, 'C');


        $pdf->Ln(1);
        $pdf->Cell(0, 0, "Website", 0, 1, 'C');
        $pdf->Cell(0, 0, $store_website, 0, 1, 'C');
        $pdf->Ln(2); // Add a line break
        $pdf->Cell(0, 0, date('j F Y H:i:s'), 0, 1, 'C');

        $pdf->Output('receipt_' . $order->order_number . '.pdf', 'I'); // Output to browser with order number
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
