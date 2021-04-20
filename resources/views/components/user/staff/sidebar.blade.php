<nav class="hidden md:block fixed top-0 left-0 w-64 min-h-full bg-gray-700 border-r shadow">
    <div class="relative">
        <div class="flex flex-col">
            <a href="{{ route("staff.dashboard") }}" class="text-lg font-serif font-semibold text-center text-white bg-yellow-900 border-b-2 border-gray-500">
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
            <div class="flex flex-col">
                <a href="{{ route("staff.dashboard") }}" class="p-4 text-white hover:bg-gray-800 {{ request()->routeIs('staff.dashboard') ? 'border-l-2 border-yellow-800 bg-gray-800' : '' }}"><i class="fa fa-tachometer mr-2"></i> Dashboard</a>
                <div x-data="dropdown()" class="flex flex-col">
                    <a @click.prevent="open()" href="#" :class="{ 'bg-gray-800' : isOpen() }" class="p-4 text-white hover:bg-gray-800 flex items-center justify-between
                    {{ request()->routeIs('staff.product.list') ||
                    request()->routeIs('staff.product.add') ||
                    request()->routeIs('staff.product.category') ? 'border-l-2 border-yellow-800 bg-gray-800' : '' }}">
                        <span><i class="fa fa-product-hunt mr-2"></i> Products</span>
                        <svg x-show="!isOpen()" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5">
                            <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                        </svg>
                        <svg x-show="isOpen()" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </a>
                    <div x-show.transition="isOpen()" @click.away="close()" class="flex flex-col bg-gray-600 bg-opacity-50">
                        <a href="{{ route("staff.product.list") }}" class="px-6 py-4 text-gray-300 hover:text-white {{ request()->routeIs('staff.product.list') ? 'border-l-2 border-yellow-800 bg-gray-800' : '' }}"><i class="fa fa-circle-o mr-2"></i> List</a>
                        <a href="{{ route("staff.product.add") }}" class="px-6 py-4 text-gray-300 hover:text-white {{ request()->routeIs('staff.product.add') ? 'border-l-2 border-yellow-800 bg-gray-800' : '' }}"><i class="fa fa-circle-o mr-2"></i> Add New</a>
                        <a href="{{ route("staff.product.category") }}" class="px-6 py-4 text-gray-300 hover:text-white {{ request()->routeIs('staff.product.category') ? 'border-l-2 border-yellow-800 bg-gray-800' : '' }}"><i class="fa fa-circle-o mr-2"></i> Category</a>
                    </div>
                </div>
                <div x-data="dropdown()" class="flex flex-col">
                    <a @click.prevent="open()" href="#" :class="{ 'bg-gray-800' : isOpen() }" class="p-4 text-white hover:bg-gray-800 flex items-center justify-between
                    {{ request()->routeIs('staff.order.list') ||
                    request()->routeIs('staff.order.shippedOrders') ||
                    request()->routeIs('staff.order.deliveredOrders') ||
                    request()->routeIs('staff.order.totalEarningsView') ||
                    request()->routeIs('staff.order.history') ? 'border-l-2 border-yellow-800 bg-gray-800' : '' }}">
                        <span><i class="fa fa-list mr-2"></i> Orders</span>
                        <svg x-show="!isOpen()" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5">
                            <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                        </svg>
                        <svg x-show="isOpen()" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </a>
                    <div x-show.transition="isOpen()" @click.away="close()" class="flex flex-col bg-gray-600 bg-opacity-50">
                        <a href="{{ route("staff.order.list") }}" class="px-6 py-4 text-gray-300 hover:text-white {{ request()->routeIs('staff.order.list') ? 'border-l-2 border-yellow-800 bg-gray-800' : '' }}">
                            <div class="flex items-center justify-between">
                                <div>
                                    <i class="fa fa-circle-o mr-2"></i> List
                                </div>
                                <span class="px-2 py-1 bg-yellow-500 text-white rounded-full text-xs">{{ $checkoutOrdersCount }}</span>
                            </div>
                        </a>
                        <a href="{{ route("staff.order.shippedOrders") }}" class="px-6 py-4 text-gray-300 hover:text-white {{ request()->routeIs('staff.order.shippedOrders') ? 'border-l-2 border-yellow-800 bg-gray-800' : '' }}">
                            <div class="flex items-center justify-between">
                                <div>
                                    <i class="fa fa-circle-o mr-2"></i> Shipped
                                </div>
                                <span class="px-2 py-1 bg-blue-500 text-white rounded-full text-xs">{{ $shippedOrdersCount }}</span>
                            </div>
                        </a>
                        <a href="{{ route("staff.order.deliveredOrders") }}" class="px-6 py-4 text-gray-300 hover:text-white {{ request()->routeIs('staff.order.deliveredOrders') ? 'border-l-2 border-yellow-800 bg-gray-800' : '' }}">
                            <div class="flex items-center justify-between">
                                <div>
                                    <i class="fa fa-circle-o mr-2"></i> Delivered
                                </div>
                                <span class="px-2 py-1 bg-green-500 text-white rounded-full text-xs">{{ $deliveredOrdersCount }}</span>
                            </div>
                        </a>
                        <a href="{{ route("staff.order.totalEarningsView") }}" class="px-6 py-4 text-gray-300 hover:text-white {{ request()->routeIs('staff.order.totalEarningsView') ? 'border-l-2 border-yellow-800 bg-gray-800' : '' }}">
                            <i class="fa fa-circle-o mr-2"></i> Earned
                        </a>
                        <a href="{{ route("staff.order.history") }}" class="px-6 py-4 text-gray-300 hover:text-white {{ request()->routeIs('staff.order.history') ? 'border-l-2 border-yellow-800 bg-gray-800' : '' }}">
                            <i class="fa fa-circle-o mr-2"></i> History
                        </a>
                    </div>
                </div>
                <a href="{{ route("staff.city.list") }}" class="p-4 text-white hover:bg-gray-800 {{ request()->routeIs('staff.city.list') ? 'border-l-2 border-yellow-800 bg-gray-800' : '' }}">
                    <i class="fa fa-map-marker mr-3"></i> Cities Fee
                </a>
            </div>
        </div>
    </div>
</nav>
