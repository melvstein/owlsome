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
<div class="bg-white rounded shadow mt-4">
    <div class="flex items-center justify-between rounded-t bg-gray-50 p-4">
        <h1 class="text-sm uppercase text-yellow-900 font-bold mr-2 flex items-center gap-2">
            Order Details {{-- {{ $orderDetail }} --}}
        </h1>
        <a href="{{ route('customer.orderDetails') }}" title="Back" class="text-yellow-900 hover:text-yellow-700">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-6">
                <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
            </svg>
        </a>
    </div>
    <div class="p-0 md:p-4 space-y-4">
        <div class="bg-gray-100">
        <form id="detailsForm" action="{{ route('customer.editOrderDetailsForm', $orderDetail[0]->order_id) }}">
            @csrf
            <div class="flex items-center justify-between bg-gray-200 p-4">
                <p class="text-gray-500 uppercase font-bold text-xs">Receiver Details</p>

                @if($orderDetail[0]->isCheckout)
                    <button id="editDetailsBtn" class="px-4 focus:outline-none focus:ring-1 focus:ring-green-600 focus:text-green-600 hover:text-green-600 hover:shadow rounded">
                        Edit
                    </button>

                    <button id="exitDetailsBtn" class="px-4 focus:outline-none focus:ring-1 focus:ring-green-600 focus:text-green-600 hover:text-green-600 hover:shadow rounded hidden">
                        Exit
                    </button>
                @elseif($orderDetail[0]->isShipped)

                @elseif($orderDetail[0]->isDelivered)

                @endif
            </div>
            <div class="grid grid-cols-1 md:grid-cols-12 gap-4 md:gap-2 p-4">
                <div class="col-span-2 flex items-center uppercase text-gray-800 text-sm font-bold">
                    Order Id:
                </div>
                <div class="col-span-10 flex items-center text-gray-700">
                    <p>{{ $orderDetail[0]->order_id }}</p>
                    <input type="hidden" name="order_id" id="order_id" value="{{ $orderDetail[0]->order_id }}" class="rounded w-full" required>
                </div>
                <div class="col-span-2 flex items-center uppercase text-gray-800 text-sm font-bold">
                    <label for="name">Name:</label>
                </div>
                <div class="col-span-10 flex items-center text-gray-700">
                    <p name="textDefault" id="receiverName" class="w-full">{{ $orderDetail[0]->receiver }}</p>
                    <div class="flex flex-col w-full">
                        <input type="text" name="name" id="name" value="{{ $orderDetail[0]->receiver }}" class="rounded w-full hidden" required>
                        <span class="text-red-600 text-sm" id="errorName"></span>
                    </div>
                </div>
                <div class="col-span-2 flex items-center uppercase text-gray-800 text-sm font-bold">
                    <label for="contactNumber">Contact Number:</label>
                </div>
                <div class="col-span-10 flex items-center text-gray-700">
                    <p name="textDefault" id="receiverNumber" class="w-full">{{ $orderDetail[0]->contactNumber }}</p>
                    <div class="flex flex-col w-full">
                        <input type="number" name="contactNumber" id="contactNumber" value="{{ $orderDetail[0]->contactNumber }}" class="rounded w-full hidden" minlength="11" maxlength="11" required>
                        <span class="text-red-600 text-sm" id="errorContactNumber"></span>
                    </div>
                </div>
                <div class="col-span-2 flex items-center uppercase text-gray-800 text-sm font-bold">
                    <label for="address">Address:</label>
                </div>
                <div class="col-span-10 flex items-center text-gray-700">
                    <p name="textDefault" id="receiverAddress" class="w-full">{{ $orderDetail[0]->address }}</p>
                    <div class="flex flex-col w-full">
                        <input type="text" name="address" id="address" value="{{ $orderDetail[0]->address }}" class="rounded w-full hidden" required>
                        <span class="text-red-600 text-sm" id="errorAddress"></span>
                    </div>
                </div>
                <div class="col-span-2 flex items-center uppercase text-gray-800 text-sm font-bold">
                    <label for="city">City:</label>
                </div>
                <div class="col-span-10 flex items-center text-gray-700">
                    <p name="textDefault" id="receiverCity" class="w-full">{{ $orderDetail[0]->city }}</p>
                    <div class="flex flex-col w-full">
                        <select class="rounded w-full hidden" onchange="cityFee()" name="city" id="city" required>
                            @foreach ($cities as $data)
                                <option value="{{ $data->city }}" {{ ($orderDetail[0]->city == $data->city) ? "selected": "" }}>{{ $data->city }}</option>
                            @endforeach
                        </select>
                        <span class="text-red-600 text-sm" id="errorCity"></span>
                    </div>
                </div>
                <div class="col-span-2 flex items-center uppercase text-gray-800 text-sm font-bold">
                    Shipping Fee:
                </div>
                <div class="col-span-10 flex items-center text-gray-700">
                    <p>{{ $pesoSign }} <span id="shippingFee"></span></p>
                </div>
                <div class="col-span-2 flex items-center uppercase text-gray-800 text-sm font-bold">
                    Status:
                </div>
                <div class="col-span-10 flex items-center text-gray-700">
                    @if($orderDetail[0]->isCheckout)
                        <p class="bg-yellow-600 text-yellow-100 text-xs uppercase font-bold px-4 rounded-full">
                            Pending
                        </p>
                    @elseif($orderDetail[0]->isShipped)
                        <p class="bg-blue-600 text-blue-100 text-xs uppercase font-bold px-4 rounded-full">
                            To Ship
                        </p>
                    @elseif($orderDetail[0]->isDelivered)
                        <p class="bg-green-600 text-green-100 text-xs uppercase font-bold px-4 rounded-full">
                            Received
                        </p>
                    @endif
                </div>
            </div>
            <div id="saveDiv" class="hidden">
                <div class="flex items-center justify-end bg-gray-200 p-4">
                    <button type="submit" id="saveBtn" class="bg-green-600 px-4 py-2 text-white hover:bg-green-500 rounded">
                        Save
                    </button>
                </div>
            </div>
        </form>
        </div>

        <div class="bg-gray-100">
            <div class="bg-gray-200 p-4">
                <p class="text-gray-500 uppercase font-bold text-xs">Items</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 md:gap-2 p-4">
                @php
                    $total=0;
                @endphp
                @foreach ($orderDetail as $order)
                    <div class="bg-white shadow">
                        <div class="px-4 py-2 bg-gray-100 bg-opacity-50 text-yellow-900">
                            {{ $order->name }}
                        </div>
                        <div class="flex p-2 space-x-4">
                            <img src="{{ asset('storage/'. $order->image_path) }}" class="w-24 h-24" alt="">
                            <div class="grid grid-cols-2 gap-2">
                                <div class="flex items-center uppercase font-semibold text-xs">
                                    Price:
                                </div>
                                <div class="flex items-center justify-end font-semibold text-sm">
                                    <span><i class="fa fa-ruble"></i> {{ $order->price }}</span>
                                </div>
                                <div class="flex items-center uppercase font-semibold text-xs">
                                    Quantity:
                                </div>
                                <div class="flex items-center justify-end font-semibold text-sm">
                                    {{ $order->quantity }}
                                </div>
                                <div class="flex items-center uppercase font-semibold text-xs">
                                    Amount:
                                </div>
                                <div class="flex items-center justify-end font-semibold text-sm">
                                    <span><i class="fa fa-ruble"></i> {{ $order->price * $order->quantity }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    @php
                        $total += $order->price * $order->quantity;
                    @endphp
                @endforeach
            </div>
            <div class="bg-gray-200 flex items-center justify-end p-4">
                <p class="text-lg">
                    <span class="font-bold text-yellow-900">Total Amount:</span> <span class="font-semibold text-gray-600">{{ $pesoSign }} <span id="subTotal"></span></span>
                </p>
            </div>
        </div>
    </div>
</div>
<script>
    const cities = @json($cities);
    let subTotal = @json($total);

    $("#subTotal").html(subTotal + cityFee());
    $("shippingFee").html(cityFee());

    function cityFee()
    {
        let city = $("#city").val();
        let cfee = 0;

        for(let i = 0; i < cities.length; i++)
        {
            if(cities[i].city === city)
            {
                cfee += cities[i].shipping_fee;
            }
        }

        /* console.log(cfee); */
        $("#shippingFee").html(cfee);
        $("#subTotal").html(subTotal + cfee);
        return cfee;
    }

$(document).ready(function(){

    let detailsForm = $('#detailsForm');
    let _token = $('input[name=_token]').val();
    let editDetailsBtn = $('#editDetailsBtn');
    let exitDetailsBtn = $('#exitDetailsBtn');
    let textDefault = $('[name=textDefault]');
    let saveDiv = $('#saveDiv');
    let saveBtn = $('#saveBtn');
    let order_id = $('#order_id');
    let name = $('input#name');
    let contactNumber = $('input#contactNumber');
    let address = $('input#address');
    let city = $('select#city');
    let receiverName = $('p#receiverName');
    let receiverNumber = $('p#receiverNumber');
    let receiverAddress = $('p#receiverAddress');
    let receiverCity = $('p#receiverCity');
    let errorName = $('#errorName');
    let errorContactNumber = $('#errorContactNumber');
    let errorAddress = $('#errorAddress');
    let errorCity = $('#errorCity');

    $('#closeMessageBox').on('click' ,function(e){
        e.preventDefault();
        $('#cartMessageBox').removeClass('block').addClass('hidden');
    });

    editDetailsBtn.on('click', function(e){
        e.preventDefault();

        exitDetailsBtn.removeClass('hidden');
        editDetailsBtn.addClass('hidden');
        textDefault.addClass('hidden');
        $('input').removeClass('hidden');
        $('select').removeClass('hidden');
        saveDiv.removeClass('hidden');
        errorName.removeClass('hidden');
        errorContactNumber.removeClass('hidden');
        errorAddress.removeClass('hidden');
        errorCity.removeClass('hidden');
    });

    exitDetailsBtn.on('click', function(e){
        e.preventDefault();

        exitDetailsBtn.addClass('hidden');
        editDetailsBtn.removeClass('hidden');
        textDefault.removeClass('hidden');
        $('input').addClass('hidden');
        $('select').addClass('hidden');
        saveDiv.addClass('hidden');
        errorName.addClass('hidden');
        errorContactNumber.addClass('hidden');
        errorAddress.addClass('hidden');
        errorCity.addClass('hidden');
    });

    detailsForm.on('submit', function(e){
        e.preventDefault();

        let order_idVal = $('#order_id').val();
        let nameVal = name.val();
        let contactNumberVal = contactNumber.val();
        let addressVal = address.val();
        let cityVal = city.val();

        $.ajax({
            'url': $(this).attr('action'),
            'type': 'PUT',
            'data':{
                '_token': _token,
                'order_id': order_idVal,
                'name': nameVal,
                'contactNumber': contactNumberVal,
                'address': addressVal,
                'city': cityVal,
            },
            success:function(response)
            {
                /* console.log(response); */

                $('#cartMessageBox').removeClass('hidden').addClass('block');
                $('#cartMessageContent').html(response.message);
                exitDetailsBtn.addClass('hidden');
                editDetailsBtn.removeClass('hidden');
                textDefault.removeClass('hidden');
                $('input').addClass('hidden');
                $('select').addClass('hidden');
                saveDiv.addClass('hidden');
                receiverName.html(response.data.name);
                receiverNumber.html(response.data.contactNumber);
                receiverAddress.html(response.data.address);
                receiverCity.html(response.data.city);
                name.removeClass('border-red-600');
                contactNumber.removeClass('border-red-600');
                address.removeClass('border-red-600');
                city.removeClass('border-red-600');
                errorName.html("");
                errorContactNumber.html("");
                errorAddress.html("");
                errorCity.html("");
            },
            error:function(data)
            {
                /* console.log(data); */
                $('#cartMessageBox').removeClass('block').addClass('hidden');

                if(data.responseJSON.error.name)
                {
                    name.addClass('border-red-600');
                }

                if(data.responseJSON.error.contactNumber)
                {
                    contactNumber.addClass('border-red-600');
                }

                if(data.responseJSON.error.address)
                {
                    address.addClass('border-red-600');
                }

                if(data.responseJSON.error.city)
                {
                    city.addClass('border-red-600');
                }

                if(data.responseJSON.status_code === 406)
                {
                    window.location.reload();
                }

                errorName.html(data.responseJSON.error.name);
                errorContactNumber.html(data.responseJSON.error.contactNumber);
                errorAddress.html(data.responseJSON.error.address);
                errorCity.html(data.responseJSON.error.city);
            }
        });

    });

});
</script>
