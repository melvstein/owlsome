@php
    $total = 0;
@endphp

@component('mail::message')
<b>Owlsome Receipt</b>
<br>
<p>Order ID: {{ $orders->first()->order_id }}</p>
<p>Customer Name: {{ $orders->first()->firstName ." ". $orders->first()->lastName }}</p>
<br>
@component('mail::table')
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

{{-- @component('mail::button', ['url' => ''])
Button Text
@endcomponent --}}

Thank you,<br>
{{ config('app.name') }}
@endcomponent
