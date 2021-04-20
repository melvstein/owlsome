<x-main.app>
    @section('title', 'Products - '.$business->name)
    <x-user.admin.sidebar />
    <x-user.admin.content>
        <x-user.admin.products :products="$products" />
    </x-user.admin.content>
</x-main.app>
