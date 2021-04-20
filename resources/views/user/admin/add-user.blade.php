<x-main.app>
    @section('title', 'Add User - '.$business->name)
    <x-user.admin.sidebar />
    <x-user.admin.content>
        <div class="py-2 md:p-4 max-w-5xl">
            <x-main.validation-message />
            <form id="profileInfoForm" action="{{ route('admin.user.addNew') }}" method="POST">
                @csrf
                <div class="shadow rounded bg-white">
                    <div class="px-4 py-2 bg-gray-50 rounded-t">
                        <h3 class="text-sm font-semibold uppercase text-gray-600">Add new user</h3>
                    </div>
                    <div class="p-4">
                        <div class="grid grid-cols-6 gap-6">
                            <div class="col-span-6 md:col-span-2">
                                <label class="block text-sm font-semibold text-gray-700" for="firstName">First name</label>
                                <input class="mt-1 focus:ring-yellow-500 focus:border-yellow-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                    type="text"
                                    name="firstName"
                                    id="firstName"
                                    required>
                            </div>
                            <div class="col-span-6 md:col-span-2">
                                <label class="block text-sm font-semibold text-gray-700" for="middleName">Middle name</label>
                                <input class="mt-1 focus:ring-yellow-500 focus:border-yellow-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                    type="text"
                                    name="middleName"
                                    id="middleName"
                                    required>
                            </div>
                            <div class="col-span-6 md:col-span-2">
                                <label class="block text-sm font-semibold text-gray-700" for="lastName">Last name</label>
                                <input class="mt-1 focus:ring-yellow-500 focus:border-yellow-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                    type="text"
                                    name="lastName"
                                    id="lastName"
                                    required>
                            </div>
                            <div class="col-span-6 md:col-span-3">
                                <label class="block text-sm font-semibold text-gray-700" for="contactNumber">Contact Number</label>
                                <input class="mt-1 focus:ring-yellow-500 focus:border-yellow-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                    type="number"
                                    name="contactNumber"
                                    id="contactNumber"
                                    required>
                            </div>
                            <div class="col-span-6 md:col-span-3">
                                <label class="block text-sm font-semibold text-gray-700" for="email">Email</label>
                                <input class="mt-1 focus:ring-yellow-500 focus:border-yellow-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                    type="email"
                                    name="email"
                                    id="email"
                                    required>
                            </div>
                            <div class="col-span-6 md:col-span-3">
                                <label class="block text-sm font-semibold text-gray-700" for="role">Role</label>
                                <select class="mt-1 focus:ring-yellow-500 focus:border-yellow-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                    name="role"
                                    id="role"
                                    required>
                                <option value=""></option>
                                <option value="Admin">Admin</option>
                                <option value="Staff">Staff</option>
                                </select>
                            </div>
                            <div class="col-span-6 md:col-span-3">
                                <label class="block text-sm font-semibold text-gray-700" for="city">City</label>
                                <select class="mt-1 focus:ring-yellow-500 focus:border-yellow-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                        name="city"
                                        id="city"
                                        required>
                                    <option value=""></option>
                                @foreach ($cities as $data)
                                    <option value="{{ $data->city }}">{{ $data->city }}</option>
                                @endforeach
                                </select>
                            </div>
                            <div class="col-span-6">
                                <label class="block text-sm font-semibold text-gray-700" for="address">Address</label>
                                <input class="mt-1 focus:ring-yellow-500 focus:border-yellow-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                    type="text"
                                    name="address"
                                    id="address"
                                    required>
                            </div>
                            <div class="col-span-6 md:col-span-3">
                                <label class="block text-sm font-semibold text-gray-700" for="password">Password</label>
                                <input class="mt-1 focus:ring-yellow-500 focus:border-yellow-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                    type="password"
                                    name="password"
                                    id="password"
                                    required>
                            </div>
                            <div class="col-span-6 md:col-span-3">
                                <label class="block text-sm font-semibold text-gray-700" for="password_confirmation">Confirm Password</label>
                                <input class="mt-1 focus:ring-yellow-500 focus:border-yellow-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                    type="password"
                                    name="password_confirmation"
                                    id="password_confirmation"
                                    required>
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
    </x-user.admin.content>
<script>
    $(document).ready(function(){
        let productImage = $("#productImage");
        let productFileName = $("#productFileName");
        productImage.change(function(e){
            var fileName = e.target.files[0].name;
            productFileName.html("<i class='fas fa-camera'></i> "+fileName);
        });
    });
</script>
</x-main.app>
