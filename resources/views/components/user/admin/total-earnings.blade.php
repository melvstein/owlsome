<div class="py-2 md:p-4">
    <div class="bg-white rounded shadow">
        <div class="bg-gray-50 rounded-t p-4">
            <p class="text-gray-700 uppercase text-sm font-bold">Earned History</p>
        </div>
        <div class="p-2 overflow-auto">
            <table id="earnedHistoryTable" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Delivered Date</th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Order Id</th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Shipping Fee</th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Subtotal Amount</th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Total Earned</th>
                        {{-- <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Action</th> --}}
                    </tr>
                </thead>
                <tbody>
                    @foreach ($totalEarnings as $data)
                        <tr>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ date("F j, Y, g:i a", strtotime($data->created_at)) }}</td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                <a href="{{ route(Str::lower(auth()->user()->role).'.order.customerOrderView', $data->order_id) }}" class="text-green-600 hover:text-green-500">
                                    {{ $data->order_id }}
                                </a>
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                {{ $pesoSign ." ". number_format($data->shipping_fee, 2) }}
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                <p class="flex items-center justify-end">{{ $pesoSign ." ". number_format($data->amount, 2) }}</p>
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                <p class="text-green-600 flex items-center justify-end">{{ $pesoSign ." ". number_format($data->earned, 2) }}</p>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="bg-gray-50 rounded-b text-right p-4">
            <p class="text-lg">Total Earnings: <span class="text-green-600"><i class="fa fa-ruble"></i> {{ number_format($totalEarned, 2) }}</span></p>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#earnedHistoryTable').DataTable( {
            dom: 'Bfrtip',
            buttons: [
                'copyHtml5',
                'excelHtml5',
                'csvHtml5',
                'pdfHtml5'
            ],
            responsive: true
        } );
    } );
</script>
