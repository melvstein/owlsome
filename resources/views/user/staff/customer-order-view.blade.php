<x-main.app>
    @section('title', 'Customer Order View - '.$business->name)
    <x-user.staff.sidebar />
        <x-user.staff.content>
        <x-user.staff.navbar />
            <x-user.admin.customer-order-view :orderDetail="$orderDetail" :cities="$cities" />
        </x-user.staff.content>
</x-main.app>
