@extends('layouts.allAdmin')

@section('content')

<div class="main_allfood_container">

    <div class="pages_header allfood_header">
        <div>
            <p class="dashboard_small_text">Customer Inquiry</p>
            <h1>Message Details</h1>
            <p class="pages_desc">
                Received from {{ $message->name }} on {{ $message->created_at->format('d M Y, h:i A') }}
            </p>
        </div>

        <div style="display: flex; gap: 10px; flex-wrap: wrap; align-items: center;">
            <button type="button" class="create_food_btn" style="background: #2563eb; border: none; cursor: pointer; display: inline-flex; align-items: center; gap: 6px;" onclick="openReplyModal()">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                    <polyline points="22,6 12,13 2,6"></polyline>
                </svg>
                Reply via Email
            </button>
            <a href="https://mail.google.com/mail/?view=cm&fs=1&to={{ urlencode($message->email) }}&su={{ urlencode('Re: Your Inquiry at FoodieHub') }}&body={{ urlencode("Hello " . $message->name . ",\n\nThank you for reaching out to FoodieHub!\n\nRegarding your message:\n\"" . \Illuminate\Support\Str::limit($message->message, 120) . "\"\n\n") }}" target="_blank" rel="noopener noreferrer" class="create_food_btn" style="background: #ea4335; display: inline-flex; align-items: center; gap: 6px;">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"></circle>
                    <line x1="2" y1="12" x2="22" y2="12"></line>
                    <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path>
                </svg>
                Open in Gmail
            </a>
            @if(!empty($message->phone))
            <a href="tel:{{ $message->phone }}" class="create_food_btn" style="background: #059669; display: inline-flex; align-items: center; gap: 6px;">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                </svg>
                Call Customer
            </a>
            @endif
            <a href="{{ route('admin.messages.index') }}" class="create_food_btn" style="background: #374151;">
                ← Back to Inquiries
            </a>
        </div>
    </div>

    @if(session('success'))
        <div style="margin-bottom:20px; padding:12px 16px; background:#d1fae5; color:#065f46; border-radius:12px; font-weight: 500; display: flex; align-items: center; gap: 8px;">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#059669" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="20 6 9 17 4 12"></polyline>
            </svg>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    @if(session('error'))
        <div style="margin-bottom:20px; padding:12px 16px; background:#fee2e2; color:#991b1b; border-radius:12px; font-weight: 500; display: flex; align-items: center; gap: 8px;">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#dc2626" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="10"></circle>
                <line x1="12" y1="8" x2="12" y2="12"></line>
                <line x1="12" y1="16" x2="12.01" y2="16"></line>
            </svg>
            <span>{{ session('error') }}</span>
        </div>
    @endif

    <div class="order_info_grid">
        
        {{-- Sender Information --}}
        <div class="allfood_table_box">
            <div class="box_title_row">
                <h3>Customer Information</h3>
            </div>

            <div class="contact_det">
                <p><b>Name:</b> {{ $message->name }}</p>
                <p><b>Email:</b> <a href="mailto:{{ $message->email }}" style="color: #ff7e00; text-decoration: none;">{{ $message->email }}</a></p>
                <p><b>Phone:</b> {{ $message->phone ?? 'Not provided' }}</p>
                <p><b>Received On:</b> {{ $message->created_at->format('d M Y, h:i A') }} ({{ $message->created_at->diffForHumans() }})</p>
                <p><b>IP Address:</b> {{ $message->ip_address ?? 'N/A' }}</p>
            </div>
        </div>

        {{-- Status & Quick Actions --}}
        <div class="allfood_table_box">
            <div class="box_title_row">
                <h3>Update Inquiry Status</h3>
            </div>

            <div style="padding: 20px 0;">
                <form action="{{ route('admin.messages.status', $message->id) }}" method="POST">
                    @csrf
                    <div style="display: flex; flex-direction: column; gap: 10px; margin-bottom: 20px;">
                        <label for="status" style="font-weight: 600; font-size: 14px; color: #374151;">Current Status</label>
                        <select name="status" id="status" class="custom_select">
                            <option value="unread" {{ $message->status == 'unread' ? 'selected' : '' }}>Unread</option>
                            <option value="read" {{ $message->status == 'read' ? 'selected' : '' }}>Read</option>
                            <option value="replied" {{ $message->status == 'replied' ? 'selected' : '' }}>Replied</option>
                        </select>
                    </div>

                    <button type="submit" class="create_food_btn" style="border:none; cursor:pointer;">
                        Update Status
                    </button>
                </form>

                <div style="margin-top: 25px; padding-top: 15px; border-top: 1px solid #f3f4f6;">
                    <form action="{{ route('admin.messages.destroy', $message->id) }}" method="POST" onsubmit="return confirm('Permanently delete this inquiry?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" style="background: none; border: none; color: #dc2626; font-size: 13px; font-weight: 600; cursor: pointer; padding: 0; display: inline-flex; align-items: center; gap: 5px;">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="3 6 5 6 21 6"></polyline>
                                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                            </svg>
                            Delete This Inquiry
                        </button>
                    </form>
                </div>
            </div>
        </div>

    </div>

    {{-- Message Body --}}
    <div class="allfood_table_box" style="margin-bottom: 30px;">
        <div class="box_title_row" style="display: flex; justify-content: space-between; align-items: center;">
            <h3>Message Content</h3>
            <span style="font-size: 12px; background: #f3f4f6; padding: 4px 10px; border-radius: 20px; color: #4b5563;">
                {{ strlen($message->message) }} characters
            </span>
        </div>

        <div style="padding: 24px 0; font-size: 15px; line-height: 1.8; color: #1f2937; white-space: pre-line;">
            {{ $message->message }}
        </div>
    </div>

    {{-- Built-in Reply Email Composer (In-page) --}}
    <div class="allfood_table_box" id="reply-section" style="margin-bottom: 30px; border: 2px solid #e0e7ff; background: #ffffff;">
        <div class="box_title_row" style="display: flex; justify-content: space-between; align-items: center;">
            <div style="display: flex; align-items: center; gap: 8px;">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#2563eb" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                    <polyline points="22,6 12,13 2,6"></polyline>
                </svg>
                <h3 style="margin: 0; color: #1e3a8a;">Send Email Reply to Customer</h3>
            </div>
            <span style="font-size: 12px; font-weight: 600; color: #2563eb; background: #eff6ff; padding: 4px 12px; border-radius: 20px;">
                Direct Delivery via FoodieHub Mail
            </span>
        </div>

        <div style="padding: 24px 0;">
            <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 10px; padding: 14px 18px; margin-bottom: 20px; font-size: 13px; color: #475569; display: flex; flex-direction: column; gap: 6px;">
                <div><b>From:</b> FoodieHub Support &lt;{{ config('mail.from.address') }}&gt;</div>
                <div><b>To:</b> {{ $message->name }} &lt;{{ $message->email }}&gt;</div>
            </div>

            {{-- Quick Templates --}}
            <div style="margin-bottom: 18px;">
                <span style="font-size: 12px; font-weight: 600; color: #64748b; margin-right: 8px;">Quick Reply Templates:</span>
                <div style="display: inline-flex; gap: 8px; flex-wrap: wrap; margin-top: 6px;">
                    <button type="button" onclick="setTemplate('thankyou')" style="background: #f1f5f9; border: 1px solid #cbd5e1; border-radius: 6px; padding: 5px 10px; font-size: 12px; cursor: pointer; color: #334155; display: inline-flex; align-items: center; gap: 4px;">
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 9V5a3 3 0 0 0-3-3l-4 9v11h11.28a2 2 0 0 0 2-1.7l1.38-9a2 2 0 0 0-2-2.3zM7 22H4a2 2 0 0 1-2-2v-7a2 2 0 0 1 2-2h3"></path></svg>
                        Thank You
                    </button>
                    <button type="button" onclick="setTemplate('table')" style="background: #f1f5f9; border: 1px solid #cbd5e1; border-radius: 6px; padding: 5px 10px; font-size: 12px; cursor: pointer; color: #334155; display: inline-flex; align-items: center; gap: 4px;">
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 2v20"></path><path d="M22 2v6a4 4 0 0 1-4 4v10"></path><path d="M6 2v7a3 3 0 0 1-3 3v8h6v-8a3 3 0 0 1-3-3V2"></path></svg>
                        Table / Reservation
                    </button>
                    <button type="button" onclick="setTemplate('moreinfo')" style="background: #f1f5f9; border: 1px solid #cbd5e1; border-radius: 6px; padding: 5px 10px; font-size: 12px; cursor: pointer; color: #334155; display: inline-flex; align-items: center; gap: 4px;">
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12.01" y2="8"></line></svg>
                        Need More Info
                    </button>
                </div>
            </div>

            <form action="{{ route('admin.messages.reply', $message->id) }}" method="POST" id="replyForm" onsubmit="handleReplySubmit()">
                @csrf

                <div style="margin-bottom: 16px;">
                    <label for="subject" style="display: block; font-size: 13px; font-weight: 600; color: #374151; margin-bottom: 6px;">
                        Email Subject
                    </label>
                    <input type="text" name="subject" id="subject" class="custom_select" style="width: 100%; box-sizing: border-box;" value="Re: Your Inquiry at FoodieHub" required>
                </div>

                <div style="margin-bottom: 20px;">
                    <label for="reply_message" style="display: block; font-size: 13px; font-weight: 600; color: #374151; margin-bottom: 6px;">
                        Your Reply Message
                    </label>
                    <textarea name="reply_message" id="reply_message" rows="6" style="width: 100%; box-sizing: border-box; padding: 12px 14px; border: 1px solid #d1d5db; border-radius: 10px; font-family: inherit; font-size: 14px; line-height: 1.6; resize: vertical;" placeholder="Type your response to {{ $message->name }} here..." required>Hello {{ $message->name }},

