<div class="py-2 md:p-4">
    <x-main.validation-message />
    <div class="grid grid-cols-1 gap-4 md:grid-cols-4">
        <div class="col-span-2">
            <form action="{{ route(Str::lower(auth()->user()->role).'.product.updateProduct', ['id' => $product->id]) }}" method="POST">
                @csrf
                @method("PUT")
                <div class="shadow rounded bg-white">
                    <div class="px-4 py-2 bg-gray-50 rounded-t">
                        <h3 class="text-sm font-semibold uppercase text-gray-600">Edit ({{ $product->name }})</h3>
                    </div>
                    <div class="p-4">
                        <div class="grid grid-cols-6 gap-6">
                            <div class="col-span-6 md:col-span-2">
                                <label class="block text-sm font-semibold text-gray-700" for="name">Name</label>
                                <input class="mt-1 focus:ring-yellow-500 focus:border-yellow-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                    type="text"
                                    name="name"
                                    id="name"
                                    value="{{ $product->name }}"
                                    required>
                            </div>
                            <div class="col-span-6 md:col-span-2">
                                <label class="block text-sm font-semibold text-gray-700" for="price">Price</label>
                                <input class="mt-1 focus:ring-yellow-500 focus:border-yellow-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                    type="number"
                                    name="price"
                                    id="price"
                                    value="{{ $product->price }}"
                                    step=".01"
                                    required>
                            </div>
                            <div class="col-span-6 md:col-span-2">
                                <label class="block text-sm font-semibold text-gray-700" for="units">Units</label>
                                <input class="mt-1 focus:ring-yellow-500 focus:border-yellow-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                    type="number"
                                    name="units"
                                    id="units"
                                    value="{{ $product->units }}"
                                    required>
                            </div>
                            <div class="col-span-6 md:col-span-3">
                                <label class="block text-sm font-semibold text-gray-700" for="category">Category</label>
                                <select class="mt-1 focus:ring-yellow-500 focus:border-yellow-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                    name="category"
                                    id="category"
                                    required>
                                    <option class="bg-gray-300 text-green-600" value="{{ $product->category }}">{{ $product->category }}</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->name }}">{{ $category->name }}</option>
                                @endforeach
                                </select>
                            </div>
                            <div class="col-span-6 md:col-span-3">
                                <label class="block text-sm font-semibold text-gray-700" for="details">Details</label>
                                <input class="mt-1 focus:ring-yellow-500 focus:border-yellow-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                    type="text"
                                    name="details"
                                    id="details"
                                    value="{{ $product->details }}"
                                    required>
                            </div>
                            <div class="col-span-6">
                                <label class="block text-sm font-semibold text-gray-700" for="description">Description</label>
                                <input class="mt-1 focus:ring-yellow-500 focus:border-yellow-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                    type="text"
                                    name="description"
                                    id="description"
                                    value="{{ $product->description }}"
                                    required>
                            </div>
                        </div>
                    </div>
                    <div class="px-4 py-2 bg-gray-50 rounded-b text-right">
                        <button type="submit" class="border rounded px-6 py-2 bg-yellow-900 hover:bg-yellow-800 text-white">
                            Save
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-span-2">
            <form action="{{ route(Str::lower(auth()->user()->role).'.product.updateImage', ['id' => $product->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method("PUT")
                <div class="shadow rounded bg-white">
                    <div class="p-4">
                        <div class="grid grid-cols-6">
                            <div class="p-4 col-span-6 md:col-span-3">
                                <div class="flex flex-col items-center md:items-start space-y-4">
                                    @if($product->image_path)
                                        <img src="{{ asset('storage/'.$product->image_path) }}" id="product_image" class="w-40 h-40 rounded-full mr-2" alt="Product Image">
                                    @else
                                    <img src="{{ asset('storage/products/product_default_photo.png') }}" class="w-40 h-40 rounded-full mr-2" alt="Product Image">
                                    @endif
                                    <input class="w-full rounded cursor-pointer px-4 py-2 border" type="file" name="product_image" id="product_image" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="px-4 py-2 bg-gray-50 rounded-b text-right">
                        <button type="submit" class="border rounded px-6 py-2 bg-yellow-900 hover:bg-yellow-800 text-white">
                            Save
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
