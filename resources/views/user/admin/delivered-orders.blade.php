<x-main.app>
    @section('title', 'Delivered Orders - '.$business->name)
    <x-user.admin.sidebar />
    <x-user.admin.content>
        <x-user.admin.delivered-orders :deliveredOrders="$deliveredOrders" />
    </x-user.admin.content>
</x-main.app>
