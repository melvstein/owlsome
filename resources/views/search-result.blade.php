<x-main.app>
    @section('title', 'Search Result - '.$business->name)
    <x-main.navbar :oncartCount="$oncartCount" />
    <x-main.validation-message />
    <div class="flex-1 max-w-7xl mx-auto py-4 md:p-4">
        <div class="bg-white rounded shadow">
            <div class="rounded-t bg-gray-50 p-4">
                <h1 class="text-sm uppercase text-gray-900 font-bold mr-2 flex items-center gap-2">
                    Search Results
                </h1>
            </div>
            <div class="px-4 pt-4">
                <form action="{{ route('searchResult') }}" method="GET" class="flex items-center gap-2">
                    <input type="text" class="blck rounded w-full" name="query" id="query" placeholder="Search Product" required>
                    <button type="submit" class="bg-yellow-900 px-4 py-2 rounded hover:bg-yellow-800 text-white">
                        Search
                    </button>
                </form>
            </div>
            <div class="px-4 pt-4">
                <p class="text-green-500">{{ $products->count() }} result(s) for <span class="font-semibold">"{{ $query }}"</span>!</p>
            </div>
            <div class="grid grid-cols-1 gap-4 md:grid-cols-4 p-4">
                @foreach ($products as $product)
                    <form action="{{ route('customer.addToCart') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <div class="flex flex-col bg-white shadow rounded border">
                            <div class="bg-gray-50 px-4 py-2 rounded-t">
                                <h3 class="text-yellow-900 font-semibold">
                                    {{ $product->name }} <span class="text-xs text-gray-400 uppercase">{{ $product->category }}</span>
                                </h3>
                            </div>
                            <a href="{{ route('customer.buyNow', ['id' => $product->id]) }}" class="mb-2 hover:shadow-lg rounded m-4">
                                <img src="{{ asset('storage/'. $product->image_path) }}" class="bg-white w-auto h-auto mb-2 rounded" alt="Product Image">
                            </a>
                            <div class="mb-2 border-b px-4 py-2">
                                <p class="text-xs uppercase font-semibold leading-loose">Details</p>
                                <div
                                    x-data="{ count: 5, string: '{{ $product->details }}'}"
                                    x-text="$truncate(string, { words: count, ellipsis: ' ...read more' })"
                                    @click="count = 0"
                                    class="cursor-pointer text-gray-600 text-sm">
                                </div>
                            </div>
                            <div class="mb-2 border-b px-4 py-2">
                                <p class="text-xs uppercase font-semibold leading-loose">Description</p>
                                <div
                                    x-data="{ count: 5, string: '{{ $product->description }}'}"
                                    x-text="$truncate(string, { words: count, ellipsis: ' ...read more' })"
                                    @click="count = 0"
                                    class="cursor-pointer text-gray-600 text-sm">
                                </div>
                            </div>
                            <div class="flex items-center justify-between mb-2 border-b px-4 py-2">
                                <p class="text-xs uppercase font-semibold leading-loose {{ ($product->units >= 1) ? 'text-green-600' : 'text-red-600' }}">{{ ($product->units >= 1) ? 'In Stock' : 'Out of Stock' }} ({{ $product->units }})</p>
                                <input type="number" class="block rounded" name="quantity" id="quantity{{ $product->id }}" min="1" max="{{ $product->units }}" value="1" maxlength="3" required>
                            </div>
                            <div class="flex items-center justify-between mb-2 border-b px-4 py-2">
                                <p class="text-xs uppercase font-semibold leading-loose">Price</p>
                                <p><i class="fa fa-ruble"></i> {{ number_format($product->price, 2) }}</p>
                            </div>
                            <div class="flex flex-col lg:flex-row items-center justify-between space-y-2 lg:space-y-0 space-x-0 lg:space-x-2 bg-gray-50 rounded-b px-4 py-2">
                                @if($product->units >= 1)
                                    <a href="" onclick="this.href='{{ route('customer.buyNow', ['id' => $product->id]) }}?quantity='+document.getElementById('quantity{{ $product->id }}').value"
                                        class="bg-yellow-900 hover:bg-yellow-800 text-white px-4 py-2 rounded flex-shrink-0 w-full lg:w-auto text-center">
                                        Buy Now
                                    </a>
                                    <button class="border border-yellow-900 hover:bg-gray-100 text-yellow-900 px-4 py-2 rounded flex-shrink-0 w-full lg:w-auto"
                                    name="action"
                                    value="addToCart"
                                    id="addToCart{{ $product->id }}">
                                        Add to Cart
                                    </button>
                                @else
                                    <a href="#" onclick="alert('Sorry, This item is out of stock for now. :('); event.preventDefault()"
                                        class="bg-yellow-900 hover:bg-yellow-800 text-white px-4 py-2 rounded cursor-not-allowed flex-shrink-0 w-full lg:w-auto text-center">
                                        Buy Now
                                    </a>
                                    <button onclick="alert('This item is out of stock'); event.preventDefault()" class="border border-yellow-900 hover:bg-gray-100 text-yellow-900 px-4 py-2 rounded cursor-not-allowed flex-shrink-0 w-full md:w-auto"
                                    name="action"
                                    value="addToCart"
                                    id="addToCart{{ $product->id }}"
                                    disabled>
                                        Add to Cart
                                    </button>
                                @endif
                            </div>
                        </div>
                    </form>
                @endforeach
            </div>
        </div>
            <x-main.footer />
    </div>

</x-main.app>
