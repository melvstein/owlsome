<nav class="relative shadow px-4">
    <div class="hidden md:flex items-center justify-between w-full">
        <a href="{{ route('home') }}" class="text-gray-700 font-semibold hover:bg-gray-200 hover:text-gray-600 rounded hover:shadow p-4">
            <i class="fa fa-home"></i> Home
        </a>
        <div class="flex items-center justify-center space-x-4">
            <a href="{{ route(Str::lower(auth()->user()->role).'.notification.index') }}" class="text-gray-700 p-4 flex">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                </svg>
                <span class="bg-green-500 text-white px-1 rounded-full text-xs flex items-center justify-center">
                    {{ /* auth()->user()->unreadNotifications->count() */ $adminUnreadNotifications->count() }}
                </span>
            </a>
            <div x-data="dropdown()" class="flex items-center">
                <a @click.prevent="open()" @keydown.escape="close()" href="#" class="flex items-center p-4 text-gray-700">
                    <div class="flex items-center">
                        @if(auth()->user()->profile_photo_path)
                        <img src="{{ asset('storage/'.auth()->user()->profile_photo_path) }}" class="w-8 h-8 rounded-full mr-2" alt="User Profile">
                        @else
                            <img src="{{ asset('storage/user/user_default_photo.png') }}" class="w-8 h-8 -full mr-2" alt="User Profile">
                        @endif
                        {{ auth()->user()->role .": ". auth()->user()->firstName ." ". auth()->user()->lastName }}
                    </div>
                    <svg x-show="!isOpen()" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-6">
                        <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                    </svg>
                    <svg x-show="isOpen()" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-6">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </a>
                <div x-show.transition="isOpen()" @click.away="close()" class="absolute flex flex-col bg-white rounded shadow border z-10 py-2 mt-32 mr-10 right-0">
                    <a href="{{ route("admin.user.profile") }}" class="pl-4 pr-24 py-2 text-gray-800 hover:bg-gray-100 hover:text-yellow-900 text-sm">Profile</a>
                    <a href="{{ route("admin.business.information") }}" class="pl-4 pr-24 py-2 text-gray-800 hover:bg-gray-100 hover:text-yellow-900 text-sm">Business Information</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a href="{{ route('logout') }}" class="flex pl-4 pr-24 py-2 text-gray-800 hover:bg-gray-100 hover:text-yellow-900 text-sm" onclick="event.preventDefault(); this.closest('form').submit();">
                            Logout
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Responsive Navbar -->
    <div class="flex md:hidden items-center justify-between">
        <a href="{{ route('admin.user.dashboard') }}" class="text-lg font-serif font-semibold text-yellow-900">
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

        <div x-data="dropdown()" class="">
            <button @click.prevent="open()" class="text-yellow-900">
                <svg @click="open()" x-show="!isOpen()" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-8">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
                <svg @click="close()" x-show="isOpen()" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-8">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
            <div x-show.transition="isOpen()" @click.away="close()" class="absolute flex flex-col bg-white shadow top-0 left-0 w-full z-10">
                <div class="flex items-center justify-between bg-gray-200 shadow">
                    <a href="{{ route("admin.user.dashboard") }}" class="text-yellow-900 text-lg font-serif font-semibold">
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
                    <button class="">
                        <svg @click="close()" x-show="isOpen()" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-8 text-red-500 hover:text-red-400">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <div class="flex flex-col mt-2">
                    <a href="{{ route('admin.user.dashboard') }}" class="text-gray-800 hover:text-yellow-800 p-4 hover:bg-gray-200 {{ request()->routeIs("admin.user.dashboard") ? 'bg-gray-200 border-l-4 border-yellow-800 shadow' : '' }}">
                        Dashboard
                    </a>
                    <a href="{{ route('home') }}" class="text-gray-800 hover:text-yellow-800 p-4 hover:bg-gray-200">Home</a>

                    <div x-data="dropdown()">
                        <a @click.prevent="open()" href="#" class="text-gray-800 hover:text-yellow-800 p-4 hover:bg-gray-200 flex items-center justify-between {{ request()->routeIs("admin.user.list") || request()->routeIs("admin.user.add") ? 'bg-gray-200 border-l-4 border-yellow-800 shadow' : '' }}">
                            Users
                            <svg x-show="!isOpen()" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-6">
                                <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                            <svg x-show="isOpen()" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-6">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </a>
                        <div x-show.transition="isOpen()" @click.away="close()" class="flex flex-col shadow">
                            <a href="{{ route('admin.user.list') }}" class="text-gray-800 hover:text-yellow-800 px-6 py-2 hover:bg-gray-200 {{ request()->routeIs("admin.user.list") ? 'bg-gray-200 border-l-4 border-yellow-800 shadow' : '' }}">User List</a>
                            <a href="{{ route('admin.user.add') }}" class="text-gray-800 hover:text-yellow-800 px-6 py-2 hover:bg-gray-200 {{ request()->routeIs("admin.user.add") ? 'bg-gray-200 border-l-4 border-yellow-800 shadow' : '' }}">Add User</a>
                        </div>
                    </div>

                    <div x-data="dropdown()">
                        <a @click.prevent="open()" href="#" class="text-gray-800 hover:text-yellow-800 p-4 hover:bg-gray-200 flex items-center justify-between
                            {{ request()->routeIs("admin.product.list") ||
                            request()->routeIs("admin.product.add") ||
                            request()->routeIs("admin.product.category") ? 'bg-gray-200 border-l-4 border-yellow-800 shadow' : '' }}">
                            Products
                            <svg x-show="!isOpen()" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-6">
                                <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                            <svg x-show="isOpen()" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-6">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </a>
                        <div x-show.transition="isOpen()" @click.away="close()" class="flex flex-col shadow">
                            <a href="{{ route('admin.product.list') }}" class="text-gray-800 hover:text-yellow-800 px-6 py-2 hover:bg-gray-200 {{ request()->routeIs("admin.product.list") ? 'bg-gray-200 border-l-4 border-yellow-800 shadow' : '' }}">Product List</a>
                            <a href="{{ route('admin.product.add') }}" class="text-gray-800 hover:text-yellow-800 px-6 py-2 hover:bg-gray-200 {{ request()->routeIs("admin.product.add") ? 'bg-gray-200 border-l-4 border-yellow-800 shadow' : '' }}">Add Product</a>
                            <a href="{{ route('admin.product.category') }}" class="text-gray-800 hover:text-yellow-800 px-6 py-2 hover:bg-gray-200 {{ request()->routeIs("admin.product.category") ? 'bg-gray-200 border-l-4 border-yellow-800 shadow' : '' }}">Category</a>
                        </div>
                    </div>

                    <div x-data="dropdown()">
                        <a @click.prevent="open()"
                            href="#"
                            class="text-gray-800 hover:text-yellow-800 p-4 hover:bg-gray-200 flex items-center justify-between
                                {{ request()->routeIs("admin.order.list") ||
                                request()->routeIs("admin.order.shippedOrders") ||
                                request()->routeIs("admin.order.deliveredOrders") ||
                                request()->routeIs("admin.order.totalEarningsView")||
                                request()->routeIs("admin.order.history") ? 'bg-gray-200 border-l-4 border-yellow-800 shadow' : '' }}">
                            Orders
                            <svg x-show="!isOpen()" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-6">
                                <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                            <svg x-show="isOpen()" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-6">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </a>
                        <div x-show.transition="isOpen()" @click.away="close()" class="flex flex-col shadow">
                            <a href="{{ route('admin.order.list') }}" class="text-gray-800 hover:text-yellow-800 px-6 py-2 hover:bg-gray-200 {{ request()->routeIs("admin.order.list") ? 'bg-gray-200 border-l-4 border-yellow-800 shadow' : '' }}">
                                <div class="flex items-center justify-between">
                                    List <span class="px-2 py-1 bg-yellow-500 text-white rounded-full text-xs">{{ $checkoutOrdersCount }}</span>
                                </div>
                            </a>
                            <a href="{{ route('admin.order.shippedOrders') }}" class="text-gray-800 hover:text-yellow-800 px-6 py-2 hover:bg-gray-200 {{ request()->routeIs("admin.order.shippedOrders") ? 'bg-gray-200 border-l-4 border-yellow-800 shadow' : '' }}">
                                <div class="flex items-center justify-between">
                                    Shipped <span class="px-2 py-1 bg-blue-500 text-white rounded-full text-xs">{{ $shippedOrdersCount }}</span>
                                </div>
                            </a>
                            <a href="{{ route('admin.order.deliveredOrders') }}" class="text-gray-800 hover:text-yellow-800 px-6 py-2 hover:bg-gray-200 {{ request()->routeIs("admin.order.deliveredOrders") ? 'bg-gray-200 border-l-4 border-yellow-800 shadow' : '' }}">
                                <div class="flex items-center justify-between">
                                    Delivered <span class="px-2 py-1 bg-green-500 text-white rounded-full text-xs">{{ $deliveredOrdersCount }}</span>
                                </div>
                            </a>
                            <a href="{{ route('admin.order.totalEarningsView') }}" class="text-gray-800 hover:text-yellow-800 px-6 py-2 hover:bg-gray-200 {{ request()->routeIs("admin.order.totalEarningsView") ? 'bg-gray-200 border-l-4 border-yellow-800 shadow' : '' }}">Earned History</a>
                            <a href="{{ route('admin.order.history') }}" class="text-gray-800 hover:text-yellow-800 px-6 py-2 hover:bg-gray-200 {{ request()->routeIs("admin.order.history") ? 'bg-gray-200 border-l-4 border-yellow-800 shadow' : '' }}">Order History</a>
                        </div>
                    </div>
                    <a href="{{ route("admin.city.list") }}" class="text-gray-800 hover:text-yellow-800 p-4 hover:bg-gray-200 flex items-center justify-between {{ request()->routeIs("admin.city.list") ? 'bg-gray-200 border-l-4 border-yellow-800 shadow' : '' }}">
                        Cities Fee
                    </a>
                    <a href="{{ route('admin.user.profile') }}" class="text-gray-800 hover:text-yellow-800 p-4 hover:bg-gray-200">Profile</a>
                    <a href="{{ route('admin.notification.index') }}" class="text-gray-800 hover:text-yellow-800 p-4 hover:bg-gray-200">
                        <div class="flex items-center justify-between">
                            Notifications
                            <span class="px-2 py-1 bg-green-500 text-white rounded-full text-xs">
                                {{ /* auth()->user()->unreadNotifications->count() */ $adminUnreadNotifications->count() }}
                            </span>
                        </div>
                    </a>
                    <a href="{{ route('admin.business.information') }}" class="text-gray-800 hover:text-yellow-800 p-4 hover:bg-gray-200">Business Information</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a href="{{ route('logout') }}" class="flex text-gray-800 hover:text-yellow-800 p-4 hover:bg-gray-200" onclick="event.preventDefault(); this.closest('form').submit();">
                            Logout
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</nav>
<script>
/* var navDropdown = document.querySelector(".nav-dropdown");
var showmenu = $("#showmenu");
var responsiveDropdown = $(".responsive-dropdown");
var j;

function change(x){
    x.classList.toggle("change");

    if(showmenu.hasClass("hidden")){
        showmenu.removeClass("hidden").addClass("block");
        console.log("Open Menu");
    }else{
        showmenu.removeClass("block").addClass("hidden");
        console.log("Close Menu");
    }
}

navDropdown.addEventListener("click", function(){
    this.classList.toggle("active");
    var navDropdownContent = this.nextElementSibling;
    if(navDropdownContent.classList.contains("hidden")){
        navDropdownContent.classList.remove("hidden");
        navDropdownContent.classList.add("block");
    }else{
        navDropdownContent.classList.remove("block");
        navDropdownContent.classList.add("hidden");
    }
});

for(j = 0; j < responsiveDropdown.length; j++){
    responsiveDropdown[j].addEventListener('click', function(){
        this.classList.toggle("active");
        var responsiveDropdownContent = this.nextElementSibling;
        if (responsiveDropdownContent.classList.contains("hidden")) {
            responsiveDropdownContent.classList.remove("hidden");
            responsiveDropdownContent.classList.add("block");
        } else {
            responsiveDropdownContent.classList.remove("block");
            responsiveDropdownContent.classList.add("hidden");
        }
    });
}
 */
</script>
