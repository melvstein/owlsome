<div class="bg-white rounded shadow p-4">
    <h1 class="text-2xl font-semibold font-serif border-b-2 border-yellow-900 mb-4">View Order</h1>
    <div class="py-2">
        <h3 class="text-lg font-semibold mb-2">Customer: Melvin Justine Bayogo</h3>
        <p>Contact Number: 09560627650</p>
        <p>Email Address: melvinbayogo@gmail.com</p>
        <p>Address: Muntinlupa City</p>
        <h3 class="text-xl font-semibold">Total Amount: <span class="text-green-600"><i class="fas fa-ruble-sign"></i> 700.00</span></h3>
    </div>
        <div class="border rounded p-2 overflow-auto">
            <table id="orderTable" class="display compact cell-border responsive nowrap" style="width:100%">
                <thead>
                    <tr>
                        <th>Img</th>
                        <th>Order Id</th>
                        <th>Item Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Amount</th>
                        <th>Oncart Datetime</th>
                        <th>Received Datetime</th>
                        <th>Status</th>
                        <th>Action</th>
                </thead>
                <tbody>
                    <tr>
                        <td><img src="" class="w-24 h-24 bg-gray-400" alt=""></td>
                        <td>24055519</td>
                        <td>Coffee</td>
                        <td><i class="fas fa-ruble-sign"></i> 100.00</td>
                        <td>3</td>
                        <td><i class="fas fa-ruble-sign"></i> 300.00</td>
                        <td>February 11, 2021 12:30pm</td>
                        <td>February 12, 2021 8:25am</td>
                        <td>Oncart</td>
                        <td class="flex items-center justify-center">
                            <button class="bg-yellow-600 px-4 py-2 border rounded text-white">Ship out</button>
                            <button class="bg-green-600 px-4 py-2 border rounded text-white">Received</button>
                            <button class="bg-red-600 px-4 py-2 border rounded text-white">Cancelled</button>
                        </td>
                    </tr>
                    <tr>
                        <td><img src="" class="w-24 h-24 bg-gray-500" alt=""></td>
                        <td>24522419</td>
                        <td>Milk</td>
                        <td><i class="fas fa-ruble-sign"></i> 200.00</td>
                        <td>2</td>
                        <td><i class="fas fa-ruble-sign"></i> 400.00</td>
                        <td>February 11, 2021 12:30pm</td>
                        <td>February 12, 2021 8:25am</td>
                        <td>Oncart</td>
                        <td class="flex items-center justify-center">
                            <button class="bg-yellow-600 px-4 py-2 border rounded text-white">Ship out</button>
                            <button class="bg-green-600 px-4 py-2 border rounded text-white">Received</button>
                            <button class="bg-red-600 px-4 py-2 border rounded text-white">Cancelled</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
</div>
<script>
    $(document).ready(function() {
        $('#orderTable').DataTable( {
            responsive: true
        } );
    } );
</script>
