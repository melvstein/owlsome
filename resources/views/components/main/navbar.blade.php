<div x-data="{ scrollAtTop : true }">
<nav class="z-10" :class="{'fixed bg-yellow-900 shadow w-full top-0' : !scrollAtTop, 'relative bg-yellow-900 bg-opacity-75' : scrollAtTop}" @scroll.window="scrollAtTop = (window.pageYOffset > 50) ? false : true">
    <div class="hidden md:flex items-center justify-between max-w-7xl mx-auto">
        <div class="flex items-center justify-center gap-2">
            <a href="{{ route("home") }}" class="text-lg font-semibold font-serif text-white no-underline rounded">
                @if($business->display === "Business Name")
                <p class="px-4 py-2">{{ $business->name }}</p>
            @else
                @if($business->logo_path)
                    <img src="{{ asset('storage/'.$business->logo_path) }}" alt="Business Logo" class="w-11 h-11 mx-4 rounded-full border">
                @else
                    <img src="{{ asset('storage/business/business_default_logo.png') }}" alt="Business Logo" class="w-11 h-11 mx-4 rounded-full border">
                @endif
            @endif
            </a>
             <x-main.nav-link :href="route('home')" :active="request()->routeIs('home')">Home</x-main.nav-link>
             <x-main.nav-link :href="route('contactUsView')" :active="request()->routeIs('contactUsView')">Contact Us</x-main.nav-link>
        </div>
        <div class="flex items-center justify-center">
             @auth
                @if(auth()->user()->role == "Customer")
                    <x-main.nav-cart-link :href="route('customer.cart')" :active="request()->routeIs('customer.cart')" data-name="cartItemCount">{{ $oncartCount->count() }}</x-main.nav-cart-link>
                @endif
                <a href="{{ route(Str::lower(auth()->user()->role).'.notification.index') }}" class="text-white p-4 flex">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                    </svg>
                    <span class="bg-green-500 text-white px-1 rounded-full text-xs flex items-center justify-center">
                        @if(auth()->user()->role == "Customer")
                            {{ auth()->user()->unreadNotifications->count() }}
                        @else
                            {{ $adminUnreadNotifications->count() }}
                        @endif
                    </span>
                </a>
                 <div x-data="dropdown()">
                     <a @click.prevent="open()" href="#" :class="{ 'bg-yellow-800' : isOpen() }" class="text-white px-3 py-3 hover:bg-yellow-800 flex items-center justify-between">
                         <div class="flex items-center">
                            @if(auth()->user()->profile_photo_path)
                                <img src="{{ asset('storage/' . auth()->user()->profile_photo_path) }}" class="w-8 h-8 rounded-full mr-2" alt="User Profile">
                            @elseif(is_null(auth()->user()->profile_photo_path) && auth()->user()->avatar)
                                <img src="{{ auth()->user()->avatar }}" class="w-8 h-8 rounded-full mr-2" alt="User Profile">
                            @else
                                <img src="{{ asset('storage/user/user_default_photo.png') }}" class="w-8 h-8 rounded mr-2" alt="User Profile">
                            @endif

                            @if(empty(auth()->user()->firstName) && empty(auth()->user()->lastName))
                                {{ auth()->user()->role .": ". auth()->user()->name }}
                            @else
                                {{ auth()->user()->role .": ". auth()->user()->firstName ." ". auth()->user()->lastName }}
                            @endif
                         </div>
                         <svg x-show="!isOpen()" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-6">
                             <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                         </svg>
                         <svg x-show="isOpen()" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-6">
                             <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                         </svg>
                     </a>
                     <div x-show.transition="isOpen()" @click.away="close()" class="absolute flex flex-col bg-white rounded shadow border w-44 z-10 py-2 ml-28 -mt-2">
                         @if(auth()->user()->role == "Admin")
                             <a href="{{ route('admin.user.dashboard') }}" class="pl-4 pr-16 py-2 text-gray-800 hover:bg-gray-100 hover:text-yellow-900 text-sm">
                                 Dashboard
                             </a>
                         @elseif(auth()->user()->role == "Staff")
                             <a href="{{ route('staff.dashboard') }}" class="pl-4 pr-16 py-2 text-gray-800 hover:bg-gray-100 hover:text-yellow-900 text-sm">
                                 Dashboard
                             </a>
                         @else
                             <a href="{{ route('customer.profile') }}" class="pl-4 pr-16 py-2 text-sm {{ request()->routeIs('customer.profile') ? 'bg-gray-100 text-yellow-900' : 'text-gray-800 hover:bg-gray-100 hover:text-yellow-900' }}">
                                 Profile
                             </a>
                             <a href="{{ route('customer.orderDetails') }}" class="pl-4 pr-16 py-2 text-sm {{ request()->routeIs('customer.orderDetails') ? 'bg-gray-100 text-yellow-900' : 'text-gray-800 hover:bg-gray-100 hover:text-yellow-900' }}">
                                 Order Details
                             </a>
                         @endif
                         <form method="POST" action="{{ route('logout') }}">
                             @csrf
                             <a href="{{ route('logout') }}" class="flex pl-4 pr-16 py-2 text-gray-800 hover:bg-gray-100 hover:text-yellow-900 text-sm" onclick="event.preventDefault(); this.closest('form').submit();">
                                 Logout
                             </a>
                         </form>
                     </div>
                 </div>
             @endauth

             @guest
                <x-main.nav-cart-link :href="route('customer.cart')" :active="request()->is('cart')">0</x-main.nav-cart-link>
                <x-main.nav-link :href="route('login')" :active="request()->routeIs('login')">Login</x-main.nav-link>
                <x-main.nav-link :href="route('register')" :active="request()->routeIs('register')">Register</x-main.nav-link>
             @endguest
        </div>
     </div>
