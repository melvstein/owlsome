<x-main.app>
    @section('title', 'View Order - '.$business->name)
    <x-user.staff.sidebar />
        <x-user.staff.content>
        <x-user.staff.navbar />
            <x-user.admin.view-order />
        </x-user.staff.content>
    </x-main.app>
