<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use App\Mail\AdminContactNotificationMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class ContactMessageController extends Controller
{
    /**
     * API: Receive and store contact form message from frontend
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:150',
            'phone' => 'nullable|string|max:30',
            'message' => 'required|string|min:5|max:3000',
        ]);

        $contactMessage = ContactMessage::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
            'message' => $validated['message'],
            'status' => 'unread',
            'ip_address' => $request->ip(),
        ]);

        // Attempt to send email alert to admin
        try {
            $adminEmail = config('mail.from.address') ?: env('MAIL_USERNAME');
            if ($adminEmail) {
                Mail::to($adminEmail)->send(new AdminContactNotificationMail($contactMessage));
            }
        } catch (\Throwable $e) {
            Log::error('Failed to send admin contact notification: ' . $e->getMessage());
        }

        return response()->json([
            'success' => true,
            'message' => 'Thank you for reaching out! Your message has been sent successfully. We will get back to you shortly.',
            'data' => [
                'id' => $contactMessage->id,
            ],
        ], 201);
    }

    /**
     * Admin: List all contact messages
     */
    public function index(Request $request)
    {
        $status = $request->query('status');

        $query = ContactMessage::latest();

        if ($status && in_array($status, ['unread', 'read', 'replied'])) {
            $query->where('status', $status);
        }

        $messages = $query->paginate(15);
        $totalCount = ContactMessage::count();
        $unreadCount = ContactMessage::where('status', 'unread')->count();

        return view('admin.messages.index', compact('messages', 'totalCount', 'unreadCount', 'status'));
    }

    /**
     * Admin: View specific contact message details
     */
    public function show($id)
    {
        $message = ContactMessage::findOrFail($id);

        // Auto mark as read if currently unread
        if ($message->status === 'unread') {
            $message->update(['status' => 'read']);
        }

        return view('admin.messages.show', compact('message'));
    }

    /**
     * Admin: Update message status (unread, read, replied)
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:unread,read,replied',
        ]);

        $message = ContactMessage::findOrFail($id);
        $message->update(['status' => $request->status]);

        return back()->with('success', 'Message status updated to ' . ucfirst($request->status));
    }

    /**
     * Admin: Delete a contact message
     */
    public function destroy($id)
    {
        $message = ContactMessage::findOrFail($id);
        $message->delete();

        return redirect()->route('admin.messages.index')->with('success', 'Message deleted successfully.');
    }
}
