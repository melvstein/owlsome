<x-main.app>
    @section('title', 'Category - '.$business->name)
    <x-user.staff.sidebar />
        <x-user.staff.content>
        <x-user.staff.navbar />
            <x-user.admin.category :categories="$categories" />
        </x-user.staff.content>
    </x-main.app>
