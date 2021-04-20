<x-main.app>
@section('title', 'Add Product - '.$business->name)
<x-user.staff.sidebar />
<x-user.staff.content>
    <x-user.staff.navbar />
        <x-user.admin.add-product :categories="$categories" />
</x-user.staff.content>
</x-main.app>
