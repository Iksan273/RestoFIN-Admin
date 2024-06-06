<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'users_id',
        'order_number',
        'total_price',
        'payment_method',
        'order_date',
        'status_pembayaran',
        'no_meja',
        'status_makanan',
        'guest'

    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'orders_id');
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }
}
