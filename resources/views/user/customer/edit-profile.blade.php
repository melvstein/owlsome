<x-main.app>
    @section('title', 'Edit Profile - '.$business->name)
    <x-main.navbar :oncartCount="$oncartCount" />
    <div class="flex-1 max-w-7xl mx-auto">
        <div class="bg-white border rounded p-0 md:p-4 mt-4">
            <x-user.admin.edit-profile />
        </div>
        <x-main.footer />
    </div>
</x-main.app>
