@component('mail::message')

    <b>Owlsome Receipt</b>
    <br>
    <p>Your order has been delivered successfully!</p>
    <p>Order ID: {{ $orders->first()->order_id }}</p>
    <p>Customer Name: {{ (empty($orders->first()->firstName) && empty($orders->first()->lastName)) ? $orders->first()->fullname : $orders->first()->firstName ." ". $orders->first()->lastName }}</p>
    <br>
@component('mail::table')
@php
    $total = 0;
@endphp
| Items              | Quantity                  | Price                                  | Amount                                                    |
| :----------------- | :-----------------------: | -------------------------------------: | --------------------------------------------------------: |
@foreach($orders as $order)
| {{ $order->name }} | {{ $order->quantity }}    | {{ $pesoSign ." ". $order->price }}    | {{ $pesoSign ." ". $order->quantity * $order->price }}    |
@php
    $total += $order->quantity * $order->price;
@endphp
@endforeach
|                    |                           |                      <b>Subtotal:</b>  |                              {{ $pesoSign ." ". $total }} |
|                    |                           |                  <b>Shipping Fee:</b>  |                        {{ $pesoSign ." ". $shippingFee }} |
|                    |                           |                  <b>Total Amount:</b>  |               {{ $pesoSign ." ". $total + $shippingFee }} |
@endcomponent

@component('mail::button', ['url' => route('customer.viewOrderDetails', $orders->first()->order_id)])
    View Order Details
@endcomponent

Thank You,<br>
{{ config('app.name') }}
@endcomponent
