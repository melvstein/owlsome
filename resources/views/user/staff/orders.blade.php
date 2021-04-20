<x-main.app>
    @section('title', 'Orders - '.$business->name)
    <x-user.staff.sidebar />
        <x-user.staff.content>
        <x-user.staff.navbar />
            <x-user.admin.orders :orders="$orders" />
        </x-user.staff.content>
</x-main.app>
