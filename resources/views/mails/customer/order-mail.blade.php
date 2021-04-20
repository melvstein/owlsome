@component('mail::message')
<h1>
    New Order
</h1>
<p>
    Customer: {{ (empty($customer['firstName']) && empty($customer['lastName'])) ? $customer['name'] : $customer['firstName'] ." ". $customer['lastName'] }}
</p>
<p>
    Order ID: {{ $details['order_id'] }}
</p>
{{--
Thank You,<br>
{{ config('app.name') }}
 --}}
@endcomponent
