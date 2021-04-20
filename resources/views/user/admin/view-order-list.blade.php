<x-main.app>
    @section('title', 'View Order List - '.$business->name)
    <x-user.admin.sidebar />
    <x-user.admin.content>
        <x-user.admin.view-order-list :orderDates="$orderDates" />
    </x-user.admin.content>
</x-main.app>
