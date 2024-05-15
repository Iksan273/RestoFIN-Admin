<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'firstname',
        'password',
        'lastname',
        'email',
        'phone',
        'membership',
        'created_at',
        'updated_at',
        'email_verify',
        'phone_verify'
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function memberPoints()
    {
        return $this->hasMany(MemberPoint::class);
    }

    public function strukOnline()
    {
        return $this->hasMany(StrukOnline::class);
    }



    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',

    ];

}