Thank you for contacting FoodieHub! 

</textarea>
                </div>

                <div style="display: flex; gap: 12px; align-items: center; flex-wrap: wrap;">
                    <button type="submit" id="replySubmitBtn" class="create_food_btn" style="background: #2563eb; border: none; cursor: pointer; font-size: 14px; display: inline-flex; align-items: center; gap: 8px;">
                        <span id="replyBtnText">🚀 Send Email Reply</span>
                    </button>

                    <a href="https://mail.google.com/mail/?view=cm&fs=1&to={{ urlencode($message->email) }}&su={{ urlencode('Re: Your Inquiry at FoodieHub') }}" target="_blank" rel="noopener noreferrer" style="font-size: 13px; color: #4b5563; text-decoration: underline; margin-left: 6px;">
                        Or open draft in Gmail Web →
                    </a>
                </div>
            </form>
        </div>
    </div>

    @include('components.usable.footer')

</div>

<!-- Pop-up Reply Modal -->
<div id="replyModal" style="display: none; position: fixed; inset: 0; background: rgba(15, 23, 42, 0.65); backdrop-filter: blur(4px); z-index: 99999; align-items: center; justify-content: center; padding: 20px;" onclick="handleBackdropClick(event)">
    <div style="background: #ffffff; border-radius: 16px; width: 100%; max-width: 620px; box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25); overflow: hidden; animation: popIn 0.2s cubic-bezier(0.16, 1, 0.3, 1);">
        
        <!-- Modal Header -->
        <div style="background: #1e293b; color: #ffffff; padding: 18px 24px; display: flex; align-items: center; justify-content: space-between;">
            <div style="display: flex; align-items: center; gap: 10px;">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#60a5fa" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                    <polyline points="22,6 12,13 2,6"></polyline>
                </svg>
                <div>
                    <h3 style="margin: 0; font-size: 17px; font-weight: 700; color: #ffffff;">Reply to {{ $message->name }}</h3>
                    <p style="margin: 2px 0 0; font-size: 12px; color: #94a3b8;">Recipient: {{ $message->email }}</p>
                </div>
            </div>
            <button type="button" onclick="closeReplyModal()" style="background: rgba(255,255,255,0.1); border: none; color: #ffffff; width: 32px; height: 32px; border-radius: 50%; cursor: pointer; font-size: 16px; display: flex; align-items: center; justify-content: center;">
                ✕
            </button>
        </div>

        <!-- Modal Body Form -->
        <form action="{{ route('admin.messages.reply', $message->id) }}" method="POST" id="modalReplyForm" onsubmit="handleModalReplySubmit()" style="padding: 24px;">
            @csrf

            <!-- Quick Template Chips -->
            <div style="margin-bottom: 16px;">
                <label style="display: block; font-size: 12px; font-weight: 600; color: #64748b; margin-bottom: 6px;">Quick Templates:</label>
                <div style="display: flex; gap: 8px; flex-wrap: wrap;">
                    <button type="button" onclick="setModalTemplate('thankyou')" style="background: #f1f5f9; border: 1px solid #cbd5e1; border-radius: 6px; padding: 5px 10px; font-size: 12px; cursor: pointer; color: #334155; display: inline-flex; align-items: center; gap: 4px;">
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 9V5a3 3 0 0 0-3-3l-4 9v11h11.28a2 2 0 0 0 2-1.7l1.38-9a2 2 0 0 0-2-2.3zM7 22H4a2 2 0 0 1-2-2v-7a2 2 0 0 1 2-2h3"></path></svg>
                        Thank You
                    </button>
                    <button type="button" onclick="setModalTemplate('table')" style="background: #f1f5f9; border: 1px solid #cbd5e1; border-radius: 6px; padding: 5px 10px; font-size: 12px; cursor: pointer; color: #334155; display: inline-flex; align-items: center; gap: 4px;">
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 2v20"></path><path d="M22 2v6a4 4 0 0 1-4 4v10"></path><path d="M6 2v7a3 3 0 0 1-3 3v8h6v-8a3 3 0 0 1-3-3V2"></path></svg>
                        Table Reservation
                    </button>
                    <button type="button" onclick="setModalTemplate('moreinfo')" style="background: #f1f5f9; border: 1px solid #cbd5e1; border-radius: 6px; padding: 5px 10px; font-size: 12px; cursor: pointer; color: #334155; display: inline-flex; align-items: center; gap: 4px;">
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12.01" y2="8"></line></svg>
                        Need More Details
                    </button>
                </div>
            </div>

            <!-- Subject -->
            <div style="margin-bottom: 14px;">
                <label for="modal_subject" style="display: block; font-size: 13px; font-weight: 600; color: #374151; margin-bottom: 6px;">
                    Email Subject
                </label>
                <input type="text" name="subject" id="modal_subject" class="custom_select" style="width: 100%; box-sizing: border-box;" value="Re: Your Inquiry at FoodieHub" required>
            </div>

            <!-- Message Body -->
            <div style="margin-bottom: 20px;">
                <label for="modal_reply_message" style="display: block; font-size: 13px; font-weight: 600; color: #374151; margin-bottom: 6px;">
                    Your Message
                </label>
                <textarea name="reply_message" id="modal_reply_message" rows="6" style="width: 100%; box-sizing: border-box; padding: 12px 14px; border: 1px solid #d1d5db; border-radius: 10px; font-family: inherit; font-size: 14px; line-height: 1.6; resize: vertical;" placeholder="Type your response to {{ $message->name }}..." required>Hello {{ $message->name }},

