<x-main.app>
    @section('title', 'Cart - '.$business->name)
    <x-main.navbar :oncartCount="$oncartCount" />
        <x-user.customer.content>
            <x-user.customer.cart :oncartOrders="$oncartOrders" :oncartCount="$oncartCount" :oncartTotalAmount="$oncartTotalAmount" :cities="$cities" :fee="$fee" />
        <x-main.footer />
        </x-user.customer.content>
</x-main.app>
