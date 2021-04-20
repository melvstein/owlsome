<x-main.app>
    @section('title', 'Edit Profile - '.$business->name)
    <x-user.admin.sidebar />
    <x-user.admin.content>
        <x-user.admin.edit-profile />
    </x-user.admin.content>
</x-main.app>
