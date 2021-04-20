@php
    $total = 0;
@endphp

@component('mail::message')

@if($orders->first()->isCheckout == true)

    <b>Owlsome Order Shipped</b>
    <br>
    <p>Order ID: {{ $orders->first()->order_id }}</p>
    <p>Customer Name: {{ $orders->first()->firstName ." ". $orders->first()->lastName }}</p>
    <p>Your order has been shipped. Please prepare or ready your payment.</p>
    <br>

@elseif($orders->first()->isShipped == true)

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

@endif

@component('mail::button', ['url' => route('customer.viewOrderDetails', $orders->first()->order_id)])
    View Order Details
@endcomponent

Thank you,<br>
{{ config('app.name') }}
@endcomponent
