<div class="py-2 md:p-4">
    <x-main.validation-message />
    <div class="bg-white rounded shadow">
        <div class="px-4 py-2 bg-gray-50 rounded-t flex items-center justify-between">
            <h3 class="text-sm font-semibold uppercase text-gray-600">Order List</h3>
            <a href="{{ route('admin.order.list') }}" title="Back" class="text-yellow-900 hover:text-yellow-700">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-6">
                    <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                </svg>
            </a>
        </div>
        <div class="shadow p-2 overflow-auto">
            <table id="orderList" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Created_at</th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Order ID</th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">No. of Items</th>
                        {{-- <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Action</th> --}}
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orderDates as $data)
                        <tr>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ date("F j, Y, g:i a", strtotime($data->created_at)) }}</td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                <a href="{{ route(Str::lower(auth()->user()->role).'.order.customerOrderView', $data->order_id) }}" class="text-blue-600 hover:text-blue-400">
                                    {{ $data->order_id }}
                                </a>
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $data->numberOfItems }}</td>
                            {{-- <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                <div class="flex items-center justify-items-center space-x-2">
                                    @if($data->isCheckout)
                                        <button class="bg-blue-600 px-4 py-2 rounded text-white uppercase font-semibold text-xs flex-shrink-0">
                                            Ship Now
                                        </button>
                                    @else
                                        <button class="bg-green-600 px-4 py-2 rounded text-white uppercase font-semibold text-xs">
                                            Delivered
                                        </button>
                                    @endif
                                </div>
                            </td> --}}
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
$(document).ready(function() {

/* $('#orderList').DataTable({
        responsive: true
    }); */

});
</script>
