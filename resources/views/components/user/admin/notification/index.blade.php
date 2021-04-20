<div class="py-4 md:p-4 space-y-4">
    <div class="bg-white shadow rounded">
        <div class="bg-gray-50 rounded-t border-b">
            <h1 class="text-gray-700 uppercase text-sm p-4 font-bold">Your Notifications</h1>
        </div>
        <div class="overflow-y-auto max-h-96">
            <div class="flex flex-col items-start justify-center">
                @forelse($adminNotifications as $notification)
                @if($notification->type == "App\Notifications\OrderNotification")
                <a href="{{ route(Str::lower(auth()->user()->role).'.order.customerOrderView', $notification->data['user']['order_id']) }}"
                    class="text-gray-700 p-4 border-b w-full hover:bg-yellow-100 hover:shadow {{ (is_null($notification->read_at) ? 'bg-blue-50': '') }}">
                    Order <span class="font-bold">{{ $notification->data['user']['order_id'] }}</span> has been delivered on {{ date("F j, Y, g:i a", strtotime($notification->data['user']['updated_at'])) }}.
                </a>
                @elseif($notification->type == "App\Notifications\CustomerOrderNotification")
                    <a href="{{ route(Str::lower(auth()->user()->role).'.order.customerOrderView', $notification->data['details']['order_id']) }}"
                        class="text-gray-700 p-4 border-b w-full hover:bg-yellow-100 hover:shadow {{ (is_null($notification->read_at) ? 'bg-blue-50': '') }}">
                        <span class="font-bold">{{ (empty($notification->data['details']['firstName']) && empty($notification->data['details']['lastName'])) ? $notification->data['details']['name'] : $notification->data['details']['firstName'] ." ". $notification->data['details']['lastName'] }} :</span>
                        has a new order with order id
                        <span class="font-semibold">{{ $notification->data['details']['order_id'] }}</span> on {{ date("F j, Y, g:i a", strtotime($notification->data['details']['updated_at'])) }}.
                    </a>
                @endif
                @empty
                <div class="flex items-center justify-center p-4 w-full">
                    <p>You don't have any notifications yet.</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>

    <div class="bg-white shadow rounded">
        <div class="bg-gray-50 rounded-t border-b">
            <h1 class="text-gray-700 uppercase text-sm p-4 font-bold"><span class="text-sm bg-gray-300 px-2 py-1 rounded-full border">{{ $notifications->count() }}</span> All Users Notifications</h1>
        </div>
        <div class="overflow-y-auto max-h-96">
            <div class="flex flex-col items-start justify-center">
                @forelse($notifications as $notification)
                @if($notification->type == "App\Notifications\OrderNotification")
                <a href="{{ route(Str::lower(auth()->user()->role).'.order.customerOrderView', $notification->data['user']['order_id']) }}"
                    class="text-gray-700 p-4 border-b w-full hover:bg-yellow-100 hover:shadow {{ (is_null($notification->read_at) ? 'bg-blue-50': '') }}">
                    <p>
                        <span class="font-bold">
                            {{ (empty($notification->data['user']['firstName']) && empty($notification->data['user']['lastName'])) ? $notification->data['user']['name'] : $notification->data['user']['firstName'] ." ". $notification->data['user']['lastName'] }}'s Order :
                        </span>
                        @if($notification->data['user']['isShipped'])
                                <span class="font-semibold">{{ $notification->data['user']['order_id'] }}</span> has been shipped on {{ date("F j, Y, g:i a", strtotime($notification->data['user']['updated_at'])) }}.
                        @elseif($notification->data['user']['isDelivered'])
                                <span class="font-semibold">{{ $notification->data['user']['order_id'] }}</span> has been delivered on {{ date("F j, Y, g:i a", strtotime($notification->data['user']['updated_at'])) }}.
                        @endif
                    </p>
                </a>
                @endif
                @if($notification->type == "App\Notifications\AuthenticationProviderNotification")
                <a href="javascript:void(0)"
                    class="text-gray-700 p-4 border-b w-full hover:bg-yellow-100 hover:shadow {{ (is_null($notification->read_at) ? 'bg-blue-50': '') }}">
                    <span class="font-bold">
                        {{ (empty($notification->data['user']['firstName']) && empty($notification->data['user']['lastName'])) ? $notification->data['user']['name'] : $notification->data['user']['firstName'] ." ". $notification->data['user']['lastName'] }}'s account :
                    </span>
                    generated Current Password is <span class="font-semibold">"{{ $notification->data['generatedPassword'] }}"</span>. Change your password now in your Profile Page.
                </a>
                @endif
                @empty
                <div class="flex items-center justify-center p-4 w-full">
                    <p>0 notifications!</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

