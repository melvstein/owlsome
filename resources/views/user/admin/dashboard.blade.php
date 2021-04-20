<x-main.app>
    @section('title', 'Dashboard - '.$business->name)
    <x-user.admin.sidebar />
    <x-user.admin.content>
        <x-user.admin.dashboard :users="$users" :products="$products" :orders="$orders" :totalEarnings="$totalEarnings" :totalEarned="$totalEarned" />
    </x-user.admin.content>
</x-main.app>
