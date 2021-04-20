<nav class="relative flex bg-yellow-800 px-4 shadow">
    <div class="hidden md:flex items-center justify-between w-full">
        {{-- <div class="flex items-center">
            <a href="" class="p-4 hover:bg-yellow-900 hover:bg-opacity-75 text-white font-semibold">
                {{ auth()->user()->role .": ". auth()->user()->firstName ." ". Str::substr(auth()->user()->middleName, 0, 1) .". ". auth()->user()->lastName }}
            </a>
        </div> --}}
        <a href="{{ route("home") }}" class="text-white font-semibold hover:bg-gray-200 hover:text-yellow-900 rounded hover:shadow p-4">
            <i class="fa fa-home"></i> Home
        </a>
        <div class="flex items-center">
            <a href="{{ route(Str::lower(auth()->user()->role).'.notification.index') }}" class="text-white p-4 flex">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                </svg>
                <span class="bg-green-500 text-white px-1 rounded-full text-xs flex items-center justify-center">
                    {{ /* auth()->user()->unreadNotifications->count() */ $adminUnreadNotifications->count() }}
                </span>
            </a>
            <div x-data="dropdown()">
                <a @click.prevent="open()" href="#" :class="{'bg-yellow-900 hover:bg-opacity-75' : isOpen()}" class="p-4 hover:bg-yellow-900 hover:bg-opacity-75 text-white font-semibold flex items-center justify-between">
                    <span class="flex items-center mr-2 text-sm">
                        @if(auth()->user()->profile_photo_path)
                            <img src="{{ asset('storage/' . auth()->user()->profile_photo_path) }}" class="w-8 h-8 rounded-full mr-2" alt="User Profile">
                        @else
                            <img src="{{ asset('storage/user/user_default_photo.png') }}" class="w-8 h-8 rounded-full mr-2" alt="User Profile">
                        @endif
                        {{ auth()->user()->role .": ". auth()->user()->firstName ." ". Str::substr(auth()->user()->middleName, 0, 1) .". ". auth()->user()->lastName }}
                    </span>
                    <svg x-show="!isOpen()" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5">
                        <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                      </svg>
                    <svg x-show="isOpen()" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </a>
                <div x-show.transition="isOpen()" @click.away="close()" class="absolute bg-white border rounded shadow flex flex-col w-40 -mt-2 right-6 z-10 py-2">
                    <a href="{{ route("staff.profile") }}" class="p-4 text-sm {{ request()->routeIs('staff.profile') ? 'bg-gray-100 text-yellow-900' : 'text-gray-800 hover:bg-gray-100 hover:text-yellow-900' }}">Profile</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a href="{{ route('logout') }}" class="block p-4 text-gray-800 hover:bg-gray-100 hover:text-yellow-900 text-sm" onclick="event.preventDefault(); this.closest('form').submit();">
                            Logout
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Responsive Navbar -->
    <div class="flex md:hidden items-center justify-between w-full">
        <div class="flex items-center">
            <a href="{{ route("staff.dashboard") }}" class="text-white text-lg font-semibold font-serif">
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
        <div x-data="dropdown()">
            <button class="flex items-center justify-center">
                <svg @click="open()" x-show="!isOpen()" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-8 text-white">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
                <svg @click="close()" x-show="isOpen()" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-8 text-white">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
            <div x-show.transition="isOpen()" @click.away="close()" class="absolute flex flex-col bg-yellow-700 top-0 left-0 min-w-full shadow z-10">
                <div class="flex items-center justify-between bg-white shadow">
                    <div class="flex items-center justify-center p-4">
                        @if(auth()->user()->profile_photo_path)
                            <img src="{{ asset('storage/' . auth()->user()->profile_photo_path) }}" class="w-8 h-8 rounded-full mr-2" alt="User Profile">
                        @else
                            <img src="{{ asset('storage/user/user_default_photo.png') }}" class="w-8 h-8 rounded-full mr-2" alt="User Profile">
                        @endif
                        <a href="{{ route("staff.profile") }}" class="text-yellow-900">
                            {{ auth()->user()->role .": ". auth()->user()->firstName ." ". Str::substr(auth()->user()->middleName, 0, 1) .". ". auth()->user()->lastName }}
                        </a>
                    </div>
                    <div class="p-4">
                        <button class="flex items-center justify-center">
                            <svg @click="close()" x-show="isOpen()" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-8 text-yellow-900 hover:text-red-500">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
                <a href="{{ route("staff.dashboard") }}" class="p-4 text-white hover:bg-yellow-800"><i class="fa fa-tachometer mr-2"></i> Dashboard</a>
                <a href="{{ route("home") }}" class="p-4 text-white hover:bg-yellow-800"><i class="fa fa-home mr-2"></i> Home</a>
                <div x-data="dropdown()" class="flex flex-col">
                    <a @click.prevent="open()" href="#" :class="{ 'bg-yellow-800' : isOpen(), '' : !isOpen() }" class="p-4 text-white hover:bg-yellow-800 flex items-center justify-between">
                        <span><i class="fa fa-product-hunt mr-2"></i> Products</span>
                        <svg x-show="!isOpen()" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5">
                            <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                        </svg>
                        <svg x-show="isOpen()" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </a>
                    <div x-show.transition="isOpen()" @click.away="close()" class="flex flex-col bg-gray-600 bg-opacity-50">
                        <a href="{{ route("staff.product.list") }}" class="px-6 py-4 text-gray-300 hover:text-white"><i class="fa fa-circle-o mr-2"></i> List</a>
                        <a href="{{ route("staff.product.add") }}" class="px-6 py-4 text-gray-300 hover:text-white"><i class="fa fa-circle-o mr-2"></i> Add New</a>
                        <a href="{{ route("staff.product.category") }}" class="px-6 py-4 text-gray-300 hover:text-white"><i class="fa fa-circle-o mr-2"></i> Category</a>
                    </div>
                </div>
                <div x-data="dropdown()" class="flex flex-col">
                    <a @click.prevent="open()" href="#" :class="{ 'bg-yellow-800' : isOpen(), '' : !isOpen() }" class="p-4 text-white hover:bg-yellow-800 flex items-center justify-between">
                        <span><i class="fa fa-list mr-2"></i> Orders</span>
                        <svg x-show="!isOpen()" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5">
                            <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                        </svg>
                        <svg x-show="isOpen()" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </a>
                    <div x-show.transition="isOpen()" @click.away="close()" class="flex flex-col bg-gray-600 bg-opacity-50">
                        <a href="{{ route('staff.order.list') }}" class="px-6 py-4 text-gray-300 hover:text-white">
                            <div class="flex items-center justify-between">
                                <div>
                                    <i class="fa fa-circle-o mr-2"></i> List
                                </div>
                                <span class="px-2 py-1 bg-yellow-500 text-white rounded-full text-xs">{{ $checkoutOrdersCount }}</span>
                            </div>
                        </a>
                        <a href="{{ route('staff.order.shippedOrders') }}" class="px-6 py-4 text-gray-300 hover:text-white">
                            <div class="flex items-center justify-between">
                                <div>
                                    <i class="fa fa-circle-o mr-2"></i> Shipped
                                </div>
                                <span class="px-2 py-1 bg-blue-500 text-white rounded-full text-xs">{{ $shippedOrdersCount }}</span>
                            </div>
                        </a>
                        <a href="{{ route('staff.order.deliveredOrders') }}" class="px-6 py-4 text-gray-300 hover:text-white">
                            <div class="flex items-center justify-between">
                                <div>
                                    <i class="fa fa-circle-o mr-2"></i> Delivered
                                </div>
                                <span class="px-2 py-1 bg-green-500 text-white rounded-full text-xs">{{ $deliveredOrdersCount }}</span>
                            </div>
                        </a>
                        <a href="{{ route('staff.order.totalEarningsView') }}" class="px-6 py-4 text-gray-300 hover:text-white"><i class="fa fa-circle-o mr-2"></i> Earned</a>
                        <a href="{{ route('staff.order.history') }}" class="px-6 py-4 text-gray-300 hover:text-white"><i class="fa fa-circle-o mr-2"></i> History</a>
                    </div>
                </div>
                <a href="{{ route("staff.city.list") }}" class="p-4 text-white hover:bg-yellow-800"><i class="fa fa-map-marker mr-3"></i> Cities Fee</a>
                <a href="{{ route("staff.notification.index") }}" class="p-4 text-white hover:bg-yellow-800">

                    <div class="flex items-center justify-between">
                        <div>
                            <i class="fa fa-bell mr-2"></i> Notifications
                        </div>
                        <span class="px-2 py-1 bg-green-500 text-white rounded-full text-xs">
                            {{ /* auth()->user()->unreadNotifications->count() */ $adminUnreadNotifications->count() }}
                        </span>
                    </div>
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a href="{{ route('logout') }}" class="flex items-center p-4 text-white hover:bg-yellow-800" onclick="event.preventDefault(); this.closest('form').submit();"><i class="fa fa-sign-out mr-2"></i> Logout</a>
                </form>
            </div>
        </div>
    </div>
</nav>
