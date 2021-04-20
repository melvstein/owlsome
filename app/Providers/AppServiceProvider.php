<?php

namespace App\Providers;

use App\Models\CityShippingFee;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\BusinessInformation;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Notifications\DatabaseNotification;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $businessInformations = BusinessInformation::findOrFail(1);
        $cities = CityShippingFee::all();
        $checkoutOrders = Order::where('isCheckout', true)->groupBy('order_id')->get();
        $shippedOrders = Order::where('isShipped', true)->groupBy('order_id')->get();
        $deliveredOrders = Order::where('isDelivered', true)->groupBy('order_id')->get();
        $adminNotifications = DatabaseNotification::where('notifiable_id', 1)->get();
        $adminUnreadNotifications = DatabaseNotification::where('read_at', null)->where('notifiable_id', 1)->get();

        View::share('business', $businessInformations);
        View::share('cities', $cities);
        View::share('pesoSign', '₱');
        View::share('checkoutOrdersCount', $checkoutOrders->count());
        View::share('shippedOrdersCount', $shippedOrders->count());
        View::share('deliveredOrdersCount', $deliveredOrders->count());
        View::share('adminNotifications', $adminNotifications);
        View::share('adminUnreadNotifications', $adminUnreadNotifications);
    }
}
