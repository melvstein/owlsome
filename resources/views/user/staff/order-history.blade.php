<x-main.app>
    @section('title', 'Order History - '.$business->name)
    <x-user.staff.sidebar />
        <x-user.staff.content>
        <x-user.staff.navbar />
            <x-user.admin.order-history :orderHistories="$orderHistories" />
        </x-user.staff.content>
    </x-main.app>
