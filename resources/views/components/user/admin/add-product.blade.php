<div class="py-2 md:p-4 max-w-5xl">
    <x-main.validation-message />
    <form action="{{ route(Str::lower(auth()->user()->role).'.product.add') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="shadow rounded bg-white">
            <div class="px-4 py-2 bg-gray-50 rounded-t">
                <h3 class="text-sm font-semibold uppercase text-gray-600">Add New Product</h3>
            </div>
            <div class="p-4">
                <div class="grid grid-cols-6 gap-6">
                    <div class="col-span-6 md:col-span-2">
                        <label class="block text-sm font-semibold text-gray-700" for="name">Name</label>
                        <input class="mt-1 focus:ring-yellow-500 focus:border-yellow-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                            type="text"
                            name="name"
                            id="name"
                            required>
                    </div>
                    <div class="col-span-6 md:col-span-2">
                        <label class="block text-sm font-semibold text-gray-700" for="price">Price</label>
                        <input class="mt-1 focus:ring-yellow-500 focus:border-yellow-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                            type="number"
                            name="price"
                            id="price"
                            step=".01"
                            required>
                    </div>
                    <div class="col-span-6 md:col-span-2">
                        <label class="block text-sm font-semibold text-gray-700" for="units">Units</label>
                        <input class="mt-1 focus:ring-yellow-500 focus:border-yellow-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                            type="number"
                            name="units"
                            id="units"
                            required>
                    </div>
                    <div class="col-span-6 md:col-span-3">
                        <label class="block text-sm font-semibold text-gray-700" for="category">Category</label>
                        <select class="mt-1 focus:ring-yellow-500 focus:border-yellow-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                            name="category"
                            id="category"
                            required>
                            <option value=""></option>
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
                            required>
                    </div>
                    <div class="col-span-6">
                        <label class="block text-sm font-semibold text-gray-700" for="description">Description</label>
                        <input class="mt-1 focus:ring-yellow-500 focus:border-yellow-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                            type="text"
                            name="description"
                            id="description"
                            required>
                    </div>

                    <div class="col-span-6 md:col-span-3">
                        <label class="block text-sm font-semibold text-gray-700" for="product_image">Product Image</label>
                        <input class="mt-1 px-4 py-2 border focus:ring-yellow-500 focus:border-yellow-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                            type="file"
                            name="product_image"
                            id="product_image"
                            required>
                    </div>
                </div>
            </div>
            <div class="px-4 py-2 bg-gray-50 rounded-b text-right">
                <button type="submit" class="border rounded px-6 py-2 bg-yellow-900 hover:bg-yellow-800 text-white">
                    Add
                </button>
            </div>
        </div>
    </form>
</div>
