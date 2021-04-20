<x-main.app>
    @section('title', 'Shipped Orders - '.$business->name)
    <x-user.staff.sidebar />
        <x-user.staff.content>
        <x-user.staff.navbar />
            <x-user.admin.shipped-orders :shippedOrders="$shippedOrders" />
        </x-user.staff.content>
</x-main.app>
