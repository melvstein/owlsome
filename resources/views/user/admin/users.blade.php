<x-main.app>
    @section('title', 'Users - '.$business->name)
    <x-user.admin.sidebar />
    <x-user.admin.content>
        <div class="py-2 md:p-4">
            <x-main.validation-message />
            <div class="bg-white rounded shadow">
                <div class="px-4 py-2 bg-gray-50 rounded-t">
                    <h3 class="text-sm font-semibold uppercase text-gray-600">User List</h3>
                </div>
                    <div class="shadow p-2 overflow-auto">
                        <table id="userList" class="display" style="width:100%">
                            <thead>
                                <tr>
                                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">UID</th>
                                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Role</th>
                                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Name</th>
                                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Contact Number</th>
                                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Email</th>
                                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">DCreated</th>
                                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">DUpdated</th>
                                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Online Status</th>
                                    {{-- <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Last Seen</th> --}}
                                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Active Status</th>
                                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $user->accountId }}</td>
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $user->role }}</td>
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                            <div class="flex items-center">
                                                @if($user->profile_photo_path)
                                                    <img src="{{ asset('storage/' . $user->profile_photo_path) }}" class="w-8 h-8 rounded-full mr-2" alt="User Profile">
                                                @else
                                                    <img src="{{ asset('storage/user/user_default_photo.png') }}" class="w-8 h-8 rounded-full mr-2" alt="User Profile">
                                                @endif
                                                <a href="{{ route('admin.user.details', $user->id) }}" class="text-blue-600 hover:text-blue-500">
                                                    @if(empty($user->firstName) && empty($user->lastName))
                                                        {{ $user->name }}
                                                    @else
                                                        {{ $user->firstName ." ". Str::substr($user->middleName, 0, 1) .". ". $user->lastName }}
                                                    @endif
                                                </a>
                                            </div>
                                        </td>
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $user->contactNumber }}</td>
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $user->email }}</td>
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $user->created_at }}</td>
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $user->updated_at }}</td>
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                            <span id="status_{{ $user->id }}">
                                            @if(Cache::has('user-is-online-' . $user->id))
                                                <span class="text-gray-600">Status:</span> <span class="text-green-600">Online</span>
                                                <br/>
                                                @if($user->last_seen != null)
                                                    <span class="text-gray-600">Last Seen:</span> <span class="text-green-600">Active {{ \Carbon\Carbon::parse($user->last_seen)->diffForHumans() }}</span>
                                                @else
                                                <span class="text-gray-600">Last Seen:</span> <span class="text-green-600">No Data</span>
                                                @endif
                                            @else
                                                <span class="text-gray-600">Status:</span> <span class="text-yellow-600">Offline</span>
                                                <br/>
                                                @if($user->last_seen != null)
                                                    <span class="text-gray-600">Last Seen:</span> <span class="text-yellow-600">Active {{ \Carbon\Carbon::parse($user->last_seen)->diffForHumans() }}</span>
                                                @else
                                                <span class="text-gray-600">Last Seen:</span> <span class="text-yellow-600">No Data</span>
                                                @endif
                                            @endif
                                            </span>
                                            <script>
                                                window.setInterval(function(){
                                                    $.ajax({
                                                        url: "live-status/{{ $user->id }}",
                                                        method: 'GET',
                                                        success: function (result) {
                                                            /* console.log(result); */
                                                            if(result.status == "Online")
                                                            {
                                                                $('#status_{{$user->id}}').html(`Status: <span class='text-green-600'>${result.status}</span><br/><span class="text-gray-600">Last Seen: </span> <span class="text-green-600">${result.last_seen}</span>`);
                                                            }else{
                                                                $('#status_{{$user->id}}').html(`Status: <span class='text-yellow-600'>${result.status}</span><br/><span class="text-gray-600">Last Seen: </span> <span class="text-yellow-600">${result.last_seen}</span>`);
                                                            }
                                                        }
                                                    });
                                                }, 10000); // call every 10 seconds
                                            </script>
                                            {{-- @if(Cache::has('user-is-online-' . $user->id))
                                                <span class="text-green-600">Online</span>
                                            @else
                                                <span class="text-gray-600">Offline</span>
                                            @endif --}}
                                        </td>
                                        {{-- <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                            @if($user->last_seen != null)
                                                {{ \Carbon\Carbon::parse($user->last_seen)->diffForHumans() }}
                                            @else
                                                No data
                                            @endif
                                        </td> --}}
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                            {{-- <span class="px-4 py-1 rounded-full font-semibold {{ ($user->status == 'Active') ? 'bg-green-200 text-green-900' : 'bg-red-200 text-red-900' }}">{{ $user->status }}</span> --}}
                                            <form action="{{ route('admin.user.activation',['id' => $user->id]) }}" method="POST">
                                                @csrf
                                                @method("PUT")
                                                @if($user->id == 1)
                                                    <span class="px-4 py-1 border rounded-full font-semibold bg-green-600 text-green-100 hover:bg-green-500 cursor-not-allowed">isActivated</span>
                                                @else
                                                    @if($user->status == "Active")
                                                        <button type="submit" onclick="return confirm('Are you sure you want to deactivate this user?')" class="px-4 py-1 border rounded-full font-semibold bg-green-600 text-green-100 hover:bg-green-500 focus:outline-none">
                                                            isActivated
                                                        </button>
                                                    @else
                                                        <button type="submit" onclick="return confirm('Are you sure you want to activate this user?')" class="px-4 py-1 border rounded-full font-semibold bg-red-600 text-red-100 hover:bg-red-500 focus:outline-none">
                                                            isDeactivated
                                                        </button>
                                                    @endif
                                                @endif
                                            </form>
                                        </td>
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                            @if($user->id == 1)
                                                {{-- <button class="px-4 py-2 border border-red-600 rounded text-red-600 hover:text-red-500" title="Can't delete super admin user!" disabled>Deactivate</button> --}}
                                                <button type="submit" class="px-4 py-2 border bg-red-600 bg-opacity-50 rounded text-white hover:bg-red-500 hover:bg-opacity-50 cursor-not-allowed" title="Can't delete super admin user!" disabled>
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            @elseif($user->id !== 1 && $user->id === auth()->user()->id)
                                                <button type="submit" class="px-4 py-2 border bg-red-600 bg-opacity-50 rounded text-white hover:bg-red-500 hover:bg-opacity-50 cursor-not-allowed" title="Can't delete your own account!" disabled>
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            @else
                                                <form action="{{ route('admin.user.delete',['id' => $user->id]) }}" method="POST">
                                                    @csrf
                                                    @method("DELETE")
                                                    <button type="submit" onclick="return confirm('Are you sure you want to delete this user?')" class="px-4 py-2 border bg-red-600 rounded text-white hover:bg-red-500">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
            </div>
        </div>
    </x-user.admin.content>
<script>
$(document).ready(function(){
    $('#userList').DataTable( /* {
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ],
        responsive: true
    }  */);
});
</script>
</x-main.app>
