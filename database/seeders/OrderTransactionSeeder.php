<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Stringable;

class OrderTransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $payment_methods = ['QRIS', 'Cash', 'Debit'];

        // $startDate = Carbon::create(2018, 1, 1);
        // $endDate = Carbon::create(2024, 12, 31);

        // while ($startDate->lte($endDate)) {
        //     for ($i = 0; $i < 10; $i++) {
        //         $users_id = rand(0, 1) ? rand(1, 2) : null;
        //         $guest = $users_id ? null : 'Guest_' . Str::random(5);

        //         $total_price = rand(50000, 150000); // Random total price between 500.00 and 1500.00
        //         $payment_method = $payment_methods[array_rand($payment_methods)];
        //         $order_date = $startDate->copy()->addDays($i)->toDateString();
        //         $status_pembayaran = 'Lunas'; // Set status pembayaran to "Lunas"
        //         $no_meja = rand(1, 10);
        //         $status_makanan = "Selesai";
        //         $timestamp = Carbon::now();

        //         // Format order_number
        //         $order_number = 'TRX' . $startDate->copy()->addDays($i)->format('Ymd');

        //         $orderId = DB::table('orders')->insertGetId([
        //             'users_id' => $users_id,
        //             'guest' => $guest,
        //             'order_number' => $order_number,
        //             'total_price' => $total_price,
        //             'payment_method' => $payment_method,
        //             'order_date' => $order_date,
        //             'status_pembayaran' => $status_pembayaran,
        //             'no_meja' => $no_meja,
        //             'status_makanan' => $status_makanan,
        //             'created_at' => $timestamp,
        //             'updated_at' => $timestamp,
        //         ]);

        //         DB::table('transactions')->insert([
        //             'orders_id' => $orderId,
        //             'payment_method' => $payment_method,
        //             'total_amount' => $total_price,
        //             'status' => $status_pembayaran,
        //             'order_date' => $order_date,
        //             'created_at' => $timestamp,
        //             'updated_at' => $timestamp,
        //         ]);
        //     }

        //     $startDate->addMonth();

        $payment_methods = ['QRIS', 'Cash', 'Debit'];
        $startDate = Carbon::create(2024, 1, 1);
        $endDate = Carbon::create(2024, 1, 30);

        while ($startDate->lte($endDate)) {
            for ($i = 0; $i < 10; $i++) {
                $users_id = rand(0, 1) ? rand(1, 2) : null;
                $guest = $users_id ? null : 'Guest_' . Str::random(5);

                $total_price = rand(50000, 150000); // Random total price between 500.00 and 1500.00
                $payment_method = $payment_methods[array_rand($payment_methods)];
                $order_date = $startDate->toDateString();
                $status_pembayaran = 'Lunas'; // Set status pembayaran to "Lunas"
                $no_meja = rand(1, 10);
                $status_makanan = "Selesai";
                $timestamp = Carbon::now();

                // Format order_number
                $order_number = 'TRX' . $startDate->format('Ymd') . Str::padLeft($i + 1, 2, '0');

                $orderId = DB::table('orders')->insertGetId([
                    'users_id' => $users_id,
                    'guest' => $guest,
                    'order_number' => $order_number,
                    'total_price' => $total_price,
                    'payment_method' => $payment_method,
                    'order_date' => $order_date,
                    'status_pembayaran' => $status_pembayaran,
                    'no_meja' => $no_meja,
                    'status_makanan' => $status_makanan,
                    'created_at' => $timestamp,
                    'updated_at' => $timestamp,
                ]);

                DB::table('transactions')->insert([
                    'orders_id' => $orderId,
                    'payment_method' => $payment_method,
                    'total_amount' => $total_price,
                    'status' => $status_pembayaran,
                    'order_date' => $order_date,
                    'created_at' => $timestamp,
                    'updated_at' => $timestamp,
                ]);
            }

            $startDate->addDay();
        }
    }
}
