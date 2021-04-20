<nav class="hidden md:flex flex-col fixed top-0 left-0 bg-white w-64 min-h-full shadow">
    <div class="flex items-center justify-center bg-yellow-900 bg-opacity-50 shadow">
        <a href="{{ route("admin.user.dashboard") }}" class="text-lg font-semibold font-serif text-yellow-900">
            @if($business->display === "Business Name")
                <p class="p-4">{{ $business->name }}</p>
            @else
                @if($business->logo_path)
                    <img src="{{ asset('storage/'.$business->logo_path) }}" alt="Business Logo" class="w-11 h-11 mx-4 my-2 rounded-full border">
                @else
                    <img src="{{ asset('storage/business/business_default_logo.png') }}" alt="Business Logo" class="w-11 h-11 mx-4 my-2 rounded-full border">
                @endif
            @endif
        </a>
    </div>
    <div class="flex flex-col">
        <a href="{{ route("admin.user.dashboard") }}" class="p-4 hover:bg-yellow-800 hover:text-gray-200 shadow {{ request()->routeIs("admin.user.dashboard") ? 'bg-yellow-900 text-gray-200' : 'text-gray-900' }}">
            <i class="fa fa-tachometer mr-2"></i> Dashboard
        </a>

        <div x-data="dropdown()">
            <a @click.prevent="open()" href="#" class="p-4 hover:bg-yellow-800 hover:text-gray-200 shadow flex items-center justify-between
            {{ request()->routeIs("admin.user.list") || request()->routeIs("admin.user.add") ? 'bg-yellow-900 text-gray-200' : 'text-gray-900' }}">
                <span>
                    <i class="fa fa-users mr-2"></i> Users
                </span>
                <svg x-show="!isOpen()" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-6">
                    <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                </svg>
                <svg x-show="isOpen()" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-6">
                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </a>
            <div x-show="isOpen()" @click.away="close()" class="flex flex-col bg-gray-200">
                <a href="{{ route("admin.user.list") }}" class="px-6 py-4 hover:bg-gray-500 hover:text-gray-200 text-sm {{ request()->routeIs("admin.user.list") ? 'bg-gray-600 text-gray-200' : 'text-gray-900' }}">
                    <i class="fa fa-circle-o mr-2"></i> User List
                </a>
                <a href="{{ route("admin.user.add") }}" class="px-6 py-4 hover:bg-gray-500 hover:text-gray-200 text-sm {{ request()->routeIs("admin.user.add") ? 'bg-gray-600 text-gray-200' : 'text-gray-900' }}">
                    <i class="fa fa-circle-o mr-2"></i> Add User
                </a>
            </div>
        </div>

        <div x-data="dropdown()">
            <a @click.prevent="open()" href="#" class="p-4 hover:bg-yellow-800 hover:text-gray-200 shadow flex items-center justify-between
            {{ request()->routeIs("admin.product.list") ||
            request()->routeIs("admin.product.add") ||
            request()->routeIs("admin.product.category") ? 'bg-yellow-900 text-gray-200' : 'text-gray-900' }}">
                <span>
                    <i class="fa fa-product-hunt mr-2"></i> Products
                </span>
                <svg x-show="!isOpen()" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-6">
                    <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                </svg>
                <svg x-show="isOpen()" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-6">
                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </a>
            <div x-show="isOpen()" @click.away="close()" class="flex flex-col bg-gray-200">
                <a href="{{ route("admin.product.list") }}" class="px-6 py-4 hover:bg-gray-500 hover:text-gray-200 text-sm {{ request()->routeIs("admin.product.list") ? 'bg-gray-600 text-gray-200' : 'text-gray-900' }}">
                    <i class="fa fa-circle-o mr-2"></i> Product List
                </a>
                <a href="{{ route("admin.product.add") }}" class="px-6 py-4 hover:bg-gray-500 hover:text-gray-200 text-sm {{ request()->routeIs("admin.product.add") ? 'bg-gray-600 text-gray-200' : 'text-gray-900' }}">
                    <i class="fa fa-circle-o mr-2"></i> Add Product
                </a>
                <a href="{{ route("admin.product.category") }}" class="px-6 py-4 hover:bg-gray-500 hover:text-gray-200 text-sm {{ request()->routeIs("admin.product.category") ? 'bg-gray-600 text-gray-200' : 'text-gray-900' }}">
                    <i class="fa fa-circle-o mr-2"></i> Category
                </a>
            </div>
        </div>
        <div x-data="dropdown()">
            <a @click.prevent="open()" href="#" class="p-4 hover:bg-yellow-800 hover:text-gray-200 shadow flex items-center justify-between
            {{ request()->routeIs("admin.order.list") ||
                request()->routeIs("admin.order.shippedOrders") ||
                request()->routeIs("admin.order.deliveredOrders") ||
                request()->routeIs("admin.order.totalEarningsView")||
                request()->routeIs("admin.order.history") ? 'bg-yellow-900 text-gray-200' : 'text-gray-900' }}">
                <span>
                    <i class="fa fa-list mr-2"></i> Orders
                </span>
                <svg x-show="!isOpen()" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-6">
                    <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                </svg>
                <svg x-show="isOpen()" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-6">
                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </a>
            <div x-show="isOpen()" @click.away="close()" class="flex flex-col bg-gray-200">
                <a href="{{ route("admin.order.list") }}" class="px-6 py-4 hover:bg-gray-500 hover:text-gray-200 text-sm {{ request()->routeIs("admin.order.list") ? 'bg-gray-600 text-gray-200' : 'text-gray-900' }}">
                    <div class="flex items-center justify-between">
                        <div>
                            <i class="fa fa-circle-o mr-2"></i> List
                        </div>
                        <span class="px-2 py-1 bg-yellow-500 text-white rounded-full text-xs">{{ $checkoutOrdersCount }}</span>
                    </div>
                </a>
                <a href="{{ route("admin.order.shippedOrders") }}" class="px-6 py-4 hover:bg-gray-500 hover:text-gray-200 text-sm {{ request()->routeIs("admin.order.shippedOrders") ? 'bg-gray-600 text-gray-200' : 'text-gray-900' }}">
                    <div class="flex items-center justify-between">
                        <div>
                            <i class="fa fa-circle-o mr-2"></i> Shipped
                        </div>
                        <span class="px-2 py-1 bg-blue-500 text-white rounded-full text-xs">{{ $shippedOrdersCount }}</span>
                    </div>
                </a>
                <a href="{{ route("admin.order.deliveredOrders") }}" class="px-6 py-4 hover:bg-gray-500 hover:text-gray-200 text-sm {{ request()->routeIs("admin.order.deliveredOrders") ? 'bg-gray-600 text-gray-200' : 'text-gray-900' }}">
                    <div class="flex items-center justify-between">
                        <div>
                            <i class="fa fa-circle-o mr-2"></i> Delivered
                        </div>
                        <span class="px-2 py-1 bg-green-500 text-white rounded-full text-xs">{{ $deliveredOrdersCount }}</span>
                    </div>
                </a>
                <a href="{{ route("admin.order.totalEarningsView") }}" class="px-6 py-4 hover:bg-gray-500 hover:text-gray-200 text-sm {{ request()->routeIs("admin.order.totalEarningsView") ? 'bg-gray-600 text-gray-200' : 'text-gray-900' }}">
                    <i class="fa fa-circle-o mr-2"></i> Earned History
                </a>
                <a href="{{ route("admin.order.history") }}" class="px-6 py-4 hover:bg-gray-500 hover:text-gray-200 text-sm {{ request()->routeIs("admin.order.history") ? 'bg-gray-600 text-gray-200' : 'text-gray-900' }}">
                    <i class="fa fa-circle-o mr-2"></i> Order History
                </a>
            </div>
        </div>
        <a href="{{ route("admin.city.list") }}" class="p-4 hover:bg-yellow-800 hover:text-gray-200 shadow flex items-center {{ request()->routeIs("admin.city.list") ? 'bg-yellow-900 text-gray-200' : 'text-gray-900' }}">
            <i class="fa fa-map-marker mr-5"></i> Cities Fee
        </a>
    </div>
</nav>
<script>

/* var sideDropdown = $(".side-dropdown");
var i;

for(i = 0; i < sideDropdown.length; i++){
    sideDropdown[i].addEventListener('click', function(){
        this.classList.toggle("active");
        var dropdownContent = this.nextElementSibling;
        if (dropdownContent.classList.contains("hidden")) {
            dropdownContent.classList.remove("hidden");
            dropdownContent.classList.add("block");
        } else {
            dropdownContent.classList.remove("block");
            dropdownContent.classList.add("hidden");
        }
    });
}
 */
</script>
