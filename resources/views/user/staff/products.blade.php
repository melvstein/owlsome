<x-main.app>
    @section('title', 'Products - '.$business->name)
    <x-user.staff.sidebar />
        <x-user.staff.content>
        <x-user.staff.navbar />
            <x-user.admin.products :products="$products" />
        </x-user.staff.content>
</x-main.app>
