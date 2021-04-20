<x-main.app>
    @section('title', 'Cities Fee - '.$business->name)
    <x-user.staff.sidebar />
        <x-user.staff.content>
        <x-user.staff.navbar />
        <x-user.admin.cities-fee :cities="$cities" />
        </x-user.staff.content>
</x-main.app>
