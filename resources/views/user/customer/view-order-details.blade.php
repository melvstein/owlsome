<x-main.app>
    @section('title', 'View Order Details - '.$business->name)
    <x-main.navbar :oncartCount="$oncartCount" />
    <x-user.customer.content>
        <x-user.customer.view-order-details :orderDetail="$orderDetail" :cities="$cities" />
        <x-main.footer />
    </x-user.customer.content>
</x-main.app>
