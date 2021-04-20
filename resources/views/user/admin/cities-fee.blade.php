<x-main.app>
    @section('title', 'Cities Fee - '.$business->name)
    <x-user.admin.sidebar />
    <x-user.admin.content>
        <x-user.admin.cities-fee :cities="$cities" />
    </x-user.admin.content>
</x-main.app>
