<x-main.app>
    @section('title', 'Notifications - '.$business->name)
    <x-user.admin.sidebar />
    <x-user.admin.content>
        <x-user.admin.notification.index :notifications="$notifications" />
    </x-user.admin.content>
</x-main.app>
