<?php

namespace App\Http\Controllers;

use App\Models\CityShippingFee;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\Product;

class CustomerController extends Controller
{

    public function cartView()
    {
        $oncartCount = Order::oncartCount();
        $oncartOrders = Order::oncartOrders();
        $oncartTotalAmount = Order::oncartTotalAmount();
        $cities = CityShippingFee::list();
        $fee = CityShippingFee::fee();
        return view('user.customer.cart', compact('oncartCount', 'oncartOrders', 'oncartTotalAmount', 'cities', 'fee'));
    }

    public function orderDetails()
    {
        $checkoutOrders = Order::checkoutOrders();
        $oncartCount = Order::oncartCount();
        return view('user.customer.order-details', compact(['oncartCount', 'checkoutOrders']));
    }

    public function viewOrderDetails($order_id)
    {
        $oncartCount = Order::oncartCount();
        $orderDetail = Order::orderDetailView($order_id);
        $cities = CityShippingFee::list();
        /* dd($orderDetail); */

        if($orderDetail->count() === 0)
        {
            return abort(404);
        }else{
            return view('user.customer.view-order-details', compact('oncartCount', 'orderDetail', 'cities'));
        }
    }

    public function buyNow(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $oncartCount = Order::oncartCount();
        $cities = CityShippingFee::list();
        return view('user.customer.buy-now', compact(['product', 'oncartCount', 'cities']));
    }
}
