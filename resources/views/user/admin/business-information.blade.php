<x-main.app>
    @section('title', 'Business Information - '.$business->name)
    <x-user.admin.sidebar />
    <x-user.admin.content>
        <div class="py-2 md:p-4">
            <x-main.validation-message />
<div class="grid grid-cols-1 gap-2 md:grid-cols-3">
    <div class="col-span-1 p-4">
    <h4 class="text-lg font-semibold">Business Photo</h4>
    <p class="text-sm text-gray-600">This photo will be used as a business public photo.</p>
    </div>
    <div class="col-span-2 p-0 md:p-4">
    <form action="{{ route('admin.business.updateLogo') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="shadow rounded-none md:rounded bg-white">
            <div class="grid grid-cols-6">
                <div class="p-4 col-span-6 md:col-span-3">
                    <div class="flex flex-col items-center md:items-start space-y-4">
                        @if($business->logo_path)
                            <img src="{{ asset('storage/'.$business->logo_path) }}" id="profile_image" class="w-40 h-40 rounded-full mr-2" alt="Business Logo">
                        @else
                            <img src="{{ asset('storage/business/business_default_logo.png') }}" class="w-40 h-40 rounded-full mr-2" alt="Business Logo">
                        @endif
                        <input class="w-full rounded cursor-pointer px-4 py-2 border" type="file" name="business_logo" id="business_logo" required>
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
<div class=" border-b"></div>
<div class="grid grid-cols-1 gap-2 md:grid-cols-3">
    <div class="col-span-1 p-4">
    <h4 class="text-lg font-semibold">Business Information</h4>
    <p class="text-sm text-gray-600">Use a real business address where customers can walk in.</p>
    </div>
    <div class="col-span-2 p-0 md:p-4">
    <form id="profileInfoForm" action="{{ route('admin.business.updateInformation') }}" method="POST">
        @csrf
        @method("PUT")
        <div class="shadow rounded-none md:rounded bg-white">
            <div class="p-4">
                <div class="grid grid-cols-6 gap-6">
                    <div class="col-span-6 md:col-span-3">
                        <label class="block text-sm font-semibold text-gray-700" for="name">Business name</label>
                        <input class="mt-1 focus:ring-yellow-500 focus:border-yellow-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                            type="text"
                            name="name"
                            id="name"
                            value="{{ $business->name }}"
                            required>
                    </div>
                    <div class="col-span-6 md:col-span-3">
                        <label class="block text-sm font-semibold text-gray-700" for="display">Display</label>
                        <select class="mt-1 focus:ring-yellow-500 focus:border-yellow-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                name="display"
                                id="display"
                                required>
                                    <option value="Business Name" {{ ($business->display === "Business Name") ? 'selected' : "" }}>Business Name</option>
                                    <option value="Business Logo" {{ ($business->display === "Business Logo") ? 'selected' : "" }}>Business Logo</option>
                        </select>
                    </div>

                    <div class="col-span-6 md:col-span-3">
                        <label class="block text-sm font-semibold text-gray-700" for="contactNumber">Contact Number</label>
                        <input class="mt-1 focus:ring-yellow-500 focus:border-yellow-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                            type="number"
                            name="contactNumber"
                            id="contactNumber"
                            value="{{ $business->contactNumber }}"
                            required>
                    </div>
                    <div class="col-span-6 md:col-span-3">
                        <label class="block text-sm font-semibold text-gray-700" for="email">Email</label>
                        <input class="mt-1 focus:ring-yellow-500 focus:border-yellow-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                            type="email"
                            name="email"
                            id="email"
                            value="{{ $business->email }}"
                            required>
                    </div>
                    <div class="col-span-6 md:col-span-3">
                        <label class="block text-sm font-semibold text-gray-700" for="city">City</label>
                        <select class="mt-1 focus:ring-yellow-500 focus:border-yellow-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                name="city"
                                id="city"
                                required>
                                    @foreach ($cities as $data)
                                        <option value="{{ $data->city }}" {{ ($business->city == $data->city) ? "selected": "" }}>{{ $data->city }}</option>
                                    @endforeach
                        </select>
                    </div>
                    <div class="col-span-6">
                        <label class="block text-sm font-semibold text-gray-700" for="address">Address</label>
                        <input class="mt-1 focus:ring-yellow-500 focus:border-yellow-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                            type="text"
                            name="address"
                            id="address"
                            value="{{ $business->address }}"
                            required>
                    </div>
                    <div class="col-span-6">
                        <label class="block text-sm font-semibold text-gray-700" for="google_map_src">Google Map API src</label>
                        <textarea class="mt-1 focus:ring-yellow-500 focus:border-yellow-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                            name="google_map_src"
                            id="google_map_src"
                            required>{{ $business->google_map_src }}</textarea>
                    </div>
                </div>
            </div>
            <div class="px-4 py-2 bg-gray-50 rounded-b text-right">
                <button class="border rounded px-6 py-2 bg-yellow-900 hover:bg-yellow-800 text-white">
                    Save
                </button>
            </div>
        </div>
    </form>
    </div>
</div>
        </div>
    </x-user.admin.content>
<script>
$(document).ready(function(){
    $('#userList').DataTable();
});
</script>
</x-main.app>