<!-- Responsive Bar -->
<div class="flex md:hidden items-center justify-between w-full">
    <div class="flex items-center">
        <a href="{{ route('home') }}" class="text-white text-lg font-semibold font-serif">
            @if($business->display === "Business Name")
                <p class="px-4 py-2">{{ $business->name }}</p>
            @else
                @if($business->logo_path)
                    <img src="{{ asset('storage/'.$business->logo_path) }}" alt="Business Logo" class="w-11 h-11 mx-4 my-2 rounded-full border">
                @else
                    <img src="{{ asset('storage/business/business_default_logo.png') }}" alt="Business Logo" class="w-11 h-11 mx-4 my-2 rounded-full border">
                @endif
            @endif
        </a>
    </div>
    <div x-data="dropdown()" class="p-4">
        <div class="flex items-center justify-center">
            @auth
                <div class="flex items-center justify-center">
                    @if(auth()->user()->role == "Customer")
                    <a href="{{ route('customer.cart') }}" class="flex items-center justify-center text-white animate-bounce p-4 {{ request()->routeIs('customer.cart') ? 'bg-gray-200 rounded-full text-yellow-900' : '' }}">
                        <span data-name="cartItemCount"><i class="fa fa-shopping-cart"></i> {{ $oncartCount->count() }}</span>
                    </a>
                    @endif
                    <a href="{{ route(Str::lower(auth()->user()->role).'.notification.index') }}" class="text-white p-4 flex">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                        </svg>
                        <span class="bg-green-500 text-white px-1 rounded-full text-xs flex items-center justify-center">
                            @if(auth()->user()->role == "Customer")
                                {{ auth()->user()->unreadNotifications->count() }}
                            @else
                                {{ $adminUnreadNotifications->count() }}
                            @endif
                        </span>
                    </a>
                </div>
            @endauth
            @guest
                <a href="{{ route('customer.cart') }}" class="flex items-center justify-center text-white animate-bounce">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    <span>0</span>
                </a>
            @endguest
            <button class="flex items-center justify-center">
                <svg @click="open()" x-show="!isOpen()" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-8 text-white">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
                <svg @click="close()" x-show="isOpen()" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-8 text-white">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <div x-show.transition="isOpen()" @click.away="close()" class="absolute flex flex-col bg-white shadow top-0 left-0 min-w-full z-10">
            <div class="flex items-center justify-between bg-yellow-900 bg-opacity-50">
                @auth
                    <a href="javascript:void(0)" class="flex items-center p-4 text-yellow-900">
                        @if(auth()->user()->profile_photo_path)
                            <img src="{{ asset('storage/' . auth()->user()->profile_photo_path) }}" class="w-8 h-8 rounded-full mr-2" alt="User Profile">
                        @elseif(is_null(auth()->user()->profile_photo_path) && auth()->user()->avatar)
                            <img src="{{ auth()->user()->avatar }}" class="w-8 h-8 rounded-full mr-2" alt="User Profile">
                        @else
                            <img src="{{ asset('storage/user/user_default_photo.png') }}" class="w-8 h-8 rounded mr-2" alt="User Profile">
                        @endif

                        @if(empty(auth()->user()->firstName) && empty(auth()->user()->lastName))
                            {{ auth()->user()->role .": ". auth()->user()->name }}
                        @else
                            {{ auth()->user()->role .": ". auth()->user()->firstName ." ". auth()->user()->lastName }}
                        @endif
                    </a>
                @endauth
                @guest
                    <a href="{{ route("home") }}" class="text-lg font-semibold font-serif text-white">
                        @if($business->display === "Business Name")
                            <p class="px-4 py-2">{{ $business->name }}</p>
                        @else
                            @if($business->logo_path)
                                <img src="{{ asset('storage/'.$business->logo_path) }}" alt="Business Logo" class="w-11 h-11 mx-4 my-2 rounded-full border">
                            @else
                                <img src="{{ asset('storage/business/business_default_logo.png') }}" alt="Business Logo" class="w-11 h-11 mx-4 my-2 rounded-full border">
                            @endif
                        @endif
                    </a>
                @endguest

                <div class="p-2">
                    <button>
                        <svg @click="close()" x-show="isOpen()" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-8 text-red-600 hover:text-red-500">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
            <div class="flex flex-col">
                <a href="{{ route('home') }}" class="p-4 {{ request()->routeIs('home') ? 'bg-gray-200 text-yellow-900' : 'text-gray-900 hover:bg-gray-200 hover:text-yellow-900' }}">Home</a>
                @auth
                    @if(auth()->user()->role == "Admin")
                        <a href="{{ route('admin.user.dashboard') }}" class="p-4 {{ request()->routeIs('admin.user.dashboard') ? 'bg-gray-200 text-yellow-900' : 'text-gray-900 hover:bg-gray-200 hover:text-yellow-900' }}">Dashboard</a>
                    @elseif(auth()->user()->role == "Staff")
                        <a href="{{ route('staff.dashboard') }}" class="p-4 {{ request()->routeIs('staff.dashboard') ? 'bg-gray-200 text-yellow-900' : 'text-gray-900 hover:bg-gray-200 hover:text-yellow-900' }}">Dashboard</a>
                    @else
                        <a href="{{ route('customer.profile') }}" class="p-4 {{ request()->routeIs('customer.profile') ? 'bg-gray-200 text-yellow-900' : 'text-gray-900 hover:bg-gray-200 hover:text-yellow-900' }}">Profile</a>
                        <a href="{{ route('customer.orderDetails') }}" class="p-4 {{ request()->routeIs('customer.orderDetails') ? 'bg-gray-200 text-yellow-900' : 'text-gray-900 hover:bg-gray-200 hover:text-yellow-900' }}">Order Details</a>
                    @endif
                @endauth
                <a href="{{ route('contactUsView') }}" class="p-4 {{ request()->routeIs('contactUsView') ? 'bg-gray-200 text-yellow-900' : 'text-gray-900 hover:bg-gray-200 hover:text-yellow-900' }}">Contact Us</a>
                @guest
                    <a href="{{ route('login') }}" class="p-4 {{ request()->routeIs('login') ? 'bg-gray-200 text-yellow-900' : 'text-gray-900 hover:bg-gray-200 hover:text-yellow-900' }}">Login</a>
                    <a href="{{ route('register') }}" class="p-4 {{ request()->routeIs('register') ? 'bg-gray-200 text-yellow-900' : 'text-gray-900 hover:bg-gray-200 hover:text-yellow-900' }}">Register</a>
                @endguest
            </div>
        </div>
    </div>
</div>
</nav>
</div>
<div x-data="{ scrollToTop: true }">
<div x-show.transition="!scrollToTop" @scroll.window="scrollToTop = (window.pageYOffset > 50) ? false : true" class="fixed right-0 bottom-0 z-10">
    <button class="border-2 border-white bg-yellow-900 rounded p-2 m-4 text-white hover:bg-yellow-800" @click="$scroll(0)">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 11l7-7 7 7M5 19l7-7 7 7" />
          </svg>
    </button>
</div>
</div>
<script>

var showmenu = $("#showmenu");

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

/* $(document).ready(function(){
    $('#show').click(function(e){
        e.preventDefault();

        if($("#show").html() == "X"){
            $("#show").html("Block")
            $("#showbox").removeClass("block md:hidden lg:hidden").addClass("hidden md:hidden lg:hidden");
        }else{
            $("#show").html("X")
            $("#showbox").removeClass("hidden md:hidden lg:hidden").addClass("block md:hidden lg:hidden");
        }

        console.log("Clicked");
    });
}); */
</script>
