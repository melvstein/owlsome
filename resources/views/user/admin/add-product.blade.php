<x-main.app>
    @section('title', 'Add Product - '.$business->name)
    <x-user.admin.sidebar />
    <x-user.admin.content>
        <x-user.admin.add-product :categories="$categories" />
    </x-user.admin.content>
</x-main.app>
