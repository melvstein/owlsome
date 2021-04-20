<x-main.app>
    @section('title', 'Buy Now - '.$business->name)
    <x-main.navbar :oncartCount="$oncartCount" />
    <x-user.customer.content>
        <x-user.customer.buy-now :product="$product" :cities="$cities" />
        <x-main.footer />
    </x-user.customer.content>
</x-main.app>
