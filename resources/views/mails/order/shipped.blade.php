@component('mail::message')

    <p>Your order has been shipped!</p>
    <br>
    <p>Order ID: {{ $orders->first()->order_id }}</p>
    <p>Customer Name: {{ (empty($orders->first()->firstName) && empty($orders->first()->lastName)) ? $orders->first()->fullname : $orders->first()->firstName ." ". $orders->first()->lastName }}</p>
    <p>Your order has been shipped. Kindly prepare or ready your payment.</p>

@component('mail::button', ['url' => route('customer.viewOrderDetails', $orders->first()->order_id)])
    View Order Details
@endcomponent

Thank You,<br>
{{ config('app.name') }}
@endcomponent
