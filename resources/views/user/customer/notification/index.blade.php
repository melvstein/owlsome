<x-main.app>
    @section('title', 'Notifications - '.$business->name)
    <x-main.navbar :oncartCount="$oncartCount" />
        <x-user.customer.content>
            <x-user.customer.notification.index />
        <x-main.footer />
        </x-user.customer.content>
</x-main.app>
