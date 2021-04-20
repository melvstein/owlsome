<?php

namespace App\Http\Controllers;

use App\Events\CustomerOrderEvent;
use App\Events\OrderProcessEvent;
use App\Http\Requests\CheckoutRequest;
use App\Models\CityShippingFee;
use App\Models\Order;
use App\Models\OrderHistory;
use App\Models\Product;
use App\Models\ShippingDetails;
use App\Models\TotalEarning;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;

class OrdersController extends Controller
{

    public function index()
    {
        $orders = Order::where('isCheckout', 1)
                ->selectRaw('*, COUNT(order_id) as numberOfItems')
                ->groupBy('order_id')
                ->orderBy('updated_at', 'DESC')
                ->get();

        if(auth()->user()->role == "Admin"){
            return view('user.admin.orders', compact(['orders']));
        }else{
            return view('user.staff.orders', compact(['orders']));
        }

    }

    public function orderList($month, $date, $year)
    {
        $orderDates = Order::isCheckoutListByDate($year, $month, $date);

        if(auth()->user()->role == "Admin"){
            return view('user.admin.view-order-list', compact(['orderDates']));
        }else{
            return view('user.staff.view-order-list', compact(['orderDates']));
        }

    }

    public function shippedOrdersView()
    {
        $shippedOrders = Order::shippedOrders();
        if(auth()->user()->role == "Admin"){
            return view('user.admin.shipped-orders', compact(['shippedOrders']));
        }else{
            return view('user.staff.shipped-orders', compact(['shippedOrders']));
        }
    }

    public function deliveredOrdersView()
    {
        $deliveredOrders = Order::deliveredOrders();
        if(auth()->user()->role == "Admin"){
            return view('user.admin.delivered-orders', compact(['deliveredOrders']));
        }else{
            return view('user.staff.delivered-orders', compact(['deliveredOrders']));
        }
    }

    public function viewOrder()
    {

        if(auth()->user()->role == "Admin"){
            return view('user.admin.view-order');
        }else{
            return view('user.staff.view-order');
        }

    }

    public function totalEarningsView()
    {
        $totalEarnings = TotalEarning::list();
        $totalEarned = TotalEarning::totalEarned();
        if(auth()->user()->role == "Admin"){
            return view('user.admin.total-earnings', compact(['totalEarnings', 'totalEarned']));
        }else{
            return view('user.staff.total-earnings', compact(['totalEarnings', 'totalEarned']));
        }

    }

    public function orderHistory()
    {
        $orderHistories = OrderHistory::list();

        if(auth()->user()->role == "Admin"){
            return view('user.admin.order-history', compact(['orderHistories']));
        }else{
            return view('user.staff.order-history', compact(['orderHistories']));
        }

    }

    public function customerOrderView($order_id)
    {
        $orderDetail = Order::join('products', 'orders.product_id', '=', 'products.id')
        ->join('shipping_details', 'orders.order_id', '=', 'shipping_details.order_id')
        ->where('orders.order_id', $order_id)
        ->select('orders.*', 'products.category', 'products.name', 'products.price', 'products.units',
                'products.details', 'products.description', 'products.image_path','shipping_details.id as shipId',
                'shipping_details.receiver', 'shipping_details.contactNumber', 'shipping_details.city', 'shipping_details.address')
        ->get();

        $cities = CityShippingFee::list();
        if($orderDetail->count() === 0)
        {
            return abort(404);
        }else
        {
            return view('user.'.Str::lower(auth()->user()->role).'.customer-order-view', compact(['orderDetail', 'cities']));
        }

        /* if(auth()->user()->role == "Admin"){
            return view('user.admin.customer-order-view', compact(['orderDetail']));
        }else{
            return view('user.staff.customer-order-view', compact(['orderDetail']));
        } */
    }

