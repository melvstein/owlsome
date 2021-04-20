<footer class="bg-yellow-900">
    <div class="relative mt-4">
        <div class="grid grid-cols-1 gap-2 sm:grid-cols-1 md:grid-cols-2">
            <div class="flex flex-col p-4">
                <div class="mb-2">
                <h1 class="text-white font-semibold text-lg">
                    Stay Connected
                </h1>
                <form action="" class="flex flex-col md:flex-row space-x-0 md:space-x-2">
                    <input type="email" class="block rounded-t md:rounded w-full" name="" id="" placeholder="Email Address" required>
                    <button class="p-2 bg-yellow-500 rounded-b md:rounded">
                        Submit
                    </button>
                </form>
                </div>
                <div class="mb-2">
                    <h1 class="text-white font-semibold text-lg">
                        Email Address
                    </h1>
                    <p class="text-white">{{ $business->email }}</p>
                </div>
                <div class="mb-2">
                    <h1 class="text-white font-semibold text-lg">
                        Contact Number
                    </h1>
                    <p class="text-white">{{ $business->contactNumber }}</p>
                </div>
            </div>
            <div class="flex flex-col">
                <div class="p-4">
                    <p class="text-white"><strong>Address</strong></p>
                    <p class="text-white mb-2">
                        {{ $business->address }}
                        {{-- Blk 13 Lot 26 Ivory St. Newton Heights Subdivision Brgy. San Francisco Halang, Biñan Laguna --}}
                    </p>
                </div>
                <div class="rounded-none md:rounded p-0 md:p-4">
                    <iframe src="{{ $business->google_map_src }}" frameborder="0" class="w-full h-40" allowfullscreen="false" aria-hidden="false" tabindex="0"></iframe>
                </div>
            </div>
        </div>
        <div class="border-t">
            <p class="text-white p-4 text-center">
                <a href="https://www.facebook.com/melvinbayogo/" target="__blank">© 2021</a> <a href="https://www.facebook.com/OwlsomeSweetsandCoffee2020/" target="__blank" class="text-yellow-500 hover:text-yellow-400">{{ $business->name }} E-commerce Republic</a>
            </p>
        </div>
    </div>
</footer>
