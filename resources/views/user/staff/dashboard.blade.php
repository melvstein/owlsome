<x-main.app>
    @section('title', 'Dashboard - '.$business->name)
<x-user.staff.sidebar />
    <x-user.staff.content>
    <x-user.staff.navbar />
        <x-user.admin.dashboard :users="$users" :products="$products" :orders="$orders" :totalEarnings="$totalEarnings" :totalEarned="$totalEarned" />
    </x-user.staff.content>
</x-main.app>
