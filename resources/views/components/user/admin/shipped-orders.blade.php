<div class="py-2 md:p-4">
    <div class="bg-white rounded shadow">
        <div class="bg-gray-50 rounded-t px-4 py-2">
            <p class="text-sm uppercase font-bold text-gray-700 tracking-wide antialiased">Shipped Orders List</p>
        </div>
        <div class="shadow p-2 overflow-auto">
            <table id="shippedList" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Shipped Date</th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Order ID</th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">No. of Items</th>
                        {{-- <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Action</th> --}}
                    </tr>
                </thead>
                <tbody>
                    @foreach ($shippedOrders as $data)
                        <tr>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ date("F j, Y, g:i a", strtotime($data->updated_at)) }}</td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                <a href="{{ route(Str::lower(auth()->user()->role).'.order.customerOrderView', $data->order_id) }}" class="text-blue-600 hover:text-blue-400">
                                    {{ $data->order_id }}
                                </a>
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $data->numberOfItems }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        $('#shippedList').DataTable({
            responsive: true
        });
    });
    </script>
