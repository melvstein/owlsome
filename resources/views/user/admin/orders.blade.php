<x-main.app>
    @section('title', 'Orders - '.$business->name)
    <x-user.admin.sidebar />
    <x-user.admin.content>
        <x-user.admin.orders :orders="$orders" />
    </x-user.admin.content>
</x-main.app>
