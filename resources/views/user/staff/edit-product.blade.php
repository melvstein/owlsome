<x-main.app>
    @section('title', 'Edit Product - '.$business->name)
    <x-user.staff.sidebar />
        <x-user.staff.content>
        <x-user.staff.navbar />
            <x-user.admin.edit-product :product="$product" :categories="$categories" />
        </x-user.staff.content>
</x-main.app>
