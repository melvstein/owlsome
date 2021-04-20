<x-main.app>
    @section('title', 'Login')
    <x-guest-layout>
        <x-main.navbar />
        <div class="mt-0 md:my-20">
            <x-auth-card>
                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <!-- Validation Errors -->
                <x-auth-validation-errors class="mb-4" :errors="$errors" />

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email Address -->
                    <div>
                        <x-label for="email" :value="__('Email')" />

                        <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
                    </div>

                    <!-- Password -->
                    <div class="mt-4">
                        <x-label for="password" :value="__('Password')" />

                        <x-input id="password" class="block mt-1 w-full"
                                        type="password"
                                        name="password"
                                        required autocomplete="current-password" />
                    </div>

                    <!-- Remember Me -->
                    <div class="block mt-4">
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" name="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                            <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                        </label>
                    </div>

                    <div class="flex flex-col items-center justify-center space-y-4 mt-4">
                        <x-button class="bg-yellow-900 hover:bg-yellow-800 flex items-center justify-center w-full">
                            {{ __('Login') }}
                        </x-button>
                        @if (Route::has('password.request'))
                            <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                                {{ __('Forgot your password?') }}
                            </a>
                        @endif
                    </div>
                </form>

                <div class="absolute border-t-2 inset-x-0 mt-4"></div>

                    <div class="flex mt-6 mb-2">
                        <legend class="font-semibold text-gray-400">Login as</legend>
                    </div>
                    <div class="flex flex-col md:flex-row items-center justify-between">
                        <a href="{{ route('login.facebook') }}" class="border rounded-lg px-6 py-2 bg-blue-500 hover:bg-blue-400 text-white flex-shrink-0 w-full md:w-auto">
                            <i class="fa fa-facebook" aria-hidden="true"></i> Facebook
                        </a>
                        <p class="text-gray-600 font-semibold">or</p>
                        <a href="{{ route('login.google') }}" class="border rounded-lg px-6 py-2 bg-red-500 hover:bg-red-400 text-white flex-shrink-0 w-full md:w-auto">
                            <i class="fa fa-google" aria-hidden="true"></i> Gmail
                        </a>
                    </div>
            </x-auth-card>
        </div>
    </x-guest-layout>
    <div class="relative md:fixed bottom-0 left-0 w-full">
        <x-main.footer/>
    </div>
</x-main.app>
