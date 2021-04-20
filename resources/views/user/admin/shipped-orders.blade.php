<x-main.app>
    @section('title', 'Shipped Orders - '.$business->name)
    <x-user.admin.sidebar />
    <x-user.admin.content>
        <x-user.admin.shipped-orders :shippedOrders="$shippedOrders" />
    </x-user.admin.content>
</x-main.app>
