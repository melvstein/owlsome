<x-main.app>
    @section('title', 'View Order - '.$business->name)
    <x-user.admin.sidebar />
    <x-user.admin.content>
        <x-user.admin.view-order />
    </x-user.admin.content>
</x-main.app>
