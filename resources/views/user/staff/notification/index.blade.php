<x-main.app>
@section('title', 'Notifications - '.$business->name)
<x-user.staff.sidebar />
<x-user.staff.content>
    <x-user.staff.navbar />
    <x-user.admin.notification.index :notifications="$notifications" />
</x-user.staff.content>
</x-main.app>
