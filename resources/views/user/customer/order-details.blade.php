<x-main.app>
    @section('title', 'Order Details - '.$business->name)
    <x-main.navbar :oncartCount="$oncartCount" />
    <x-user.customer.content>
        <x-user.customer.order-details :checkoutOrders="$checkoutOrders"/>
        <x-main.footer />
    </x-user.customer.content>
</x-main.app>
