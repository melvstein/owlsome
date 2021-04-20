<x-main.validation-message />
<div class="bg-white rounded shadow mt-4">
    <div class="rounded-t border-b bg-gray-50 p-4">
        <h1 class="text-sm uppercase text-yellow-900 font-bold mr-2 flex items-center gap-2">
            Buy Now
        </h1>
    </div>
    <form id="buyNowForm" action="{{ route('customer.checkout') }}" method="POST">
    @csrf
    <input type="hidden" name="product_id" value="{{ $product->id }}">
    <div class="grid grid-cols-1 md:grid-cols-2 auto-rows-min gap-4 p-4">
        <div class="bg-white rounded shadow">
            <div class="bg-gray-50 rounded-t border-b p-4">
                <h4 class="text-sm uppercase font-semibold">Shipping Details</h4>
            </div>
            <div class="flex flex-col items-center p-4 space-y-4">
                <div class="w-full">
                    <label for="receiverName" class="text-xs uppercase font-semibold">Receiver</label>
                    <input type="text" class="w-full rounded" name="receiverName" id="receiverName" placeholder="Receiver Name" value="{{ (empty(auth()->user()->firstName) && empty(auth()->user()->lastName)) ? auth()->user()->name : auth()->user()->firstName ." ". auth()->user()->lastName }}" required>
                </div>
                <div class="w-full">
                    <label for="receiverNumber" class="text-xs uppercase font-semibold">Contact Number</label>
                    <input type="number" class="w-full rounded" name="receiverNumber" id="receiverNumber" placeholder="Receiver Number" value="{{ auth()->user()->contactNumber }}" required>
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
        <div class="bg-white rounded shadow flex flex-col justify-between">
            <div class="bg-gray-50 rounded-t border-b p-4">
                <h4 class="text-sm uppercase font-semibold">{{ $product->name }} <span class="text-xs text-gray-400">{{ $product->category }}</span></h4>
            </div>
            <div class="flex flex-col space-y-4 p-4">
                <div class="flex flex-col items-center md:flex-row space-x-4">
                    <div>
                        <img src="{{ asset('storage/'. $product->image_path) }}" class="bg-white w-40 h-40" alt="Product Image">
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="flex items-center">
                            @if($product->units >= 1)
                                <p class="text-green-600 font-semibold">In Stock</p>
                            @else
                                <p class="text-red-600 font-semibold">Out of Stock</p>
                            @endif
                        </div>
                        <div class="flex items-center">
                            <p class="text-sm">{{ $product->units }}</p>
                        </div>
                        <div class="flex items-center">
                            <p class="font-semibold">Price</p>
                        </div>
                        <div class="flex items-center">
                            <p class="text-sm"><i class="fa fa-ruble"></i> {{ number_format($product->price, 2) }}</p>
                        </div>
                        <div class="flex items-center">
                            <p class="font-semibold">Quantity</p>
                        </div>
                        <div class="flex items-center">
                            <input type="number" class="rounded w-full" name="quantity" id="quantity" min="1" max="{{ $product->units }}" maxlength="2" onchange="quantityCount()" value="{{ request()->get('quantity') ? request()->get('quantity') : 1  }}" required>
                        </div>
                        <div class="flex items-center">
                            <p class="font-semibold">Amount</p>
                        </div>
                        <div class="flex items-center">
                            <span class="flex items-center space-x-1"><i class="fa fa-ruble" aria-hidden="true"></i> <p id="amount"></p></span>
                        </div>
                        <div class="flex items-center">
                            <p class="font-semibold">Shipping Fee</p>
                        </div>
                        <div class="flex items-center">
                            <p>{{ $pesoSign }} <span id="shippingFee"></span></p>
                        </div>
                        <div class="flex items-center">
                            <p class="font-semibold">Details</p>
                        </div>
                        <div class="flex items-center">
                            <p class="text-sm">{{ $product->details }}</p>
                        </div>
                        <div class="flex items-center">
                            <p class="font-semibold">Description</p>
                        </div>
                        <div class="flex items-center">
                            <p class="text-sm">{{ $product->description }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-4 py-2 border-t rounded-b flex items-center justify-end">
                <p>Total Amount: <span id="subTotal"></span></p>
            </div>
        </div>
    </div>
    <div class="flex flex-col md:flex-row item justify-between md:justify-end rounded-b border-t bg-gray-50 p-4 space-y-2 md:space-y-0 space-x-0 md:space-x-4">
        @if($product->units >= 1)
            <button class="bg-yellow-900 hover:bg-yellow-800 text-white px-4 py-2 rounded"
            type="submit"
            name="action"
            value="checkoutNow"
            id="checkoutNow{{ $product->id }}"
            onclick="return confirm('Are you sure you want to checkout now?')">
                Checkout Now
            </button>
        @else
            <button class="bg-gray-600 bg-opacity-50 text-white px-4 py-2 rounded cursor-not-allowed"
            type="submit"
            name="action"
            value="checkoutNow"
            id="checkoutNow{{ $product->id }}"
            onclick="return confirm('Are you sure you want to checkout now?')"
            disabled>
                Checkout Now
            </button>
        @endif
        <a href="{{ route('home') }}" class="border border-yellow-900 hover:bg-gray-100 text-yellow-900 px-4 py-2 rounded text-center">
            Shop More
        </a>
    </div>
    </form>
</div>
<script>
    const cities = @json($cities);
    let price = @json($product->price);
    let quantity = $("#quantity").val();

    cityFee();
    quantityCount();

    function quantityCount()
    {
        let price = @json($product->price);
        let quantity = $("#quantity").val();
        let totalqa = quantity * price;
        $("#amount").html(totalqa);
        $("#subTotal").html(totalqa + cityFee());
        return totalqa;
    }

    function totalAmount()
    {
       return {
            quantity : {{ request()->get('quantity') ? request()->get('quantity') : 1 }},
            price: {{ $product->price }},
            total() { return parseFloat(this.price * this.quantity) }
        }
    }

    function cityFee()
    {
        let city = $("#city").val();
        let cfee = 0;
        let price = @json($product->price);
        let quantity = $("#quantity").val();
        for(let i = 0; i < cities.length; i++)
        {
            if(cities[i].city === city)
            {
                cfee += cities[i].shipping_fee;
            }
        }

        /* console.log(cfee); */
        $("#shippingFee").html(cfee);
        $("#subTotal").html(quantity * price + cfee);
        return cfee;
    }

$('form').submit(function () {
    window.onbeforeunload = null;
});

window.onbeforeunload = function() {
    return 'You have unsaved changes!';
}

/* const beforeUnloadListener = (event) => {
  event.preventDefault();
  return event.returnValue = "Are you sure you want to exit?";
};

const nameInput = document.querySelector("#receiverName");

nameInput.addEventListener("input", (event) => {
  if (event.target.value !== "") {
    addEventListener("beforeunload", beforeUnloadListener, {capture: true});
  } else {
    removeEventListener("beforeunload", beforeUnloadListener, {capture: true});
  }
}); */
</script>
