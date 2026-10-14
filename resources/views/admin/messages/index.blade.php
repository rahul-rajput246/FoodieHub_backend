@extends('layouts.allAdmin')

@section('content')

<div class="main_allfood_container">

    <div class="pages_header allfood_header">
        <div>
            <p class="dashboard_small_text">FoodieHub Admin</p>
            <h1>Customer Inquiries</h1>
            <p class="pages_desc">
                Review messages and inquiries sent by visitors and customers through the Contact Us form.
            </p>
        </div>

        <div>
            <a href="{{ route('admin.dashboard') }}" class="create_food_btn" style="background: #374151;">← Back to Dashboard</a>
        </div>
    </div>

    @if(session('success'))
        <div style="margin-bottom:20px; padding:12px 16px; background:#d1fae5; color:#065f46; border-radius:12px; font-weight: 500;">
            ✓ {{ session('success') }}
        </div>
    @endif

    <div class="pages_overview_cards">
        <div class="mini_overview_card">
            <h3>Total Inquiries</h3>
            <h2>{{ $totalCount }}</h2>
            <p>All-time submitted messages</p>
        </div>

        <div class="mini_overview_card">
            <h3>Unread Inquiries</h3>
            <h2 style="color: #ef4444;">{{ $unreadCount }}</h2>
            <p>Awaiting review</p>
        </div>

        <div class="mini_overview_card">
            <h3>Read / Handled</h3>
            <h2 style="color: #059669;">{{ $totalCount - $unreadCount }}</h2>
            <p>Reviewed or replied</p>
        </div>
    </div>

    <div class="allfood_table_box">
        <div class="box_title_row" style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 10px;">
            <h3>Message Inbox</h3>

            <div style="display: flex; gap: 8px;">
                <a href="{{ route('admin.messages.index') }}" 
                   style="padding: 6px 14px; border-radius: 8px; font-size: 13px; text-decoration: none; font-weight: 600; {{ !$status ? 'background: #ff7e00; color: #fff;' : 'background: #f3f4f6; color: #4b5563;' }}">
                    All
                </a>
                <a href="{{ route('admin.messages.index', ['status' => 'unread']) }}" 
                   style="padding: 6px 14px; border-radius: 8px; font-size: 13px; text-decoration: none; font-weight: 600; {{ $status == 'unread' ? 'background: #ef4444; color: #fff;' : 'background: #f3f4f6; color: #4b5563;' }}">
                    Unread ({{ $unreadCount }})
                </a>
                <a href="{{ route('admin.messages.index', ['status' => 'read']) }}" 
                   style="padding: 6px 14px; border-radius: 8px; font-size: 13px; text-decoration: none; font-weight: 600; {{ $status == 'read' ? 'background: #2563eb; color: #fff;' : 'background: #f3f4f6; color: #4b5563;' }}">
                    Read
                </a>
                <a href="{{ route('admin.messages.index', ['status' => 'replied']) }}" 
                   style="padding: 6px 14px; border-radius: 8px; font-size: 13px; text-decoration: none; font-weight: 600; {{ $status == 'replied' ? 'background: #059669; color: #fff;' : 'background: #f3f4f6; color: #4b5563;' }}">
                    Replied
                </a>
            </div>
        </div>

        @if($messages->count() > 0)
        <div class="dashboard_table_wrapper">
            <table class="dashboard_table allfood_table">
                <thead>
                    <tr>
                        <th style="width: 50px;">#</th>
                        <th>Sender</th>
                        <th>Email & Phone</th>
                        <th>Message Preview</th>
                        <th>Status</th>
                        <th>Received On</th>
                        <th style="text-align: right;">Action</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($messages as $msg)
                    <tr style="{{ $msg->status == 'unread' ? 'background-color: #fffbeb;' : '' }}">
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            <strong>{{ $msg->name }}</strong>
                        </td>
                        <td>
                            <div>{{ $msg->email }}</div>
                            @if($msg->phone)
                                <small style="color: #6b7280;">📞 {{ $msg->phone }}</small>
                            @endif
                        </td>
                        <td style="max-width: 280px; white-space: normal;">
                            <span style="color: #374151; font-size: 13px;">
                                {{ Str::limit($msg->message, 80) }}
                            </span>
                        </td>
                        <td>
                            @if($msg->status == 'unread')
                                <span style="background: #fee2e2; color: #991b1b; padding: 4px 10px; border-radius: 12px; font-size: 12px; font-weight: 700;">
                                    ● Unread
                                </span>
                            @elseif($msg->status == 'replied')
                                <span style="background: #d1fae5; color: #065f46; padding: 4px 10px; border-radius: 12px; font-size: 12px; font-weight: 700;">
                                    ✓ Replied
                                </span>
                            @else
                                <span style="background: #e0f2fe; color: #0369a1; padding: 4px 10px; border-radius: 12px; font-size: 12px; font-weight: 700;">
                                    Read
                                </span>
                            @endif
                        </td>
                        <td>
                            <span style="font-size: 12px; color: #6b7280;">{{ $msg->created_at->format('d M Y, h:i A') }}</span>
                        </td>
                        <td style="text-align: right;">
                            <div class="action_btn_group" style="justify-content: flex-end;">
                                <a href="{{ route('admin.messages.show', $msg->id) }}" class="action_btn edit_btn">
                                    View
                                </a>

                                <form action="{{ route('admin.messages.destroy', $msg->id) }}" method="POST" onsubmit="return confirm('Delete this message?');" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="action_btn delete_btn" style="border:none; cursor:pointer;">
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

        <div style="margin-top: 20px;">
            {{ $messages->links() }}
        </div>
        @else
        <div style="text-align: center; padding: 50px 20px;">
            <div style="font-size: 40px; margin-bottom: 12px;">📭</div>
            <h3 style="font-size: 18px; color: #111827; margin-bottom: 6px;">No inquiries found</h3>
            <p style="color: #6b7280; font-size: 14px;">There are no customer messages under this filter.</p>
        </div>
        @endif

    </div>

    @include('components.usable.footer')

</div>

@endsection
