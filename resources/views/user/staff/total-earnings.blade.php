<x-main.app>
    @section('title', 'Earnings - '.$business->name)
    <x-user.staff.sidebar />
        <x-user.staff.content>
        <x-user.staff.navbar />
            <x-user.admin.total-earnings :totalEarnings="$totalEarnings" :totalEarned="$totalEarned" />
        </x-user.staff.content>
</x-main.app>