    public function orders(Request $request)
    {
        Validator::make($request->all(), [
            'receiverName' => 'required|string|max:255',
            'receiverNumber' => 'required|string|min:11|max:11',
            'city' => 'required|string|max:255',
            'shippingAddress' => 'required|string|max:255',
        ]);

        switch ($request->action) {
            case 'checkoutNow':

               $order_id = Order::insertGetId([
                    'order_id' => Order::orderId(),
                    'user_id' => auth()->user()->id,
                    'product_id' => $request->product_id,
                    'quantity' => $request->quantity,
                    'isOncart' => 0,
                    'isCheckout' => 1,
                    'isShipped' => 0,
                    'isDelivered' => 0,
                    "created_at" =>  Carbon::now(), # new \Datetime()
                    "updated_at" =>  Carbon::now(),  # new \Datetime()
                ]);

                $order = Order::findOrFail($order_id);


                ShippingDetails::create([
                    'order_id' => $order->order_id,
                    'receiver' => $request->receiverName,
                    'contactNumber' => $request->receiverNumber,
                    'city' => $request->city,
                    'address' => $request->shippingAddress,
                ]);

                return redirect()->back()->with('message', 'Checkout successfully!');
                break;
            case 'addToCart':
                Order::create([
                    'order_id' => '',
                    'user_id' => auth()->user()->id,
                    'product_id' => $request->product_id,
                    'quantity' => $request->quantity,
                    'isOncart' => 1,
                    'isCheckout' => 0,
                    'isShipped' => 0,
                    'isDelivered' => 0,
                ]);

                return redirect()->back()->with('message', 'Added to cart successfully!');
                break;
        }
    }

    public function checkOut(CheckoutRequest $request)
    {
        $product = Product::find($request->product_id);
        $order_id = Order::insertGetId([
            'order_id' => Order::orderId(),
            'user_id' => auth()->user()->id,
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'isOncart' => 0,
            'isCheckout' => 1,
            'isShipped' => 0,
            'isDelivered' => 0,
            "created_at" =>  Carbon::now(), # new \Datetime()
            "updated_at" =>  Carbon::now(),  # new \Datetime()
        ]);

        $order = Order::findOrFail($order_id);

        ShippingDetails::create([
            'user_id' => auth()->user()->id,
            'order_id' => $order->order_id,
            'receiver' => $request->receiverName,
            'contactNumber' => $request->receiverNumber,
            'city' => $request->city,
            'address' => $request->shippingAddress,
        ]);

        $product->update([
            'units' => $product->units - $request->quantity,
        ]);

        OrderHistory::create([
            'order_id' => $order->order_id,
            'user_id' => auth()->user()->id,
            'status' => 'Checkout',
        ]);

        $order_details = Order::where('order_id', $order->order_id)->get();
        event(new CustomerOrderEvent($order_details));
        /* CustomerOrderEvent::dispatch($order_details); */
        return redirect()->route('customer.orderDetails')->with('message', 'Checkout successfully!');

    }

    public function addToCart(Request $request)
    {
        Order::updateOrCreate([
            'order_id' => '',
            'user_id' => auth()->user()->id,
            'product_id' => $request->product_id,
            'isOncart' => 1,
        ],[
            'order_id' => '',
            'user_id' => auth()->user()->id,
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'isOncart' => 1,
            'isCheckout' => 0,
            'isShipped' => 0,
            'isDelivered' => 0,
        ]);

        return redirect()->back()->with('message', 'Added to cart successfully!');
    }

