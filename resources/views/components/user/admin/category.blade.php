<div class="py-2 md:p-4">
    <x-main.validation-message />
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="col-span-1 md:col-span-2 bg-white border rounded">
            <div class="px-4 py-2 bg-gray-50 rounded-t">
                <h3 class="text-sm font-semibold uppercase text-gray-600">Category List</h3>
            </div>
            <div class="shadow p-2 overflow-auto">
                <table id="" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">ID</th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Name</th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">DCreated</th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">DUpdated</th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($categories as $category)
                            <tr>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $category->id }}</td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $category->name }}</td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ date("F j, Y, g:i a", strtotime($category->updated_at)) }}</td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ date("F j, Y, g:i a", strtotime($category->updated_at)) }}</td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <div class="flex items-center space-x-2">
                                        <div x-data="dropdown()">
                                            <button @click.prevent="open()" class="p-1 bg-green-600 hover:bg-green-500 text-green-100 rounded">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                            </button>
                                            <div x-show.transition="isOpen()" class="fixed top-0 left-0 bg-black bg-opacity-80 w-screen h-screen z-10 flex items-center justify-center">
                                                <div class="shadow rounded bg-white -mt-96 w-auto" @click.away="close()">
                                                    <form action="{{ route(Str::lower(auth()->user()->role).'.product.editCategory', ['id' => $category->id]) }}" method="POST">
                                                        @csrf
                                                        @method("PUT")
                                                        <div class="p-4">
                                                            <label class="block text-sm font-semibold text-gray-700" for="name">Category Name</label>
                                                                    <input class="mt-1 focus:ring-yellow-500 focus:border-yellow-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                                                        type="text"
                                                                        name="name"
                                                                        id="name"
                                                                        value="{{ $category->name }}"
                                                                        required>
                                                        </div>
                                                        <div class="px-4 py-2 bg-gray-50 rounded-b text-right">
                                                            <button class="border rounded px-6 py-2 bg-yellow-900 hover:bg-yellow-800 text-white">
                                                                Add
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <form action="{{ route(Str::lower(auth()->user()->role).'.product.deleteCategory', ['id' => $category->id]) }}" method="POST">
                                            @csrf
                                            @method("DELETE")
                                            <button type="submit" class="p-1 bg-red-600 hover:bg-red-500 text-red-100 rounded" onclick="return confirm('are you sure you want to delete this category?')">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">No Category</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            </div>
        <div class="col-span-1">
            <form id="profileInfoForm" action="{{ route(Str::lower(auth()->user()->role).'.product.addCategory') }}" method="POST">
                @csrf
                <div class="shadow rounded bg-white">
                    <div class="p-4">
                        <label class="block text-sm font-semibold text-gray-700" for="name">Category Name</label>
                                <input class="mt-1 focus:ring-yellow-500 focus:border-yellow-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                    type="text"
                                    name="name"
                                    id="name"
                                    required>
                    </div>
                    <div class="px-4 py-2 bg-gray-50 rounded-b text-right">
                        <button class="border rounded px-6 py-2 bg-yellow-900 hover:bg-yellow-800 text-white">
                            Add
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#categoryList').DataTable({
            responsive: true
        });
    });
</script>
