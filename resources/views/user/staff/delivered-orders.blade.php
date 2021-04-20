<x-main.app>
    @section('title', 'Delivered Orders - '.$business->name)
    <x-user.staff.sidebar />
        <x-user.staff.content>
        <x-user.staff.navbar />
            <x-user.admin.delivered-orders :deliveredOrders="$deliveredOrders" />
        </x-user.staff.content>
</x-main.app>
