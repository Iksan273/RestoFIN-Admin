<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'orders_id',
        'payment_method',
        'total_amount',
        'status',
        'order_date'

    ];
    public function order()
    {
        return $this->belongsTo(Order::class, 'orders_id', 'id'); // 'orders_id' is the foreign key in the 'transactions' table, 'id' is the primary key in the 'orders' table
    }
}
