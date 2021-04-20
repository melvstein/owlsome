<x-main.app>
    @section('title', 'View Order List - '.$business->name)
    <x-user.staff.sidebar />
        <x-user.staff.content>
        <x-user.staff.navbar />
            <x-user.admin.view-order-list :orderDates="$orderDates" />
        </x-user.staff.content>
</x-main.app>
