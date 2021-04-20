<x-main.app>
    @section('title', 'Edit Product - '.$business->name)
    <x-user.admin.sidebar />
    <x-user.admin.content>
        <x-user.admin.edit-product :product="$product" :categories="$categories" />
    </x-user.admin.content>
</x-main.app>
