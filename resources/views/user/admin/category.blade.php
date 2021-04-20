<x-main.app>
    @section('title', 'Category - '.$business->name)
    <x-user.admin.sidebar />
    <x-user.admin.content>
        <x-user.admin.category :categories="$categories" />
    </x-user.admin.content>
</x-main.app>
