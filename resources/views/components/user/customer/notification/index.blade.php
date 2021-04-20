<div class="bg-white shadow rounded mt-4">
    <div class="bg-gray-50 rounded-t border-b p-4">
        <h1 class="text-sm uppercase font-bold">Notifications</h1>
    </div>

    <div class="overflow-y-auto max-h-96">
        <div class="flex flex-col items-start justify-center">
            @forelse(auth()->user()->notifications as $notification)
            @if($notification->type == "App\Notifications\OrderNotification")
            <a href="{{ route(Str::lower(auth()->user()->role).'.viewOrderDetails', $notification->data['user']['order_id']) }}"
                class="text-gray-700 p-4 border-b w-full hover:bg-yellow-100 hover:shadow {{ (is_null($notification->read_at) ? 'bg-blue-50': '') }}">
                @if($notification->data['user']['isShipped'])
                    Your order <span class="font-bold">{{ $notification->data['user']['order_id'] }}</span> has been shipped on {{ date("F j, Y, g:i a", strtotime($notification->data['user']['updated_at'])) }}.
                @elseif($notification->data['user']['isDelivered'])
                    Your order <span class="font-bold">{{ $notification->data['user']['order_id'] }}</span> has been delivered on {{ date("F j, Y, g:i a", strtotime($notification->data['user']['updated_at'])) }}.
                @endif
            </a>
            @endif
            @if($notification->type == "App\Notifications\AuthenticationProviderNotification")
            <a href="{{ route(Str::lower(auth()->user()->role).'.profile') }}"
                class="text-gray-700 p-4 border-b w-full hover:bg-yellow-100 hover:shadow {{ (is_null($notification->read_at) ? 'bg-blue-50': '') }}">
                Your generated Current Password is <span class="font-semibold">"{{ $notification->data['generatedPassword'] }}"</span>. Change your password now in your Profile Page.
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
