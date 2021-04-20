<div class="py-2 md:p-4">
    <div class="bg-white rounded shadow p-4">
        <h1 class="text-2xl font-semibold font-serif border-b-2 border-yellow-900 mb-4">Order History</h1>
        <div class="border rounded p-2 overflow-auto">
            <table id="orderHistoryTable" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Created Date</th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Order Id</th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">User</th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Status</th>
                        {{-- <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Action</th> --}}
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orderHistories as $data)
                        <tr>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ date("F j, Y, g:i a", strtotime($data->created_at)) }}</td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                @if($data->status == "Checkout")
                                    <a href="{{ route(Str::lower(auth()->user()->role).'.order.customerOrderView', $data->order_id) }}" class="text-yellow-600 hover:text-yellow-500">
                                        {{ $data->order_id }}
                                    </a>
                                @elseif($data->status == "Delivered")
                                    <a href="{{ route(Str::lower(auth()->user()->role).'.order.customerOrderView', $data->order_id) }}" class="text-green-600 hover:text-green-500">
                                        {{ $data->order_id }}
                                    </a>
                                @elseif($data->status == "On Shipping")
                                    <a href="{{ route(Str::lower(auth()->user()->role).'.order.customerOrderView', $data->order_id) }}" class="text-blue-600 hover:text-blue-500">
                                        {{ $data->order_id }}
                                    </a>
                                @else
                                <a href="javascript:void(0)" class="text-red-600 hover:text-red-500 cursor-not-allowed">
                                    {{ $data->order_id }}
                                </a>
                                @endif
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                <a href="{{ route('admin.user.details', $data->id) }}" class="text-blue-600 hover:text-blue-500">
                                    {{ $data->firstName ." ". $data->lastName }}
                                </a>
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                @if($data->status == "Checkout")
                                    <span class="text-yellow-100 bg-yellow-600 px-2 font-bold rounded-full text-center text-xs uppercase">{{ $data->status }}</span>
                                @elseif($data->status == "Delivered")
                                    <span class="text-green-100 bg-green-600 px-2 font-bold rounded-full text-center text-xs uppercase">{{ $data->status }}</span>
                                @elseif($data->status == "On Shipping")
                                    <span class="text-blue-100 bg-blue-600 px-2 font-bold rounded-full text-center text-xs uppercase">{{ $data->status }}</span>
                                @else
                                    <span class="text-red-100 bg-red-600 px-2 font-bold rounded-full text-center text-xs uppercase">{{ $data->status }}</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#orderHistoryTable').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copyHtml5',
                'excelHtml5',
                'csvHtml5',
                'pdfHtml5'
            ],
            responsive: true
        });
    });
</script>
