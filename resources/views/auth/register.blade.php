<x-main.app>
    @section('title', 'Register')
    <x-guest-layout>
        <x-main.navbar />
        <x-auth-card>
            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- First Name -->
                <div>
                    <x-label for="firstName" :value="__('First Name')" />

                    <x-input id="firstName" class="block mt-1 w-full" type="text" name="firstName" :value="old('firstName')" required autofocus />
                </div>

                <!-- Middle Name -->
                <div class="mt-4">
                    <x-label for="middleName" :value="__('Middle Name')" />

                    <x-input id="middleName" class="block mt-1 w-full" type="text" name="middleName" :value="old('middleName')" required />
                </div>

                <!-- First Name -->
                <div class="mt-4">
                    <x-label for="lastName" :value="__('Last Name')" />

                    <x-input id="lastName" class="block mt-1 w-full" type="text" name="lastName" :value="old('lastName')" required />
                </div>

                <!-- Contact Number -->
                <div class="mt-4">
                    <x-label for="contactNumber" :value="__('Contact Number')" />

                    <x-input id="contactNumber" class="block mt-1 w-full" type="number" name="contactNumber" :value="old('contactNumber')" required />
                </div>

                <!-- Email Address -->
                <div class="mt-4">
                    <x-label for="email" :value="__('Email')" />

                    <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
                </div>

                <!-- City -->
                <div class="mt-4">
                    <x-label for="city" :value="__('City')" />

                    <x-select id="city" class="block mt-1 w-full" name="city" required>
                        @foreach ($cities as $data)
                            <option value="{{ $data->city }}">{{ $data->city }}</option>
                        @endforeach
                    </x-select>
                </div>

                <!-- Address -->
                <div class="mt-4">
                    <x-label for="address" :value="__('Address')" />

                    <x-text-area id="address" class="block mt-1 w-full" name="address" required>{{ old('address') }}</x-text-area>
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-label for="password" :value="__('Password')" />

                    <x-input id="password" class="block mt-1 w-full"
                                    type="password"
                                    name="password"
                                    required autocomplete="new-password" />
                </div>

                <!-- Confirm Password -->
                <div class="mt-4">
                    <x-label for="password_confirmation" :value="__('Confirm Password')" />

                    <x-input id="password_confirmation" class="block mt-1 w-full"
                                    type="password"
                                    name="password_confirmation" required />
                </div>

                <div class="flex items-center justify-end mt-4">
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                        {{ __('Already registered?') }}
                    </a>

                    <x-button class="ml-4">
                        {{ __('Register') }}
                    </x-button>
                </div>
            </form>
        </x-auth-card>
    </x-guest-layout>
</x-main.app>
