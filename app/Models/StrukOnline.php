<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StrukOnline extends Model
{
    use HasFactory;

    protected $fillable = [
        'users_id',
        'file',
        'status',
        'point'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }
}
