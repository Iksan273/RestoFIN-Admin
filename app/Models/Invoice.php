<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'orders_id',
        'invoice_number'

    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'orders_id');
    }
}
