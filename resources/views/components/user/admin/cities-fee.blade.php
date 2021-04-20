<x-main.validation-message />
<div class="py-2 md:p-4">
    <div class="shadow border rounded">
        <div class="bg-gray-50 text-gray-700 text-sm font-bold uppercase rounded-t px-4 py-2 border-b">
            <p>Cities Fee</p>
        </div>
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 p-4">
            <div class="col-span-1 lg:col-span-2">
                <div class="border rounded p-2 overflow-auto">
                    <table id="citiesFeeTable" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Date Created</th>
                                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">City</th>
                                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Fee</th>
                                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach( $cities as $data)
                                <tr>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ date("F j, Y, g:i a", strtotime($data->updated_at)) }}</td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $data->city }}</td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $pesoSign ." ". number_format($data->shipping_fee, 2) }}</td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        <div class="flex items-center space-x-2">
                                            <div x-data="dropdown()">
                                                <button @click.prevent="open()" class="bg-green-600 hover:bg-green-500 text-green-100 focus:outline-none focus:ring-2 focus:ring-green-400 rounded px-4 py-2 font-semibold uppercase">
                                                    Edit
                                                </button>
                                                <div x-show="isOpen()" @click.away="close()" class="fixed flex items-center justify-center bg-gray-900 bg-opacity-50 min-w-full min-h-screen top-0 left-0">
                                                    <div class="bg-white shadow rounded -mt-56 w-2/6" @click.away="close()">
                                                        <div class="flex items-center justify-between bg-gray-50 border-b rounded-t px-4 py-2">
                                                            <p class="text-gray-700 text-sm font-bold uppercase">Update Form</p>
                                                            <div @click.prevent="close()">
                                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-6 text-red-600 hover:text-red-500 cursor-pointer">
                                                                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                                                </svg>
                                                            </div>
                                                        </div>
                                                        <form action="{{ route(Str::lower(auth()->user()->role).'.city.updateCity', $data->id) }}" method="POST">
                                                            @csrf
                                                            @method("PUT")
                                                            <div class="flex flex-col items-center justify-center space-y-4 p-4">
                                                                <input type="text" name="city" placeholder="City" value="{{ $data->city }}" class="w-full rounded" required>
                                                                <input type="number" name="fee" placeholder="Fee" value="{{ $data->shipping_fee }}" class="w-full rounded" required>
                                                                <div class="flex items-center justify-end w-full">
                                                                    <button type="submit" class="bg-yellow-900 hover:bg-yellow-800 text-yellow-100 focus:outline-none focus:ring-2 focus:ring-yellow-700 px-4 py-2 rounded">
                                                                        Submit
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <form action="{{ route(Str::lower(auth()->user()->role).'.city.deleteCity', $data->id) }}" method="POST">
                                                @csrf
                                                @method("DELETE")
                                                <button onclick="return confirm('Are you sure you want to delete this city?')" class="bg-red-600 hover:bg-red-500 text-red-100 focus:outline-none focus:ring-2 focus:ring-red-400 rounded px-4 py-2 font-semibold uppercase">
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-span-1">
                <div class="bg-gray-50 rounded shadow border">
                    <div class="bg-gray-100 border-b rounded-t px-4 py-2">
                        <p class="text-gray-700 font-bold uppercase text-sm">Add New City</p>
                    </div>
                    <form id="cityForm" action="{{ route(Str::lower(auth()->user()->role).'.city.addNewCity') }}" method="POST">
                        <div class="flex flex-col items-center justify-center space-y-4 p-4">
                            @csrf
                            <input type="text" name="city" id="city" placeholder="City" class="w-full rounded" required>
                            <input type="number" name="fee" id="fee" placeholder="Fee" class="w-full rounded" required>
                            <div class="flex items-center justify-end w-full">
                                <button type="submit" class="bg-yellow-900 hover:bg-yellow-800 text-yellow-100 focus:outline-none focus:ring-2 focus:ring-yellow-700 px-4 py-2 rounded">
                                    Submit
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
$(document).ready(function(){
    const city = $("#city");
    const fee = $("#fee");
    const _token = $("input[name=_token]");

    $("#citiesFeeTable").DataTable();

    /* $("#cityForm").on("submit", function(e){
        e.preventDefault();

        $.ajax({
            'url': $(this).attr("action"),
            'type': "POST",
            'data':{
                '_token': _token,
                'city': city,
                'fee': fee,
            },
            success:function(response){
                console.log(response);
            }
        });

    }); */
});
</script>
