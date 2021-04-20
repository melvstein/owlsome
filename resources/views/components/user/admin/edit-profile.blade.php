<div class="grid grid-cols-1 gap-2 md:grid-cols-3">
    <div class="col-span-1 p-4">
    <h4 class="text-lg font-semibold">Display Photo</h4>
    <p class="text-sm text-gray-600">This photo will be displayed publicly so be careful what you choose.</p>
    </div>
    <div class="col-span-2 p-0 md:p-4">
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="shadow rounded bg-white">
            <div class="grid grid-cols-6">
                <div class="p-4 col-span-6 md:col-span-3">
                    <div class="flex flex-col items-center md:items-start space-y-4">
                        <img src="" class="w-40 h-40" alt="">
                        <input class="w-full rounded cursor-pointer px-4 py-2 border" type="file" name="" id="" required>
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
<div class=" border-b"></div>
<div class="grid grid-cols-1 gap-2 md:grid-cols-3">
    <div class="col-span-1 p-4">
    <h4 class="text-lg font-semibold">Personal Information</h4>
    <p class="text-sm text-gray-600">Use a permanent address where you can receive your orders.</p>
    </div>
    <div class="col-span-2 p-0 md:p-4">
    <form action="" method="POST">
        <div class="shadow rounded bg-white">
            <div class="p-4">
                <div class="grid grid-cols-6 gap-6">
                    <div class="col-span-6 md:col-span-2">
                        <label class="block text-sm font-semibold text-gray-700" for="firstName">First name</label>
                        <input class="mt-1 focus:ring-yellow-500 focus:border-yellow-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                            type="text"
                            name="firstName"
                            id="firstName"
                            value="{{ auth()->user()->firstName }}"
                            required>
                    </div>
                    <div class="col-span-6 md:col-span-2">
                        <label class="block text-sm font-semibold text-gray-700" for="middleName">Middle name</label>
                        <input class="mt-1 focus:ring-yellow-500 focus:border-yellow-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                            type="text"
                            name="middleName"
                            id="middleName"
                            value="{{ auth()->user()->middleName }}"
                            required>
                    </div>
                    <div class="col-span-6 md:col-span-2">
                        <label class="block text-sm font-semibold text-gray-700" for="lastName">Last name</label>
                        <input class="mt-1 focus:ring-yellow-500 focus:border-yellow-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                            type="text"
                            name="lastName"
                            id="lastName"
                            value="{{ auth()->user()->lastName }}"
                            required>
                    </div>
                    <div class="col-span-6 md:col-span-3">
                        <label class="block text-sm font-semibold text-gray-700" for="contactNumber">Contact Number</label>
                        <input class="mt-1 focus:ring-yellow-500 focus:border-yellow-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                            type="number"
                            name="contactNumber"
                            id="contactNumber"
                            value="{{ auth()->user()->contactNumber }}"
                            required>
                    </div>
                    <div class="col-span-6 md:col-span-3">
                        <label class="block text-sm font-semibold text-gray-700" for="email">Email</label>
                        <input class="mt-1 focus:ring-yellow-500 focus:border-yellow-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                            type="email"
                            name="email"
                            id="email"
                            value="{{ auth()->user()->email }}"
                            required>
                    </div>
                    <div class="col-span-6 md:col-span-4">
                        <label class="block text-sm font-semibold text-gray-700" for="city">City</label>
                        <input class="mt-1 focus:ring-yellow-500 focus:border-yellow-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                            type="text"
                            name="city"
                            id="city"
                            value="{{ auth()->user()->city }}"
                            required>
                    </div>
                    <div class="col-span-6">
                        <label class="block text-sm font-semibold text-gray-700" for="address">Address</label>
                        <input class="mt-1 focus:ring-yellow-500 focus:border-yellow-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                            type="text"
                            name="address"
                            id="address"
                            value="{{ auth()->user()->address }}"
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
</div>
<div class=" border-b"></div>
<div class="grid grid-cols-1 gap-2 md:grid-cols-3">
    <div class="col-span-1 p-4">
    <h4 class="text-lg font-semibold">Password</h4>
    <p class="text-sm text-gray-600">Don't forget your password.</p>
    </div>
    <div class="col-span-2 p-0 md:p-4">
    <form action="" method="POST">
        <div class="shadow rounded bg-white">
            <div class="p-4">
                <div class="grid grid-cols-6 gap-6">
                    <div class="col-span-6 md:col-span-2">
                        <label class="block text-sm font-semibold text-gray-700" for="password">Current Password</label>
                        <input class="mt-1 focus:ring-yellow-500 focus:border-yellow-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" type="password" name="password" id="password" required>
                    </div>
                    <div class="col-span-6 md:col-span-2">
                        <label class="block text-sm font-semibold text-gray-700" for="confirmPassword">Confirm Password</label>
                        <input class="mt-1 focus:ring-yellow-500 focus:border-yellow-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" type="password" name="confirmPassword" id="confirmPassword" required>
                    </div>
                    <div class="col-span-6 md:col-span-2">
                        <label class="block text-sm font-semibold text-gray-700" for="newPassword">New Password</label>
                        <input class="mt-1 focus:ring-yellow-500 focus:border-yellow-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" type="password" name="newPassword" id="newPassword" required>
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
