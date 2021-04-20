@if(session()->has('message'))
    <div class="fixed p-4 z-50" x-data="{ isOpen : true }">
        <div x-show.transition="isOpen" class="fixed top-0 right-0 m-4 bg-green-300 p-4 rounded flex shadow" {{ $attributes }}>
            <div class="flex items-center justify-items-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-10 text-green-600 bg-white bg-opacity-50 rounded-full mr-4">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <div class="mr-8">
                <div class="text-lg font-semibold text-green-600">
                    {{ __('Success') }}
                </div>
                <p class="text-sm text-green-600">{{ session('message') }}</p>
            </div>
            <a href="#" @click.prevent="isOpen = false" class="absolute top-0 right-0 p-4">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4 hover:text-green-600">
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </a>
        </div>
    </div>
@else
    @if ($errors->any())
    <div class="fixed p-4 z-50" x-data="{ isOpen : true }">
        <div x-show.transition="isOpen" class="fixed top-0 right-0 m-4 bg-red-300 p-4 rounded flex shadow" {{ $attributes }}>
            <div class="flex items-center justify-items-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-10 text-red-600 bg-white bg-opacity-50 rounded-full mr-4">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <div class="mr-8">
                <div class="text-lg font-semibold text-red-600">
                    {{ __('Whoops! Something went wrong.') }}
                </div>

                <ul class="mt-3 list-disc list-inside text-sm text-red-600">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            <a href="#" @click.prevent="isOpen = false" class="absolute top-0 right-0 p-4">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4 hover:text-red-600">
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </a>
        </div>
    </div>
    @endif
@endif
