<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {

        $member = User::all();
        $memberCount = $member->count();
        $memberWithMostPoints = User::orderBy('point', 'desc')->first();
        $memberWithMostOrders = User::with('orders')->get()->sortByDesc(function ($user) {
            return $user->orders->count();
        })->first();
        $memberWithMostOrdersCount = $memberWithMostOrders->first()->orders->count();
        return view('Master.member', [
            'member' => $member,
            'memberCount' => $memberCount,
            'memberWithMostPoints' => $memberWithMostPoints,
            'memberWithMostOrders' => $memberWithMostOrders,
            'countOrder' => $memberWithMostOrdersCount,
        ]);
    }

}
