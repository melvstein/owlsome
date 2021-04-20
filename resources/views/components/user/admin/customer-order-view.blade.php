<div class="py-2 md:p-4">
    <x-main.validation-message />
    <div class="bg-white rounded shadow">
        <div class="px-4 py-2 bg-gray-50 rounded-t flex items-center justify-between">
            <h3 class="text-sm font-semibold uppercase text-gray-600">Order ID: <span class="text-blue-600">{{ $orderDetail[0]->order_id }}</span></h3>
            {{-- <a href="{{ route('admin.order.list') }}" title="Back" class="text-yellow-900 hover:text-yellow-700">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-6">
                    <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                </svg>
            </a> --}}
        </div>
        <div class="p-0 md:p-4 space-y-4">
            <div class="bg-gray-100">
                <div class="flex items-center justify-between bg-gray-200 p-4">
                    <p class="text-gray-500 uppercase font-bold text-xs">Receiver Details</p>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-12 gap-4 md:gap-2 p-4">
                    <div class="col-span-2 flex items-center uppercase text-gray-800 text-sm font-bold">
                        <label for="name">Name:</label>
                    </div>
                    <div class="col-span-10 flex items-center text-gray-700">
                        <p name="textDefault" id="receiverName" class="w-full">
                            <a href="{{ route('admin.user.details', $orderDetail[0]->user_id ) }}" class="text-blue-500 hover:text-blue-400">
                                {{ $orderDetail[0]->receiver }}
                            </a>
                        </p>
                    </div>
                    <div class="col-span-2 flex items-center uppercase text-gray-800 text-sm font-bold">
                        <label for="contactNumber">Contact Number:</label>
                    </div>
                    <div class="col-span-10 flex items-center text-gray-700">
                        <p name="textDefault" id="receiverNumber" class="w-full">{{ $orderDetail[0]->contactNumber }}</p>
                    </div>
                    <div class="col-span-2 flex items-center uppercase text-gray-800 text-sm font-bold">
                        <label for="address">Address:</label>
                    </div>
                    <div class="col-span-10 flex items-center text-gray-700">
                        <p name="textDefault" id="receiverAddress" class="w-full">{{ $orderDetail[0]->address }}</p>
                    </div>
                    <div class="col-span-2 flex items-center uppercase text-gray-800 text-sm font-bold">
                        <label for="city">City:</label>
                    </div>
                    <div class="col-span-10 flex items-center text-gray-700">
                        <p name="textDefault" id="receiverCity" class="w-full">{{ $orderDetail[0]->city }}</p>
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
            </div>

            <div class="bg-gray-100">
                <div class="bg-gray-200 p-4">
                    <p class="text-gray-500 uppercase font-bold text-xs">Items</p>
                </div>
                <div class="grid grid-cols-1 lg:grid-cols-4 gap-4 lg:gap-2 p-4">
                    @php
                        $total=0;
                        $overallAmount = 0;
                        $shipping_fee = 0;
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
                        @php
                            for($i = 0; $i < $cities->count(); $i++)
                            {
                                if($orderDetail[0]->city == $cities[$i]->city)
                                {
                                    $shipping_fee += $cities[$i]->shipping_fee;
                                }
                            }

                            $overallAmount += $total + $shipping_fee;
                        @endphp
                </div>
                <div class="bg-gray-200 flex items-center justify-end p-4">
                    <p class="text-lg">
                        <span class="font-bold text-yellow-900">Total Amount:</span> <span class="font-semibold text-gray-600"><i class="fa fa-ruble"></i> {{ $overallAmount }}</span>
                    </p>
                </div>
            </div>
        </div>
        <div class="flex items-center justify-end bg-gray-50 rounded-b px-4 py-2">
            <form id="shipNowForm" action="{{ route(Str::lower(auth()->user()->role).'.order.shipOrDeliver', [$orderDetail[0]->order_id, $shipping_fee, $total]) }}" method="POST">
                @csrf
                @method("PUT")
                <input type="hidden" name="order_id" value="{{ $orderDetail[0]->order_id }}" required>
                @if($orderDetail[0]->isCheckout)
                    <button type="submit" name="actionBtn" value="shipNowBtn" onclick="return confirm('Ship Now?')" class="bg-blue-600 hover:bg-blue-500 text-white uppercase font-semibold text-sm px-4 py-2 rounded">
                        Ship Now
                    </button>
                @elseif($orderDetail[0]->isShipped)
                    <button type="submit" name="actionBtn" value="deliveredBtn" onclick="return confirm('Mark as delivered?')" class="bg-green-600 hover:bg-green-500 text-white uppercase font-semibold text-sm px-4 py-2 rounded">
                        Mask as Delivered
                    </button>
                @else

                @endif
            </form>
        </div>
    </div>
</div>
<script>
$(document).ready(function() {
const cities = @json($cities);
const city = @json($orderDetail[0]->city);

for(let i = 0; i < cities.length; i++)
{
    if(cities[i].city == city)
    {
        $("#shippingFee").html(cities[i].shipping_fee);
    }
}
/* $('#orderList').DataTable({
        responsive: true
    }); */

/* const shipNowForm = $("#shipNowForm");
const _token = $("input[name=_token]").val();
const orderId = $("input[name=order_id]");

shipNowForm.on("submit", function(e){
    e.prevenDefault();

    $.ajax({
        'url' : $(this).attr('action'),
        'type': "PUT",
        'data': {
            '_token': _token,
            'order_id': orderId,
        },
        success:function(response)
        {
            console.log(response);
        },
    });

}); */

});
</script>
