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
    <div class="rounded-t bg-gray-50 p-4">
        <h1 class="text-sm uppercase text-yellow-900 font-bold mr-2 flex items-center gap-2">
            Checkout Items
        </h1>
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
                @foreach ($checkoutOrders as $checkoutOrder)
                    <tr id="cancelOrder{{ $checkoutOrder->order_id }}">
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ date("F j, Y, g:i a", strtotime($checkoutOrder->created_at)) }}</td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            <a href="{{ route('customer.viewOrderDetails', $checkoutOrder->order_id) }}" class="text-blue-600 hover:text-blue-400">
                                {{ $checkoutOrder->order_id }}
                            </a>
                        </td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $checkoutOrder->numberofItems }}</td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            @if($checkoutOrder->isCheckout)
                                <p class="bg-yellow-600 text-yellow-100 font-bold text-xs uppercase rounded-full text-center">
                                    Pending
                                </p>
                            @elseif($checkoutOrder->isShipped)
                                <p class="bg-blue-600 text-blue-100 font-bold text-xs uppercase rounded-full text-center">
                                    To Ship
                                </p>
                            @elseif($checkoutOrder->isDelivered)
                                <p class="bg-green-600 text-green-100 font-bold text-xs uppercase rounded-full text-center">
                                    Received
                                </p>
                            @endif
                        </td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            @if($checkoutOrder->isCheckout)
                                <p class="text-gray-700 text-sm">
                                    Wait 2 to 3 days, we will contact you.
                                    <br>
                                    <span class="text-red-600"><span class="font-semibold">Warning</span>: If you are a Bogus buyer, you will be posted in our facebook page.</span>
                                </p>
                            @elseif($checkoutOrder->isShipped)

                            @elseif($checkoutOrder->isDelivered)

                            @endif
                        </td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            @if($checkoutOrder->isDelivered)
                                <p>{{ date("F j, Y, g:i a", strtotime($checkoutOrder->updated_at)) }}</p>
                            @endif
                        </td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            @if($checkoutOrder->isCheckout)
                                <button class="border border-red-600 text-red-600 hover:bg-red-600 hover:text-white focus:outline-none focus:ring-2 focus:ring-red-400 rounded-full px-4 uppercase text-xs" name="cancelCheckout" id="cancelCheckout{{ $checkoutOrder->order_id }}" value="{{ $checkoutOrder->order_id }}">
                                    Cancel
                                </button>
                            @elseif($checkoutOrder->isShipped)
                                <button class="bg-gray-500 bg-opacity-50 text-gray-600 rounded-full px-4 uppercase text-xs cursor-not-allowed"
                                    name="cancelCheckout"
                                    id="cancelCheckout{{ $checkoutOrder->order_id }}"
                                    value="{{ $checkoutOrder->order_id }}"
                                    disabled>
                                    Cancel
                                </button>
                            @elseif($checkoutOrder->isDelivered)
                                <button class="bg-gray-500 bg-opacity-50 text-gray-600 rounded-full px-4 uppercase text-xs cursor-not-allowed"
                                    name="cancelCheckout"
                                    id="cancelCheckout{{ $checkoutOrder->order_id }}"
                                    value="{{ $checkoutOrder->order_id }}"
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
                'url': 'cancel-checkout',
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
</div>
