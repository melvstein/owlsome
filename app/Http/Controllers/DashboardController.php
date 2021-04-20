<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use App\Models\TotalEarning;

class DashboardController extends Controller
{
    public function index(){
        $users = User::all();
        $products = Product::all();
        $orders = Order::where('isCheckout', 1)
        ->groupBy('order_id')
        ->get();

        $totalEarnings = TotalEarning::list();
        $totalEarned = TotalEarning::totalEarned();

        if(auth()->user()->role == "Admin"){
            return view('user.admin.dashboard', compact(['users', 'products', 'orders', 'totalEarnings', 'totalEarned']));
        }else{
            return view('user.staff.dashboard', compact(['users', 'products', 'orders', 'totalEarnings', 'totalEarned']));
        }

    }
}
