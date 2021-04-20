<x-main.app>
    @section('title', 'Edit Profile - '.$business->name)
    <x-user.staff.sidebar />
        <x-user.staff.content>
        <x-user.staff.navbar />
            <x-user.admin.edit-profile />
        </x-user.staff.content>
</x-main.app>
