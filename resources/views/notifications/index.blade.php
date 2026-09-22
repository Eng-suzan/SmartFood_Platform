
<x-app-layout>

    <style>
        .notifications-page {
            max-width: 900px;
            margin: 0 auto;
            padding: 50px 25px;
        }

        .notifications-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .notifications-header h1 {
            font-size: 30px;
            font-weight: 700;
        }

        .read-all-btn {
            text-decoration: none;
            background: #111;
            color: white;
            padding: 10px 18px;
            border-radius: 10px;
        }

        .notification-card {
            display: block;
            text-decoration: none;
            color: inherit;
            background: white;
            border: 1px solid #eee;
            border-radius: 16px;
            padding: 18px 20px;
            margin-bottom: 12px;
            transition: 0.2s;
        }

        .notification-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(0,0,0,0.06);
        }

        .notification-card.unread {
            border-left: 4px solid #111;
            background: #fafafa;
        }

        .notification-top {
            display: flex;
            justify-content: space-between;
            gap: 15px;
        }

        .notification-message {
            font-size: 16px;
            font-weight: 600;
        }

        .notification-time {
            color: #888;
            font-size: 13px;
            white-space: nowrap;
        }

        .empty-notifications {
            text-align: center;
            padding: 70px 20px;
            color: #888;
        }
    </style>

    <div class="notifications-page">

        <div class="notifications-header">

            <h1>🔔 Notifications</h1>

            @if(auth()->user()->unreadNotifications->count())
                <a href="{{ route('notifications.readAll') }}"
                   class="read-all-btn">
                    Mark all as read
                </a>
            @endif

        </div>

        @forelse($notifications as $notification)

            <a href="{{ route('notifications.read', $notification->id) }}"
               class="notification-card {{ is_null($notification->read_at) ? 'unread' : '' }}">

                <div class="notification-top">

                    <div class="notification-message">
                        {{ $notification->data['message'] ?? 'You have a new notification.' }}
                    </div>

                    <div class="notification-time">
                        {{ $notification->created_at->diffForHumans() }}
                    </div>

                </div>

                @if(isset($notification->data['order_id']))
                    <div style="margin-top: 8px; color: #777;">
                        Order #{{ $notification->data['order_id'] }}
                    </div>
                @endif

            </a>

        @empty

            <div class="empty-notifications">
                <div style="font-size: 45px;">🔔</div>
                <h2>No notifications yet</h2>
                <p>You'll see your order updates here.</p>
            </div>

        @endforelse

    </div>

</x-app-layout>

