<x-main.app>
    @section('title', 'Customer Order View - '.$business->name)
    <x-user.admin.sidebar />
    <x-user.admin.content>
        <x-user.admin.customer-order-view :orderDetail="$orderDetail" :cities="$cities" />
    </x-user.admin.content>
</x-main.app>
