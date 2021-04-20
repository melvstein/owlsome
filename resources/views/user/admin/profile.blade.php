<x-main.app>
    @section('title', 'Profile - '.$business->name)
    <x-user.admin.sidebar />
    <x-user.admin.content>
        <x-user.admin.profile :cities="$cities" />
    </x-user.admin.content>
</x-main.app>
