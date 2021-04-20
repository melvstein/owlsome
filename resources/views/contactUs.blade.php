<x-main.app>
    @section('title', 'Contact Us - '.$business->name)
    <x-main.navbar :oncartCount="$oncartCount" />
    <div class="max-w-7xl mx-auto p-0 mt-4 md:mt-0 md:p-4">
        <x-main.validation-message />
        <div class="relative bg-white border shadow rounded-none md:rounded">
           <div class="bg-gray-50 rounded-none md:rounded-t border-b p-4">
                <h1 class="text-lg font-semibold text-yellow-900 uppercase">
                    Contact Us
                </h1>
           </div>
            <div class="grid grid-cols-1 gap-4 md:grid-cols-2 p-4">
                <div class="p-4">
                    <form action="{{ route('contactus.send') }}" method="POST">
                        @csrf
                        <div class="mb-2">
                            <input type="text" class="block rounded w-full" name="name" id="name" placeholder="Your Name" required>
                        </div>

                        <div class="mb-2">
                            <input type="email" class="block rounded w-full" name="email" id="email" placeholder="Your Email Address" required>
                        </div>

                        <div class="mb-2">
                            <input type="number" class="block rounded w-full" name="contactNumber" id="contactNumber" placeholder="Contact Number" required>
                        </div>

                        <div class="mb-2">
                            <input type="text" class="block rounded w-full" name="subject" id="subject" placeholder="Subject" required>
                        </div>

                        <div class="mb-2">
                            <textarea class="block rounded w-full h-40" name="message" id="message" placeholder="Message" required></textarea>
                        </div>

                        <button type="submit" class="border rounded bg-yellow-900 hover:bg-yellow-700 text-white px-4 py-2 w-full">
                            Submit
                        </button>
                    </form>
                </div>
                <div class="p-4">
                    <p class="text-lg font-semibold mb-2">Our Location</p>
                    <div class="rounded">
                        <iframe src="{{ $business->google_map_src }}" frameborder="0" class="w-full h-80" allowfullscreen="false" aria-hidden="false" tabindex="0"></iframe>
                        {{-- https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1932.8053295634606!2d121.05875040058002!3d14.334033744315663!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397d74056aaaaab%3A0x132a30e1ddc9e917!2sNewton%20Heights%20Subdivision!5e0!3m2!1sen!2sph!4v1612706539132!5m2!1sen!2sph --}}
                    </div>
                </div>
            </div>
        </div>
    <x-main.footer />
    </div>
</x-main.app>