Thank you for reaching out to FoodieHub! 

</textarea>
            </div>

            <!-- Action Buttons -->
            <div style="display: flex; gap: 12px; align-items: center; justify-content: flex-end; flex-wrap: wrap; padding-top: 14px; border-top: 1px solid #f1f5f9;">
                <a href="https://mail.google.com/mail/?view=cm&fs=1&to={{ urlencode($message->email) }}&su={{ urlencode('Re: Your Inquiry at FoodieHub') }}" target="_blank" rel="noopener noreferrer" style="font-size: 13px; color: #ea4335; text-decoration: underline; margin-right: auto;">
                    🌐 Open in Gmail Web
                </a>
                <button type="button" onclick="closeReplyModal()" style="background: #f3f4f6; border: 1px solid #e5e7eb; color: #4b5563; padding: 10px 18px; border-radius: 8px; font-size: 14px; font-weight: 500; cursor: pointer;">
                    Cancel
                </button>
                <button type="submit" id="modalSubmitBtn" class="create_food_btn" style="background: #2563eb; border: none; cursor: pointer; font-size: 14px; margin: 0;">
                    <span id="modalSubmitText">🚀 Send Email Now</span>
                </button>
            </div>
        </form>

    </div>
</div>

<script>
    function openReplyModal() {
        const modal = document.getElementById('replyModal');
        modal.style.display = 'flex';
        document.getElementById('modal_reply_message').focus();
    }

    function closeReplyModal() {
        const modal = document.getElementById('replyModal');
        modal.style.display = 'none';
    }

    function handleBackdropClick(e) {
        if (e.target.id === 'replyModal') {
            closeReplyModal();
        }
    }

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeReplyModal();
        }
    });

    function setModalTemplate(type) {
        const textarea = document.getElementById('modal_reply_message');
        const customerName = "{{ addslashes($message->name) }}";

        if (type === 'thankyou') {
            textarea.value = `Hello ${customerName},\n\nThank you for reaching out to us at FoodieHub!\n\nWe have received your message and appreciate your feedback. If you have any further questions or requests, please let us know.\n\nWarm regards,\nFoodieHub Support Team`;
        } else if (type === 'table') {
            textarea.value = `Hello ${customerName},\n\nThank you for contacting FoodieHub regarding table reservations.\n\nWe would be delighted to host you! Could you please confirm the preferred date, time, and number of guests so we can prepare your table?\n\nWarm regards,\nFoodieHub Reservations`;
        } else if (type === 'moreinfo') {
            textarea.value = `Hello ${customerName},\n\nThank you for reaching out to FoodieHub.\n\nCould you please share a few more details regarding your inquiry (such as order ID or specific menu item) so our team can assist you as quickly as possible?\n\nWarm regards,\nFoodieHub Support Team`;
        }
        textarea.focus();
    }

    function setTemplate(type) {
        const textarea = document.getElementById('reply_message');
        const customerName = "{{ addslashes($message->name) }}";

        if (type === 'thankyou') {
            textarea.value = `Hello ${customerName},\n\nThank you for reaching out to us at FoodieHub!\n\nWe have received your message and appreciate your feedback. If you have any further questions or requests, please let us know.\n\nWarm regards,\nFoodieHub Support Team`;
        } else if (type === 'table') {
            textarea.value = `Hello ${customerName},\n\nThank you for contacting FoodieHub regarding table reservations.\n\nWe would be delighted to host you! Could you please confirm the preferred date, time, and number of guests so we can prepare your table?\n\nWarm regards,\nFoodieHub Reservations`;
        } else if (type === 'moreinfo') {
            textarea.value = `Hello ${customerName},\n\nThank you for reaching out to FoodieHub.\n\nCould you please share a few more details regarding your inquiry (such as order ID or specific menu item) so our team can assist you as quickly as possible?\n\nWarm regards,\nFoodieHub Support Team`;
        }
        textarea.focus();
    }

    function handleModalReplySubmit() {
        const btn = document.getElementById('modalSubmitBtn');
        const text = document.getElementById('modalSubmitText');
        btn.disabled = true;
        btn.style.opacity = '0.7';
        btn.style.cursor = 'not-allowed';
        text.innerText = '⏳ Sending Email...';
        return true;
    }

    function handleReplySubmit() {
        const btn = document.getElementById('replySubmitBtn');
        const text = document.getElementById('replyBtnText');
        btn.disabled = true;
        btn.style.opacity = '0.7';
        btn.style.cursor = 'not-allowed';
        text.innerText = '⏳ Sending Email...';
        return true;
    }
</script>

@endsection
