<x-main.app>
    @section('title', 'Order History - '.$business->name)
    <x-user.admin.sidebar />
    <x-user.admin.content>
        <x-user.admin.order-history :orderHistories="$orderHistories" />
    </x-user.admin.content>
</x-main.app>