    public function oncartCheckout(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'receiverName' => 'required|string|max:255',
            'receiverNumber' => 'required|string|min:11|max:11',
            'city' => 'required|string|max:255',
            'shippingAddress' => 'required|string|max:255',
        ]);

        if($validator->fails())
        {
            return response()->json([
                'status_code' => JsonResponse::HTTP_NOT_ACCEPTABLE,
                'error' => $validator->errors(),
            ], JsonResponse::HTTP_NOT_ACCEPTABLE);
        }

        if($validator->validated())
        {
            $ids = $request->ids;
            $orders = Order::whereIn('id', $ids)->get();
            $orderMain = Order::find($orders[0]->id);
            $subTotal = 0;

            $orderMain->update([
                'order_id' => Order::orderId(),
                'isOncart' => 0,
                'Checkout' => 1,
            ]);

            foreach ($orders as $order) {
                $order->update([
                    'order_id' => $orderMain->order_id,
                    'isOncart' => 0,
                    'isCheckout' => 1,
                ]);

                Product::where('id', $order->product_id)->decrement('units', $order->quantity);
            }
            $count = Order::oncartCount()->count();
            ShippingDetails::updateOrCreate([
                'order_id' => '',
            ],
            [   'user_id' => auth()->user()->id,
                'order_id' => $orders[0]['order_id'],
                'receiver' => $request->receiverName,
                'contactNumber' => $request->receiverNumber,
                'city' => $request->city,
                'address' => $request->shippingAddress,
            ]);

            OrderHistory::create([
                'order_id' => $orders[0]['order_id'],
                'user_id' => auth()->user()->id,
                'status' => 'Checkout',
            ]);

            if($ids != null)
            {
                for($i = 0; $i < $orders->count(); $i++)
                {
                    $subTotal += $this->productsOSI($orders[$i]->product_id, $orders[$i]->quantity);
                }
            }else{
                $ids;
                $subTotal;
            }

            $totalAmount = Order::oncartTotalAmount();

            $order_details = Order::where('order_id', $orders[0]['order_id'])->get();
            event(new CustomerOrderEvent($order_details));
            return response()->json([
                'status_code' => JsonResponse::HTTP_OK,
                'message' => 'Items checkout successfully!',
                'ids' => $ids,
                'id' => $orders[0]['order_id'],
                'itemCount' => $count,
                'subTotal' => $subTotal,
                'totalAmount' => $totalAmount,
            ], JsonResponse::HTTP_OK);
        }
    }

    public function oncartSelectedItems(Request $request)
    {
        $ids = $request->ids;
        $subTotal = 0;

        if($ids != null)
        {
            $orders = Order::whereIn('id', $ids)->get();
            for($i = 0; $i < $orders->count(); $i++)
            {
                $subTotal += $this->productsOSI($orders[$i]->product_id, $orders[$i]->quantity);
            }
        }else{
            $ids;
            $subTotal;
        }

        return response()->json([
            'status_code' => JsonResponse::HTTP_OK,
            'message' => 'Selected Items!',
            'subTotal' => $subTotal,
            'ids' => $ids,
        ], JsonResponse::HTTP_OK);
    }

    public function productsOSI($id, $quantity)
    {
        $products = Product::where('id', $id)->get();
        $totalAmount = 0;
        for($p = 0; $p < $products->count(); $p++)
        {
           $totalAmount += $products[$p]->price * $quantity;
        }

        return $totalAmount;
    }

    public function updateOncartQuantity(Request $request){

        $order = Order::findOrFail($request->id);
        $product = Product::findOrFail($order->product_id);

        if($request->quantity >= 1){
            if($request->quantity <= $request->units)
            {
                $order->update([
                    'quantity' => $request->quantity,
                ]);
                $amount = $product->price * $request->quantity;
            }else{
                $order->update([
                    'quantity' => $request->units,
                ]);
                $amount = $product->price * $request->units;
            }
        }else{
            $order->update([
                'quantity' => 1,
            ]);
            $amount = $product->price * 1;
        }

        $totalAmount = Order::oncartTotalAmount();

        return response()->json([
            'status_code' => JsonResponse::HTTP_OK,
            'id' => $order->id,
            'quantity' => $order->quantity,
            'amount' => $amount,
            'totalAmount' => $totalAmount,
            'message' => 'Item updated successfully!',
        ], JsonResponse::HTTP_OK);
    }

    public function deleteOncart(Request $request, $id)
    {
        Order::destroy($id);
        $count = Order::oncartCount()->count();
        $totalAmount = Order::oncartTotalAmount();
        return response()->json([
            'status_code' => JsonResponse::HTTP_OK,
            'message' => 'Item deleted successfully!',
            'itemCount' => $count,
            'totalAmount' => $totalAmount,
            'data' => $id,
        ], JsonResponse::HTTP_OK);
        /* return redirect()->back()->with('message', 'Item deleted successfully!'); */
    }

    public function cancelCheckout(Request $request)
    {
        $order = Order::where('order_id', $request->order_id)->first();

        if($order->isCheckout)
        {
            if($order->count() === 0)
            {
                return response()->json([
                    'status_code' => JsonResponse::HTTP_NOT_FOUND,
                    'order_id' => $request->order_id,
                    'message' => 'This order was cancelled by the Admins!',
                ], JsonResponse::HTTP_NOT_FOUND);
            }else{
                $order = Order::where('order_id', $request->order_id);
                $order->delete();
                ShippingDetails::where('order_id', $request->order_id)->delete();

                OrderHistory::create([
                    'order_id' => $request->order_id,
                    'user_id' => auth()->user()->id,
                    'status' => 'Cancelled',
                ]);

                return response()->json([
                    'status_code' => JsonResponse::HTTP_OK,
                    'order_id' => $request->order_id,
                    'message' => 'Order cancelled successfully!',
                ], JsonResponse::HTTP_OK);
            }
        }else{
            return response()->json([
                'status_code' => JsonResponse::HTTP_NOT_ACCEPTABLE,
                'error' => 'Your items are shipped now!',
            ], JsonResponse::HTTP_NOT_ACCEPTABLE);
        }
    }

    public function editOrderDetailsForm(Request $request, $order_id)
    {
        $order = Order::where('order_id', $order_id)->first();

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'contactNumber' => 'required|string|min:11|max:11',
            'city' => 'required|string|max:255',
            'address' => 'required|string|max:255',
        ]);

        if($order->isCheckout)
        {
            if($validator->fails())
            {
                return response()->json([
                    'status_code' => JsonResponse::HTTP_NOT_ACCEPTABLE,
                    'error' => $validator->errors(),
                ], JsonResponse::HTTP_NOT_ACCEPTABLE);
            }

            if($validator->validated())
            {
                $shippingDetails = ShippingDetails::where('order_id', $order_id);
                $shippingDetails->update([
                    'receiver' => $request->name,
                    'contactNumber' => $request->contactNumber,
                    'address' => $request->address,
                    'city' => $request->city,
                ]);

                return response()->json([
                    'status_code' => JsonResponse::HTTP_OK,
                    'data' => [
                        'name' => $request->name,
                        'contactNumber' => $request->contactNumber,
                        'address' => $request->address,
                        'city' => $request->city,
                        'first' => $order,
                    ],
                    'message' => 'Shipping details updated successfully!',
                ], JsonResponse::HTTP_OK);
            }
        }else{
            return response()->json([
                'status_code' => JsonResponse::HTTP_NOT_ACCEPTABLE,
                'error' => 'Your items are shipped now!',
            ], JsonResponse::HTTP_NOT_ACCEPTABLE);
        }

        /* $shippingDetails = ShippingDetails::where('order_id', $order_id);
        $shippingDetails->update([
            'receiver' => $request->name,
            'contactNumber' => $request->contactNumber,
            'address' => $request->address,
            'city' => $request->city,
        ]);

        return response()->json([
            'status_code' => JsonResponse::HTTP_OK,
            'order_id' => $request->order_id,
            'message' => 'Shipping details updated successfully!',
        ], JsonResponse::HTTP_OK); */
    }

    public function shipOrDeliver(Request $request, $order_id, $shippingFee, $amount)
    {

        $order = Order::where('order_id', $request->order_id);

        $orders = User::join('orders', 'users.id', 'orders.user_id')
                        ->join('products', 'orders.product_id', 'products.id')
                        ->where('orders.order_id', $request->order_id)
                        /* ->where('isShipped', true) */
                        ->select('users.id', 'users.email', 'users.firstName', 'users.lastName', 'users.profile_photo_path',
                                'users.name as fullname', 'users.provider_id', 'users.avatar', 'orders.id as orderId',
                                'orders.order_id', 'orders.user_id', 'orders.product_id', 'orders.quantity', 'orders.isOncart',
                                'orders.isCheckout', 'orders.isShipped', 'orders.isDelivered', 'orders.created_at', 'orders.updated_at',
                                'products.price', 'products.name')
                        ->get();

        event(new OrderProcessEvent($orders));

        switch ($request->actionBtn) {
            case 'shipNowBtn':
                $order->update([
                    'isCheckout' => false,
                    'isShipped' => true,
                ]);

                OrderHistory::create([
                    'order_id' => $request->order_id,
                    'user_id' => auth()->user()->id,
                    'status' => 'On Shipping',
                ]);

                return redirect()->back()->with('message', 'Items shipped successfully!');
                break;
            case 'deliveredBtn':

                $order->update([
                    'isShipped' => false,
                    'isDelivered' => true,
                ]);

                /* foreach($orders as $data)
                {
                    TotalEarning::create([
                        'order_id' => $data->order_id,
                        'item_name' => $data->name,
                        'quantity' => $data->quantity,
                        'price' => $data->price,
                        'earned' => $data->quantity * $data->price,
                    ]);
                } */

                TotalEarning::create([
                    'order_id' => $order_id,
                    'shipping_fee' => $shippingFee,
                    'amount' => $amount,
                    'earned' => $shippingFee + $amount,
                ]);

                OrderHistory::create([
                    'order_id' => $request->order_id,
                    'user_id' => auth()->user()->id,
                    'status' => 'Delivered',
                ]);
                /* $orders->first()->email */
                /* MailController::orderReceipt('melvinbayogo@gmail.com'); */

                /* $orders->first()->notify(new Invoice); */

                return redirect()->back()->with('message', 'Items delivered successfully!');
                break;
        }

        /* return response()->json([
            'status_code' => JsonResponse::HTTP_OK,
            'data' => [
                'order_id' => $request->order_id,
            ],
            'message' => 'Shipping items successfully!',
        ], JsonResponse::HTTP_OK); */
    }

}//model end
