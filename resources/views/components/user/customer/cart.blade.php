<style>
    /* Chrome, Safari, Edge, Opera */
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
      -webkit-appearance: none;
      margin: 0;
    }

    /* Firefox */
    input[type=number] {
      -moz-appearance: textfield;
    }
    </style>
    <form id="cartForm">
    @csrf
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
    <div class="relative bg-white shadow rounded-none md:rounded mt-4">
        <div class="bg-gray-50 rounded-none md:rounded-t p-4">
            <h1 class="text-sm font-bold uppercase text-yellow-900">
                Cart
            </h1>
        </div>
        <div class="grid grid-cols-1 gap-4 md:grid-cols-1 p-4">
            <div class="bg-white rounded shadow">
                <div class="bg-gray-50 rounded-t p-4">
                    <h4 class="text-sm uppercase font-semibold">Shipping Details <span class="text-gray-600 text-xs">(Cash On Delivery Only)</span></h4>
                </div>
                <div class="flex flex-col items-center p-4 space-y-4">
                    <div class="w-full">
                        <label for="receiverName" class="text-xs uppercase font-semibold">Receiver</label>
                        <input type="text" class="w-full rounded" name="receiverName" id="receiverName" placeholder="Receiver Name" value="{{ auth()->user()->firstName ." ". auth()->user()->lastName }}" required>
                    </div>
                    <div class="w-full">
                        <label for="receiverNumber" class="text-xs uppercase font-semibold">Contact Number</label>
                        <input type="number" class="w-full rounded" name="receiverNumber" id="receiverNumber" placeholder="Receiver Number" value="{{ auth()->user()->contactNumber }}" required>
                        <span class="hidden text-sm text-red-600" id="errorReceiverNumber"></span>
                    </div>
                    <div class="w-full">
                        <label for="city" class="text-xs uppercase font-semibold">City</label>
                        <select class="w-full rounded" onchange="cityFee()" name="city" id="city" required>
                            @foreach ($cities as $data)
                                <option value="{{ $data->city }}" {{ (auth()->user()->city == $data->city) ? "selected": "" }}>{{ $data->city }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="w-full">
                        <label for="shippingAddress" class="text-xs uppercase font-semibold">Shipping Address</label>
                        <textarea name="shippingAddress" id="shippingAddress" class="w-full h-16 rounded" placeholder="Complete Address" required>{{ auth()->user()->address }}</textarea>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded shadow">
                <div class="bg-gray-50 rounded-t p-4">
                    <h4 class="text-sm uppercase font-semibold" id="items">Items</h4>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 p-4">
                    @foreach ($oncartOrders as $oncartOrder)
                        <div class="flex flex-col rounded shadow" id="container{{ $oncartOrder->id }}">
                            <div class="flex items-center justify-between bg-gray-50 rounded-t px-4 py-2">
                                <div class="flex items-center justify-center space-x-2">
                                    @if($oncartOrder->units >= 1)
                                        <input type="checkbox" name="checkbox" data-quantity="" id="checkbox{{ $oncartOrder->id }}" value="{{ $oncartOrder->id }}" class="rounded">
                                    @else
                                        {{-- <input type="checkbox" name="checkbox" id="checkbox{{ $oncartOrder->id }}" value="{{ $oncartOrder->id }}" class="rounded cursor-not-allowed" disabled> --}}
                                    @endif
                                    <p class="text-sm uppercase font-semibold">{{ $oncartOrder->name }} <span class="text-xs text-gray-400">{{ $oncartOrder->category }}</span></p>
                                </div>
                                    <button name="delete" value="{{ $oncartOrder->id }}" id="delete{{ $oncartOrder->id }}" class="text-red-600 hover:text-red-500">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5">
                                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                            </div>
                            <div class="flex flex-col md:flex-row p-4 space-x-4">
                                <div class="flex items-center">
                                    <img src="{{ asset('storage/'. $oncartOrder->image_path) }}" class="bg-gray-100 w-auto h-auto md:w-24 md:h-24 rounded-t md:rounded-l" alt="Product Image">
                                </div>
                                <div x-data="totalAmount({{ $oncartOrder->price }}, {{ $oncartOrder->quantity }})" class="flex flex-col p-4 space-y-4">
                                    <div class="grid grid-cols-2 gap-4">
                                        <div class="flex items-center">
                                            <p class="text-sm font-semibold">Price</p>
                                        </div>
                                        <div class="flex items-center justify-end">
                                            <span>
                                                <i class="fa fa-ruble"></i> {{ $oncartOrder->price }}
                                            </span>
                                        </div>
                                        <div class="flex items-center">
                                            <p class="text-sm font-semibold {{ ($oncartOrder->units >= 1) ? 'text-green-600' : 'text-red-600' }}">{{ ($oncartOrder->units >= 1) ? 'In Stock' : 'Out of Stock' }}</p>
                                        </div>
                                        <div class="flex items-center justify-end">
                                            {{ $oncartOrder->units }}
                                        </div>
                                        <div class="flex items-center">
                                            <p class="text-sm font-semibold">Quantity</p>
                                        </div>
                                        <div class="flex items-center justify-end">
                                            {{-- <input type="hidden" name="id{{ $oncartOrder->id }}" value="{{ $oncartOrder->id }}"> --}}
                                            <p class="quantityNewElement hidden" id="quantityNewElement{{ $oncartOrder->id }}"></p>
                                            <button class="border border-r-0 border-gray-500 rounded-l p-2 bg-gray-100 focus:outline-none" name="minusQuantity" id="minusQuantity{{ $oncartOrder->id }}" value="{{ $oncartOrder->id }}">
                                                <i class="fa fa-minus"></i>
                                            </button>
                                            <input type="number" name="quantity{{ $oncartOrder->id }}"
                                                data-id="{{ $oncartOrder->id }}"
                                                data-units="{{ $oncartOrder->units }}"
                                                id="quantity"
                                                min="1"
                                                max="{{ $oncartOrder->units }}" maxlength="3"
                                                x-model="quantity"
                                                value="{{ $oncartOrder->quantity }}"
                                                class="appearance-none text-center focus:outline-none number"
                                                required>
                                            <button class="border border-l-0 border-gray-500 rounded-r p-2 bg-gray-100 focus:outline-none" name="plusQuantity" id="plusQuantity{{ $oncartOrder->id }}" value="{{ $oncartOrder->id }}">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                        <div class="flex items-center">
                                            <p class="text-sm font-semibold">Amount</p>
                                        </div>
                                        <div class="flex items-center justify-end space-x-1">
                                            <i class="fa fa-ruble"></i> <p x-text="amount()" id="amount{{ $oncartOrder->id }}"></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="col-span-4 flex items-center justify-center mb-4">
                    <a href="{{ route('home') }}" id="shopNowBtn" class="hidden border-2 border-yellow-900 text-yellow-900 hover:text-yellow-700 hover:border-yellow-700 font-semibold rounded px-4 py-2">
                        Shopping Now
                    </a>
                </div>
            </div>
        </div>
    <div class="flex flex-col md:flex-row items-start md:items-center justify-center md:justify-end bg-gray-50 p-4 rounded-none md:rounded-b space-y-2 md:space-y-0 space-x-0 md:space-x-4">
        <div class="flex items-center justify-center space-x-2" id="checkAllDiv">
            <input type="checkbox" name="checkAll" id="checkAll" class="rounded"> <label for="checkAll">All</label>
        </div>
        <div class="flex items-center justify-center space-x-2">
            <p>Shipping Fee: <span class="text-yellow-900 font-semibold"><i class="fa fa-ruble"></i> <span id="shippingFee">{{ $fee[0]->shipping_fee }}</span></span></p>
        </div>
        <div class="flex items-center justify-center space-x-2">
            <p>Subtotal: <span class="text-yellow-900 font-semibold"><i class="fa fa-ruble"></i> <span id="subTotal"></span></span></p>
        </div>
        <div class="flex items-center justify-center space-x-2">
            <p>Total: <span class="text-yellow-900 font-semibold"><i class="fa fa-ruble"></i> <span id="total"></span></span></p>
        </div>
        <div class="flex flex-col md:flex-row items-center justify-center space-y-2 md:space-y-0 space-x-0 md:space-x-4 w-full md:w-auto">
            <button class="bg-yellow-900 hover:bg-yellow-800 text-white px-4 py-2 rounded w-full md:w-auto"
                type="submit"
                onclick="return confirm('Are you sure you want to checkout now?')"
                id="checkoutNowBtn"
                value=""
                >
                Checkout Now
            </button>
            <a href="{{ route('home') }}" class="border border-yellow-900 hover:bg-gray-100 text-yellow-900 px-4 py-2 rounded w-full md:w-auto text-center">
                Shop More
            </a>
        </div>
    </div>
    </div>
    </form>
    <script>
        let ids=[];
        const cities = @json($cities);
        const shippingFee = @json($fee);
        let fee = 0;

        for(let i = 0; i < shippingFee.length; i++)
        {
            fee += shippingFee[i].shipping_fee;
        }

        function totalAmount(price, quantity)
        {
            return {
                quantity : quantity,
                price: price,
                amount(){ return (this.price * this.quantity).toFixed(2) },
                overallAmount(){ return this.amount() += amount() }
                 }
        }

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
            if(ids.length === 0)
            {
                $("#total").html(cfee);
            }else{
                $.ajax({
                    'url': 'oncart-selected',
                    'type': 'GET',
                    'data':{
                        ids: ids,
                    },
                    success:function(response){
                        /* console.log(response); */
                        $('#subTotal').html(response.subTotal);
                        $('#total').html(response.subTotal + cfee);
                    }
                });
            }
            return cfee;
        }

    $(document).ready(function(){
        let _token = $('input[name=_token]').val();
        let plusButton = $('button[name=plusQuantity]');
        let minusButton = $('button[name=minusQuantity]');
        let checkoutNowBtn = $('#checkoutNowBtn');
        let cartForm = $('#cartForm');
        let checkAll = $('#checkAll');
        let checkbox = $("input[name=checkbox]");

        if({{ $oncartCount->count() }} == 0)
        {
            /* console.log('0 Oncart'); */
            $('#shopNowBtn').removeClass('hidden').addClass('block');
            $('#checkAllDiv').addClass('hidden');
            checkoutNowBtn.prop('disabled', true).removeClass('bg-yellow-900 hover:bg-yellow-800').addClass('cursor-not-allowed bg-gray-800 bg-opacity-50');
        }

        $('#closeMessageBox').on('click' ,function(e){
            e.preventDefault();
            $('#cartMessageBox').removeClass('block').addClass('hidden');
        });

        $("button[name=delete]").on('click', function(e){
            e.preventDefault();

            if(confirm('Are you sure you want to remove this item?'))
            {
                let id = $(this).val();

                $.ajax({
                    url: 'delete-oncart/'+id,
                    type: 'DELETE',
                    data:{
                        _token: _token,
                        id: id,
                    },
                    success:function(response)
                    {
                        $('div #container'+id).remove();
                        if(response.itemCount == 0)
                        {
                            /* console.log('0 Oncart'); */
                            $('#checkAllDiv').addClass('hidden');
                            $('#shopNowBtn').removeClass('hidden').addClass('block');
                            checkoutNowBtn.prop('disabled', true).removeClass('bg-yellow-900 hover:bg-yellow-800').addClass('cursor-not-allowed bg-gray-800 bg-opacity-50');
                        }
                        $('[data-name=cartItemCount]').html('<i class="fa fa-shopping-cart"> '+ response.itemCount);
                        /* console.log(response); */
                        /* $('#subTotal').html(response.totalAmount); */
                        $('#cartMessageBox').removeClass('hidden').addClass('block');
                        $('#cartMessageContent').html(response.message);
                        /* window.location.reload(); */
                        if(response.itemCount === 1 && checkbox.is(":checked")){
                            checkAll.prop('checked', true);
                        }
                    }
                });
            }
        });

        plusButton.on('click', function(e){
            e.preventDefault();
            let plusId = $(this).val();
            let currentVal = parseInt($('input[name=quantity'+plusId+']').val());
            let dataUnits = parseInt($('input[name=quantity'+plusId+']').attr("data-units"));

            if (!isNaN(currentVal)) {
                // Increment
                $('input[name=quantity'+plusId+']').val(currentVal + 1);
            } else {
                // Otherwise put a 0 there
                $('input[name=quantity'+plusId+']').val(0);
            }
            let newVal = parseInt($('input[name=quantity'+plusId+']').val());
                /* console.log("clicked plus id = "+plusId+ " Value is = "+ newVal); */

            $.ajax({
                url: 'update-oncart/'+plusId,
                type: 'PUT',
                data:{
                    _token: _token,
                    id: plusId,
                    quantity: newVal,
                    units: dataUnits,
                },
                success:function(response){

                    /* console.log(response); */
                    $('#amount'+plusId).html(response.amount.toFixed(2));
                    /* $('#subTotal').html(response.totalAmount); */
                    $('input[name=quantity'+plusId+']').val(response.quantity);
                }
            });
        });

        minusButton.on('click', function(e){
            e.preventDefault();
            let minusId = $(this).val();
            let currentVal = parseInt($('input[name=quantity'+minusId+']').val());
            let dataUnits = parseInt($('input[name=quantity'+minusId+']').attr("data-units"));

            if (!isNaN(currentVal)) {
                // Increment
                $('input[name=quantity'+minusId+']').val(currentVal - 1);
            } else {
                // Otherwise put a 0 there
                $('input[name=quantity'+minusId+']').val(0);
            }

            let newVal = parseInt($('input[name=quantity'+minusId+']').val());
                /* console.log("clicked minus id = "+minusId+ " Value is = "+ newVal); */

            $.ajax({
                url: 'update-oncart/'+minusId,
                type: 'PUT',
                data:{
                    _token: _token,
                    id: minusId,
                    quantity: newVal,
                    units: dataUnits,
                },
                success:function(response){
                    /* console.log(response); */
                    $('#amount'+minusId).html(response.amount.toFixed(2));
                    /* $('#subTotal').html(response.totalAmount); */
                    $('input[name=quantity'+minusId+']').val(response.quantity);
                }
            });
        });

        $('.number').keyup(function(){

            let id = $(this).data('id');
            let quantity = $(this).val();
            let dataUnits = parseInt($('input[name=quantity'+id+']').attr("data-units"));

            $.ajax({
                url: 'update-oncart/'+id,
                type: 'PUT',
                data:{
                    _token: _token,
                    id: id,
                    quantity: quantity,
                    units: dataUnits,
                },
                success:function(response){
                    /* console.log(response); */
                    $('#amount'+id).html(response.amount.toFixed(2));
                    /* $('#subTotal').html(response.totalAmount); */
                    $('input[name=quantity'+id+']').val(response.quantity);
                }
            });

        });

        $('input[type="checkbox"]').click(function(){
            let checkboxId = $(this).val();

            if($(this).is(":checked")){
                $('#delete'+checkboxId).addClass('hidden');
                /* console.log(checkboxId + ' checked'); */
                ids.push(checkboxId);

                if(ids.length === $('input[name="checkbox"]').length){
                    checkAll.prop('checked', true);
                }

                $.ajax({
                    'url': 'oncart-selected',
                    'type': 'GET',
                    'data':{
                        ids: ids,
                    },
                    success:function(response){
                        /* console.log(response); */
                        checkoutNowBtn.val(response.ids);
                        $('#subTotal').html(response.subTotal);
                        $('#total').html(response.subTotal + cityFee());
                        $("#quantityNewElement"+checkboxId).removeClass("hidden").html($('input[name=quantity'+checkboxId+']').val());
                        $("#minusQuantity"+checkboxId).addClass('hidden');
                        $('input[name=quantity'+checkboxId+']').prop('disabled', true).addClass('border-0 text-right hidden');
                        $("#plusQuantity"+checkboxId).addClass('hidden');

                    }
                });
            }
            else if($(this).is(":not(:checked)")){
                checkAll.prop('checked', false);
                $('#delete'+checkboxId).removeClass('hidden');
                /* console.log(checkboxId + ' unchecked'); */
                var index = ids.indexOf(checkboxId);

                if (index > -1) {
                    ids.splice(index, 1);
                }

                $.ajax({
                    'url': 'oncart-selected',
                    'type': 'GET',
                    'data':{
                        ids: ids,
                    },
                    success:function(response){
                        /* console.log(response); */
                        checkoutNowBtn.val(response.ids);
                        $('#subTotal').html(response.subTotal);
                        $('#total').html(response.subTotal + cityFee());
                        $("#quantityNewElement"+checkboxId).addClass("hidden").html($('input[name=quantity'+checkboxId+']').val());
                        $("#minusQuantity"+checkboxId).removeClass('hidden');
                        $('input[name=quantity'+checkboxId+']').prop('disabled', false).removeClass('border-0 text-right hidden');
                        $("#plusQuantity"+checkboxId).removeClass('hidden');
                    }
                });
            }

            /* console.log(ids); */
            if(ids.length === 0){
                checkAll.prop('checked', false);
                $('#subTotal').html(0);
                $('#total').html(cityFee());
                checkoutNowBtn.prop('disabled', true).removeClass('bg-yellow-900 hover:bg-yellow-800').addClass('cursor-not-allowed bg-gray-800 bg-opacity-50');
            }else{
                checkoutNowBtn.prop('disabled', false).removeClass('cursor-not-allowed bg-gray-800 bg-opacity-50').addClass('bg-yellow-900 hover:bg-yellow-800');
            }
        });

        checkAll.on('click', function(e){
           ids = [];

           /*  this.checked ? $("input[type=checkbox]").prop("checked",true) : $("input[type=checkbox]").prop("checked",false); */

            if(checkAll.is(':checked'))
            {
                checkbox.prop("checked",true);
                checkbox.each(function() {
                    ids.push($(this).val());
                });
                /* console.log(ids); */

                $.ajax({
                    'url': 'oncart-selected',
                    'type': 'GET',
                    'data':{
                        ids: ids,
                    },
                    success:function(response){
                        /* console.log(response); */
                        ids.forEach(function(id){
                            $('#delete'+id).addClass('hidden');
                        });
                        checkoutNowBtn.val(response.ids);
                        $('#subTotal').html(response.subTotal);
                        $('#total').html(response.subTotal + cityFee());
                        $("#quantityNewElement").removeClass("hidden").html($('.number').val());
                        minusButton.addClass('hidden');
                        $('.number').prop('disabled', true).addClass('border-0 text-right');
                        plusButton.addClass('hidden');
                    }
                });

            }else{
                checkbox.prop("checked",false);
                ids = [];
                /* console.log(ids); */
                $.ajax({
                    'url': 'oncart-selected',
                    'type': 'GET',
                    'data':{
                        ids: ids,
                    },
                    success:function(response){
                        /* console.log(response); */
                        $('button[name=delete]').removeClass('hidden');
                        checkoutNowBtn.val(response.ids);
                        $('#subTotal').html(response.subTotal);
                        $('#total').html(response.subTotal + cityFee());
                        $(".quantityNewElement").addClass("hidden").html($('.number').val());
                        minusButton.removeClass('hidden');
                        $('.number').prop('disabled', false).removeClass('border-0 text-right hidden');
                        plusButton.removeClass('hidden');
                    }
                });
            }

            if(ids.length === 0){
                $('#subTotal').html(0);
                $('#total').html(cityFee());
                checkoutNowBtn.prop('disabled', true).removeClass('bg-yellow-900 hover:bg-yellow-800').addClass('cursor-not-allowed bg-gray-800 bg-opacity-50');
            }else{
                checkoutNowBtn.prop('disabled', false).removeClass('cursor-not-allowed bg-gray-800 bg-opacity-50').addClass('bg-yellow-900 hover:bg-yellow-800');
            }
        });

        if(ids.length === 0){
            $('#subTotal').html(0);
            $('#total').html(cityFee());
            checkoutNowBtn.prop('disabled', true).removeClass('bg-yellow-900 hover:bg-yellow-800').addClass('cursor-not-allowed bg-gray-800 bg-opacity-50');
        }else{
            checkoutNowBtn.prop('disabled', false).removeClass('cursor-not-allowed bg-gray-800 bg-opacity-50').addClass('bg-yellow-900 hover:bg-yellow-800');
        }

        cartForm.submit(function(e){
            e.preventDefault();
            let receiverName = $('input[name=receiverName]').val();
            let receiverNumber = $('input[name=receiverNumber]').val();
            let city = $('select[name=city]').val();
            let shippingAddress = $('textarea[name=shippingAddress]').val();
            let idsarr = checkoutNowBtn.val().split(',').map(Number);
            /* console.log(ids); */
            $.ajax({
                'url': 'oncart-checkout',
                'type': 'PUT',
                'data':{
                    '_token': _token,
                    'receiverName': receiverName,
                    'receiverNumber': receiverNumber,
                    'city': city,
                    'shippingAddress': shippingAddress,
                    'ids': ids,
                },
                success:function(response){
                    ids = [];
                    idsarr.forEach(function(id) {
                        $('div #container'+id).remove();
                    });

                    if(response.itemCount == 0)
                    {
                        /* console.log('0 Oncart'); */
                        $('#shopNowBtn').removeClass('hidden').addClass('block');
                        $('#checkAllDiv').addClass('hidden');
                    }else{
                        checkAll.prop('checked', false);
                    }
                    checkoutNowBtn.prop('disabled', true).removeClass('bg-yellow-900 hover:bg-yellow-800').addClass('cursor-not-allowed bg-gray-800 bg-opacity-50').val('');
                    $('[data-name=cartItemCount]').html('<i class="fa fa-shopping-cart"> '+ response.itemCount);
                    /* console.log(response); */
                    $('#receiverNumber').removeClass('border-red-600');
                    $('#errorReceiverNumber').removeClass('block').addClass('hidden');
                    $('#subTotal').html(response.subTotal);
                    $('#total').html(response.totalAmount);
                    $('#cartMessageBox').removeClass('hidden').addClass('block');
                    $('#cartMessageContent').html(response.message);
                    window.location.href = 'order-details';
                },
                error:function(data)
                {
                    $('#receiverNumber').addClass('border-red-600');
                    $('#errorReceiverNumber').removeClass('hidden').addClass('block').html(data.responseJSON.error.receiverNumber);
                    /* console.log(data.responseJSON.error.receiverNumber);
                    console.log(data); */
                }
            });
        });

    });//end of jquery

    </script>
