<x-main.app>
    @section('title', 'Earnings - '.$business->name)
    <x-user.admin.sidebar />
    <x-user.admin.content>
        <x-user.admin.total-earnings :totalEarnings="$totalEarnings" :totalEarned="$totalEarned" />
    </x-user.admin.content>
</x-main.app>
