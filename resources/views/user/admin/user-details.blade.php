<x-main.app>
    @section('title', 'User Details - '.$business->name)
    <x-user.admin.sidebar />
<x-user.admin.content>
{{-- <x-main.validation-message /> --}}
<div id="cartMessageBox" class="hidden fixed p-4 z-50">
    <div class="fixed top-0 right-0 m-4 bg-green-300 p-4 rounded flex shadow">
        <div class="flex items-center justify-items-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-10 text-green-600 bg-white bg-opacity-50 rounded-full mr-4">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        </div>
        <div class="mr-8">
            <div class="text-lg font-semibold text-green-600">
                {{ __('Success') }}
            </div>
            <p class="text-sm text-green-600" id="cartMessageContent"></p>
        </div>
        <a href="#" id="closeMessageBox" class="absolute top-0 right-0 p-4">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4 hover:text-green-600">
                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
            </svg>
        </a>
    </div>
</div>
<div class="py-2 md:p-4">
    <div class="shadow rounded bg-white">
        <div class="bg-gray-50 border-b rounded-t px-4 py-2">
            <p class="text-yellow-900 text-sm font-semibold uppercase">
                @if(empty($user->firstName) && empty($user->lastName))
                    {{ $user->role .": ". $user->name }}
                @else
                    {{ $user->role .": ". $user->firstName ." ". $user->lastName }}
                @endif
                (Details)</p>
        </div>
        <div class="grid grid-cols-1 gap-2 md:grid-cols-3">
            <div class="col-span-1 p-4">
            <h4 class="text-lg font-semibold">Display Photo</h4>
            <p class="text-sm text-gray-600">This photo will be displayed publicly so be careful what you choose.</p>
            </div>
            <div class="col-span-2 p-0 md:p-4">
            <form action="{{ route('user.editProfilePhoto') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="shadow rounded-none md:rounded bg-white">
                    <div class="grid grid-cols-6">
                        <div class="p-4 col-span-6 md:col-span-3">
                            <div class="flex flex-col items-center md:items-start space-y-4">
                                @if($user->profile_photo_path)
                                    <img src="{{ asset('storage/'.$user->profile_photo_path) }}" id="profile_image" class="w-40 h-40 rounded-full mr-2" alt="User Profile">
                                @else
                                    <img src="{{ asset('storage/user/user_default_photo.png') }}" class="w-40 h-40 rounded-full mr-2" alt="User Profile">
                                @endif
                            </div>
                        </div>
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
                <div class="shadow rounded-none md:rounded bg-white">
                    <div class="p-4">
                        <p class="text-sm mb-4"><span class="text-gray-600">Account Id: </span><span class="text-blue-500">{{ $user->accountId }}</span></p>
                        <div class="grid grid-cols-6 gap-6">
                            <div class="col-span-6 md:col-span-2">
                                <label class="block text-sm font-semibold text-gray-700" for="firstName">First name</label>
                                <input class="mt-1 focus:ring-yellow-500 focus:border-yellow-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                    type="text"
                                    name="firstName"
                                    id="firstName"
                                    value="{{ $user->firstName }}"
                                    required disabled>
                            </div>
                            <div class="col-span-6 md:col-span-2">
                                <label class="block text-sm font-semibold text-gray-700" for="middleName">Middle name</label>
                                <input class="mt-1 focus:ring-yellow-500 focus:border-yellow-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                    type="text"
                                    name="middleName"
                                    id="middleName"
                                    value="{{ $user->middleName }}"
                                    required disabled>
                            </div>
                            <div class="col-span-6 md:col-span-2">
                                <label class="block text-sm font-semibold text-gray-700" for="lastName">Last name</label>
                                <input class="mt-1 focus:ring-yellow-500 focus:border-yellow-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                    type="text"
                                    name="lastName"
                                    id="lastName"
                                    value="{{ $user->lastName }}"
                                    required disabled>
                            </div>
                            <div class="col-span-6 md:col-span-3">
                                <label class="block text-sm font-semibold text-gray-700" for="contactNumber">Contact Number</label>
                                <input class="mt-1 focus:ring-yellow-500 focus:border-yellow-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                    type="number"
                                    name="contactNumber"
                                    id="contactNumber"
                                    value="{{ $user->contactNumber }}"
                                    required disabled>
                            </div>
                            <div class="col-span-6 md:col-span-3">
                                <label class="block text-sm font-semibold text-gray-700" for="email">Email</label>
                                <input class="mt-1 focus:ring-yellow-500 focus:border-yellow-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                    type="email"
                                    name="email"
                                    id="email"
                                    value="{{ $user->email }}"
                                    required disabled>
                            </div>
                            <div class="col-span-6 md:col-span-4">
                                <label class="block text-sm font-semibold text-gray-700" for="city">City</label>
                                <select class="mt-1 focus:ring-yellow-500 focus:border-yellow-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                        name="city"
                                        id="city"
                                        required disabled>
                                            @foreach ($cities as $data)
                                                <option value="{{ $data->city }}" {{ ($user->city == $data->city) ? "selected": "" }}>{{ $data->city }}</option>
                                            @endforeach
                                </select>
                            </div>
                            <div class="col-span-6">
                                <label class="block text-sm font-semibold text-gray-700" for="address">Address</label>
                                <input class="mt-1 focus:ring-yellow-500 focus:border-yellow-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                    type="text"
                                    name="address"
                                    id="address"
                                    value="{{ $user->address }}"
                                    required disabled>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if($user->role === "Customer")
    <div class="bg-white rounded shadow mt-4">
        <div class="bg-gray-50 border-b rounded-t px-4 py-2">
            <p class="text-yellow-900 text-sm font-semibold uppercase">Orders</p>
        </div>
        <div class="shadow p-2 overflow-auto">
            <table id="orderDetails" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Created</th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Order Id</th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">No. of Items</th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Status</th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Note</th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Received Date</th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orderDetails as $orderDetail)
                        <tr id="cancelOrder{{ $orderDetail->order_id }}">
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ date("F j, Y, g:i a", strtotime($orderDetail->created_at)) }}</td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                <a href="{{ route(Str::lower(auth()->user()->role).'.order.customerOrderView', $orderDetail->order_id) }}" class="text-blue-600 hover:text-blue-400">
                                    {{ $orderDetail->order_id }}
                                </a>
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $orderDetail->numberofItems }}</td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                @if($orderDetail->isCheckout)
                                    <p class="bg-yellow-600 text-yellow-100 font-bold text-xs uppercase rounded-full text-center">
                                        Pending
                                    </p>
                                @elseif($orderDetail->isShipped)
                                    <p class="bg-blue-600 text-blue-100 font-bold text-xs uppercase rounded-full text-center">
                                        To Ship
                                    </p>
                                @elseif($orderDetail->isDelivered)
                                    <p class="bg-green-600 text-green-100 font-bold text-xs uppercase rounded-full text-center">
                                        Received
                                    </p>
                                @endif
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                @if($orderDetail->isCheckout)
                                    <p class="text-gray-700 text-sm">
                                        Wait 2 to 3 days, we will contact you.
                                        <br>
                                        <span class="text-red-600"><span class="font-semibold">Warning</span>: If you are a Bogus buyer, you will be posted in our facebook page.</span>
                                    </p>
                                @elseif($orderDetail->isShipped)

                                @elseif($orderDetail->isDelivered)

                                @endif
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                @if($orderDetail->isDelivered)
                                    <p>{{ date("F j, Y, g:i a", strtotime($orderDetail->updated_at)) }}</p>
                                @endif
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                @if($orderDetail->isCheckout)
                                    <button class="border border-red-600 text-red-600 hover:bg-red-600 hover:text-white focus:outline-none focus:ring-2 focus:ring-red-400 rounded-full px-4 uppercase text-xs" name="cancelCheckout" id="cancelCheckout{{ $orderDetail->order_id }}" value="{{ $orderDetail->order_id }}">
                                        Cancel
                                    </button>
                                @elseif($orderDetail->isShipped)
                                    <button class="bg-gray-500 bg-opacity-50 text-gray-600 rounded-full px-4 uppercase text-xs cursor-not-allowed"
                                        name="cancelCheckout"
                                        id="cancelCheckout{{ $orderDetail->order_id }}"
                                        value="{{ $orderDetail->order_id }}"
                                        disabled>
                                        Cancel
                                    </button>
                                @elseif($orderDetail->isDelivered)
                                    <button class="bg-gray-500 bg-opacity-50 text-gray-600 rounded-full px-4 uppercase text-xs cursor-not-allowed"
                                        name="cancelCheckout"
                                        id="cancelCheckout{{ $orderDetail->order_id }}"
                                        value="{{ $orderDetail->order_id }}"
                                        disabled>
                                        Cancel
                                    </button>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif
</div>
</x-user.admin.content>
<script>
    $(document).ready(function(){

        let _token = $('input[name=_token]').val();
        let cancelCheckout = $('button[name=cancelCheckout]');

        $('#orderDetails').DataTable();

        $('#closeMessageBox').on('click' ,function(e){
            e.preventDefault();
            $('#cartMessageBox').removeClass('block').addClass('hidden');
        });

        //Cancel checkout it must be deleted.
        cancelCheckout.click(function(e){
            e.preventDefault();

            let order_id = this.value;
            if(confirm('Are you sure you want to cancel this order?'))
            {
                $.ajax({
                    'url': '/admin/order/cancel-checkout',
                    'type': 'DELETE',
                    'data':{
                        'order_id': order_id,
                        '_token': _token,
                    },
                    success:function(response){
                        /* console.log(response); */

                        $('#cancelOrder'+response.order_id).remove();
                        $('#cartMessageBox').removeClass('hidden').addClass('block');
                        $('#cartMessageContent').html(response.message);
                    },
                    error:function(data){
                        /* console.log(data); */
                        window.location.reload();
                    }
                });
            }


        });

    });
</script>
</x-main.app>
