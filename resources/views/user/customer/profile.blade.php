<x-main.app>
    @section('title', 'Profile - '.$business->name)
    <x-main.navbar :oncartCount="$oncartCount" />
    <div class="flex-1 max-w-7xl mx-auto">
        <div class="bg-white border rounded p-0 md:p-4 mt-4">
            <x-user.admin.profile :cities="$cities" />
        </div>
        <x-main.footer />
    </div>
</x-main.app>
