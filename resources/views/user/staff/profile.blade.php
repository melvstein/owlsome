<x-main.app>
    @section('title', 'Profile - '.$business->name)
    <x-user.staff.sidebar />
        <x-user.staff.content>
        <x-user.staff.navbar />
            <x-user.admin.profile :cities="$cities" />
        </x-user.staff.content>
</x-main.app>
