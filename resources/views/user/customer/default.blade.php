<x-main.app>
    @section('title', ' - '.$business->name)
    <x-main.navbar :oncartCount="$oncartCount" />
    <x-user.customer.content>

        <x-main.footer />
    </x-user.customer.content>
</x-main.app>
