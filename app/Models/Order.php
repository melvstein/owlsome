<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class Order extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'order_id',
        'user_id',
        'product_id',
        'quantity',
        'isOncart',
        'isCheckout',
        'isShipped',
        'isDelivered',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function orderId()
    {
        return mt_rand(100000000, 999999999);
    }

    public static function oncartOrders()
    {
        return Order::join('products', 'orders.product_id', '=', 'products.id')
                    ->where('orders.user_id', auth()->user()->id)
                    ->where('orders.isOncart', 1)
                    ->select('orders.*', 'products.category', 'products.name', 'products.price', 'products.units', 'products.details', 'products.description', 'products.image_path')
                    ->orderBy('orders.created_at', 'DESC')
                    ->get();
    }

    public static function oncartCount()
    {
        if(isset(auth()->user()->id))
        {
            $user_id = auth()->user()->id;
        }else{
            $user_id = 0;
        }

        return Order::where('user_id', $user_id)
                    ->where('isOncart', 1)
                    ->get();
    }

    public static function oncartTotalAmount()
    {
        $orders = Order::join('products', 'orders.product_id', '=', 'products.id')
                    ->where('orders.user_id', auth()->user()->id)
                    ->where('orders.isOncart', 1)
                    ->where('products.units', '!=', 0)
                    ->select('orders.*', 'products.category', 'products.name', 'products.price', 'products.units', 'products.details', 'products.description', 'products.image_path')
                    ->orderBy('orders.created_at', 'DESC')
                    ->get();

        $totalAmount = 0;
        foreach($orders as $order)
        {
            $amount = $order->price * $order->quantity;
            $totalAmount += $amount;
        }
        return $totalAmount;
    }

    public static function checkoutOrders()
    {
        /* $orders = Order::join('products', 'orders.product_id', '=', 'products.id')
                    ->where('orders.user_id', auth()->user()->id)
                    ->where('orders.isOncart', 0)
                    ->where('products.units', '!=', 0)
                    ->select('orders.*', 'products.category', 'products.name', 'products.price', 'products.units', 'products.details', 'products.description', 'products.image_path', DB::raw('count(order_id) as numberofItems'))
                    ->orderBy('orders.created_at', 'DESC')
                    ->groupBy('order_id')
                    ->get(); */

        $orders = Order::where('user_id', auth()->user()->id)
                    ->where('orders.isOncart', 0)
                    ->select('orders.*', DB::raw('count(order_id) as numberofItems'))
                    ->orderBy('orders.created_at', 'DESC')
                    ->groupBy('order_id')
                    ->get();

        return $orders;
    }

    public static function orderDetailView($order_id)
    {
        $orderDetail = Order::join('products', 'orders.product_id', '=', 'products.id')
            ->join('shipping_details', 'orders.order_id', '=', 'shipping_details.order_id')
            ->where('orders.user_id', auth()->user()->id)
            ->where('orders.order_id', $order_id)
            ->select('orders.*', 'products.category', 'products.name', 'products.price', 'products.units', 'products.details', 'products.description', 'products.image_path','shipping_details.id as shipId', 'shipping_details.receiver', 'shipping_details.contactNumber', 'shipping_details.city', 'shipping_details.address')
            ->get();

        return $orderDetail;
    }

    public static function isCheckoutListByDate($year, $month, $date)
    {
        $ymd = $year."-".$month."-".$date;
        return Order::where('isCheckout', 1)
                ->where('isOncart', 0)
                ->whereDate('updated_at', $ymd)
                ->select('*', DB::raw('count(order_id) as numberOfItems'))
                ->groupBy('order_id')
                ->get();
    }

    public static function shippedOrders()
    {
        return Order::where('isShipped', true)
                    ->select('*', DB::raw('count(order_id) as numberOfItems'))
                    ->groupBy('order_id')
                    ->get();
    }

    public static function deliveredOrders()
    {
        return Order::where('isDelivered', true)
                    ->select('*', DB::raw('count(order_id) as numberOfItems'))
                    ->groupBy('order_id')
                    ->get();
    }

    public static function totalEarnings()
    {
        $totalEarnings = 0;
        $orders = Order::join('products', 'orders.product_id', 'products.id')
                        ->where('isDelivered', true)
                        ->select('orders.*', 'products.price', DB::raw('orders.quantity * products.price as totalPrice'))
                        ->get();

        foreach($orders as $data)
        {
            $totalEarnings += $data->totalPrice;
        }

        return $totalEarnings;
    }
}
