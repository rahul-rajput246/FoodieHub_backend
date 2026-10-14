<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;   
use App\Models\User;
use App\Models\OrderItem;
use App\Models\FoodItems;
use App\Models\UserAddress;
use Illuminate\Support\Facades\Auth;
use Razorpay\Api\Api;
use Illuminate\Support\Facades\DB;
use App\Models\CartItem;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderSuccessMail;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('items.food', 'address')
        ->where('user_id', Auth::id())
        ->latest()
        ->paginate(10);

        return view('user.orders', compact('orders'));
    }

    public function show($id)
    {
        $order = Order::with('items.food', 'address')
        ->where('user_id', Auth::id())
        ->where('id', $id)
        ->firstOrFail();

        return view('user.orderDetails', compact('order'));
    }

 public function store(Request $request)
{
    $cartItems = CartItem::with('food')
        ->where('user_id', Auth::id())
        ->get();
        

    if ($cartItems->isEmpty()) {
        return back()->with('error', 'Cart is empty');
    }

    $address = UserAddress::where('user_id', Auth::id())->latest()->first();

    if (!$address) {
        return back()->with('error', 'Please add an address before placing an order.');
    }

    $subtotal = 0;

    foreach ($cartItems as $item) {
        if ($item->food) {
            $subtotal += $item->food->food_price * $item->quantity;
        }
    }

    $deliveryFee = $subtotal > 499 ? 0 : 40;
    $discount = $subtotal > 999 ? 100 : 0;
    $total = max(0, $subtotal + $deliveryFee - $discount);

    $order = Order::create([
        'user_id' => Auth::id(),
        'address_id' => $address->id,
        'order_number' => 'ORD-' . date('Y') . '-' . strtoupper(uniqid()),
        'total_amount' => $total,
        'status' => 'confirmed',
        'payment_method' => 'cod',
        'payment_status' => 'pending',
        'notes' => null,
    ]);

    foreach ($cartItems as $item) {
        if (!$item->food) {
            continue;
        }

        OrderItem::create([
            'order_id' => $order->id,
            'food_item_id' => $item->food->id,
            'food_name' => $item->food->food_name,
            'price' => $item->food->food_price,
            'quantity' => $item->quantity,
            'subtotal' => $item->food->food_price * $item->quantity,
        ]);
    }

    CartItem::where('user_id', Auth::id())->delete();

    // Send order confirmation & invoice email
    $this->sendOrderSuccessMail($order);

    return redirect()->route('orders.index')->with('success', 'Order placed successfully.');
}


   public function storeApi(Request $request)
    {
        $request->validate([
            'address_id' => 'required|exists:user_addresses,id',
            'payment_method' => 'required|in:cod',
            'cart' => 'required|array|min:1',
            'cart.*.id' => 'required|exists:foodItems,id',
            'cart.*.qty' => 'required|integer|min:1',
            'notes' => 'nullable|string',
        ]);

        $address = UserAddress::where('id', $request->address_id)
            ->where('user_id', Auth::id())
            ->first();

        if (!$address) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid address selected'
            ], 422);
        }

        $cart = $request->cart;

        if (!$cart || count($cart) == 0) {
            return response()->json([
                'success' => false,
                'message' => 'Cart is empty'
            ], 422);
        }

        $subtotal = 0;

        foreach ($cart as $item) {
            $food = FoodItems::find($item['id']);

            if ($food) {
                $subtotal += $food->food_price * $item['qty'];
            }
        }

        $deliveryFee = $subtotal > 499 ? 0 : 40;
        $discount = $subtotal > 999 ? 100 : 0;
        $total = max(0, $subtotal + $deliveryFee - $discount);

        $order = Order::create([
            'user_id' => Auth::id(),
            'address_id' => $address->id,
            'order_number' => 'ORD-' . date('Y') . '-' . strtoupper(uniqid()),
            'total_amount' => $total,
            'status' => 'confirmed',
            'payment_method' => $request->payment_method,
            'payment_status' => 'pending',
            'notes' => $request->notes,
        ]);

        foreach ($cart as $item) {
            $food = FoodItems::find($item['id']);

            if (!$food) {
                continue;
            }

            OrderItem::create([
                'order_id' => $order->id,
                'food_item_id' => $food->id,
                'food_name' => $food->food_name,
                'price' => $food->food_price,
                'quantity' => $item['qty'],
                'subtotal' => $food->food_price * $item['qty'],
            ]);
        }

        CartItem::where('user_id', Auth::id())->delete();

        // Send order confirmation & invoice email
        $this->sendOrderSuccessMail($order);

        return response()->json([
            'success' => true,
            'order_id' => $order->id,
            'message' => 'Order placed successfully'
        ]);
    }

    // Admin Order Management

    public function adminIndex()
    {
        $orders = Order::with('items.food', 'address', 'user')
            ->latest()
            ->get();

        return view('admin.orders.index', compact('orders'));
    }

    public function adminShow($id)
    {
        $order = Order::with('items.food', 'address', 'user')
            ->where('id', $id)
            ->firstOrFail();

        return view('admin.orders.show', compact('order'));
    }

    public function updateStatus(Request $request, $id)
   
    {
        $request->validate([
            'status' => 'required|in:pending,confirmed,preparing,out_for_delivery,delivered,cancelled',
            'payment_status' => 'required|in:pending,paid,failed',
        ]);

        $order = Order::findOrFail($id);

        $order->status = $request->status;
        $order->payment_status = $request->payment_status;
        $order->save();

        return redirect()->route('admin.orders.show', $order->id)
            ->with('success', 'Order status updated successfully');
    }

    // Admin Pending Orders

    public function pendingOrders(){
        $orders = Order::with('items.food', 'address', 'user')
            ->where('status', 'pending')
            ->latest()
            ->get();

        return view('admin.orders.pending_orders' , compact('orders'));
    }

    // Admin Completed Orders

    public function completedOrders(){
        $orders = Order::with('items.food' , 'address' , 'user')
            ->where('status', 'delivered')
            ->latest()
            ->get();

        return view('admin.orders.completed_orders' , compact('orders'));
    }

    // Admin Cancelled Orders

    public function cancelledOrders()
    {
        $orders = Order::with('items.food', 'address', 'user')
            ->where('status', 'cancelled')
            ->latest()
            ->get();

        return view('admin.orders.cancelled_orders', compact('orders'));
    }

    // Razorpay Payment Integration

    public function createRazorpayOrder(Request $request)
{
    $request->validate([
        'address_id' => 'required|exists:user_addresses,id',
        'payment_method' => 'required|in:razorpay',
        'cart' => 'required|array|min:1',
        'cart.*.id' => 'required|exists:foodItems,id',
        'cart.*.qty' => 'required|integer|min:1',
        'notes' => 'nullable|string',
    ]);

    $address = UserAddress::where('id', $request->address_id)
        ->where('user_id', Auth::id())
        ->first();

    if (!$address) {
        return response()->json([
            'success' => false,
            'message' => 'Invalid address selected'
        ], 422);
    }

    $cart = $request->cart;
    $subtotal = 0;

    foreach ($cart as $item) {
        $food = FoodItems::find($item['id']);

        if ($food) {
            $subtotal += $food->food_price * $item['qty'];
        }
    }

    $deliveryFee = $subtotal > 499 ? 0 : 40;
    $discount = $subtotal > 999 ? 100 : 0;
    $total = max(0, $subtotal + $deliveryFee - $discount);

    DB::beginTransaction();

    try {
        $order = Order::create([
            'user_id' => Auth::id(),
            'address_id' => $address->id,
            'order_number' => 'ORD-' . date('Y') . '-' . strtoupper(uniqid()),
            'total_amount' => $total,
            'status' => 'confirmed',
            'payment_method' => 'razorpay',
            'payment_status' => 'pending',
            'notes' => $request->notes,
        ]);

        foreach ($cart as $item) {
            $food = FoodItems::find($item['id']);

            if (!$food) {
                continue;
            }

            OrderItem::create([
                'order_id' => $order->id,
                'food_item_id' => $food->id,
                'food_name' => $food->food_name,
                'price' => $food->food_price,
                'quantity' => $item['qty'],
                'subtotal' => $food->food_price * $item['qty'],
            ]);
        }

        $api = new Api(config('services.razorpay.key'), config('services.razorpay.secret'));

        $razorpayOrder = $api->order->create([
            'receipt' => 'receipt_' . $order->id,
            'amount' => (int) round($total * 100),
            'currency' => 'INR',
        ]);

        $order->update([
            'razorpay_order_id' => $razorpayOrder['id'],
        ]);

        DB::commit();

        return response()->json([
            'success' => true,
            'key' => config('services.razorpay.key'),
            'amount' => (int) round($total * 100),
            'currency' => 'INR',
            'razorpay_order_id' => $razorpayOrder['id'],
            'local_order_id' => $order->id,
            'customer_name' => Auth::user()->name,
            'customer_email' => Auth::user()->email,
            'customer_contact' => $address->phone ?? '',
        ]);
    } catch (\Exception $e) {
        DB::rollBack();

        return response()->json([
            'success' => false,
            'message' => $e->getMessage(),
        ], 500);
    }
}



// Verify Razorpay Payment

public function verifyRazorpayPayment(Request $request)
{
    $request->validate([
        'local_order_id' => 'required|exists:orders,id',
        'razorpay_order_id' => 'required|string',
        'razorpay_payment_id' => 'required|string',
        'razorpay_signature' => 'required|string',
    ]);

    $order = Order::where('id', $request->local_order_id)
        ->where('user_id', Auth::id())
        ->firstOrFail();

    if ($order->razorpay_order_id !== $request->razorpay_order_id) {
        return response()->json([
            'success' => false,
            'message' => 'Order ID mismatch'
        ], 422);
    }

    $generatedSignature = hash_hmac(
        'sha256',
        $request->razorpay_order_id . '|' . $request->razorpay_payment_id,
        config('services.razorpay.secret')
    );

    if ($generatedSignature !== $request->razorpay_signature) {
        return response()->json([
            'success' => false,
            'message' => 'Payment verification failed'
        ], 422);
    }

    $order->update([
        'razorpay_payment_id' => $request->razorpay_payment_id,
        'razorpay_signature' => $request->razorpay_signature,
        'payment_status' => 'paid',
        'status' => 'confirmed',
    ]);

    CartItem::where('user_id', Auth::id())->delete();

    // Send order confirmation & invoice email
    $this->sendOrderSuccessMail($order);

    return response()->json([
        'success' => true,
        'message' => 'Payment verified successfully',
        'order_id' => $order->id,
    ]);
}

    /**
     * Calculate financial breakdown for invoices and receipts
     */
    protected function getOrderFinancials(Order $order): array
    {
        $calculatedSubtotal = 0;
        foreach ($order->items as $item) {
            $calculatedSubtotal += $item->subtotal;
        }

        $calculatedDeliveryFee = $calculatedSubtotal > 499 ? 0 : 40;
        $calculatedDiscount = $calculatedSubtotal > 999 ? 100 : 0;

        return [
            'calculatedSubtotal' => $calculatedSubtotal,
            'calculatedDeliveryFee' => $calculatedDeliveryFee,
            'calculatedDiscount' => $calculatedDiscount,
        ];
    }

    /**
     * Customer: Download PDF invoice
     */
    public function downloadInvoice($id)
    {
        $order = Order::with('items.food', 'address', 'user')
            ->where('id', $id);

        if (!Auth::user()->hasRole('admin')) {
            $order = $order->where('user_id', Auth::id());
        }

        $order = $order->firstOrFail();
        $financials = $this->getOrderFinancials($order);

        $pdf = Pdf::loadView('invoices.order-pdf', array_merge(['order' => $order], $financials));
        $pdf->setPaper('a4', 'portrait');

        return $pdf->download('FoodieHub-Invoice-' . $order->order_number . '.pdf');
    }

    /**
     * Customer: View/Print thermal POS receipt
     */
    public function printReceipt($id)
    {
        $order = Order::with('items.food', 'address', 'user')
            ->where('id', $id);

        if (!Auth::user()->hasRole('admin')) {
            $order = $order->where('user_id', Auth::id());
        }

        $order = $order->firstOrFail();
        $financials = $this->getOrderFinancials($order);

        return view('invoices.order-receipt', array_merge(['order' => $order], $financials));
    }

    /**
     * Admin: Download PDF invoice for any order
     */
    public function adminDownloadInvoice($id)
    {
        $order = Order::with('items.food', 'address', 'user')
            ->where('id', $id)
            ->firstOrFail();

        $financials = $this->getOrderFinancials($order);

        $pdf = Pdf::loadView('invoices.order-pdf', array_merge(['order' => $order], $financials));
        $pdf->setPaper('a4', 'portrait');

        return $pdf->download('FoodieHub-Invoice-' . $order->order_number . '.pdf');
    }

    /**
     * Admin: View/Print POS thermal receipt for kitchen or counter
     */
    public function adminPrintReceipt($id)
    {
        $order = Order::with('items.food', 'address', 'user')
            ->where('id', $id)
            ->firstOrFail();

        $financials = $this->getOrderFinancials($order);

        return view('invoices.order-receipt', array_merge(['order' => $order], $financials));
    }

    /**
     * Send order confirmation and PDF invoice email
     */
    protected function sendOrderSuccessMail(Order $order): void
    {
        try {
            $order->loadMissing('items.food', 'address', 'user');

            $recipientEmail = $order->user->email ?? null;

            if (!$recipientEmail) {
                return;
            }

            $financials = $this->getOrderFinancials($order);

            Mail::to($recipientEmail)->send(new OrderSuccessMail(
                $order,
                $financials['calculatedSubtotal'],
                $financials['calculatedDeliveryFee'],
                $financials['calculatedDiscount']
            ));
        } catch (\Throwable $e) {
            \Log::error('Order confirmation email failed: ' . $e->getMessage());
        }
    }

    /**
     * Admin: Manually trigger/resend confirmation & invoice email
     */
    public function resendOrderMail($id)
    {
        $order = Order::with('items.food', 'address', 'user')->findOrFail($id);

        $recipientEmail = $order->user->email ?? null;

        if (!$recipientEmail) {
            return back()->with('error', 'User has no email address associated with this order.');
        }

        $financials = $this->getOrderFinancials($order);

        try {
            Mail::to($recipientEmail)->send(new OrderSuccessMail(
                $order,
                $financials['calculatedSubtotal'],
                $financials['calculatedDeliveryFee'],
                $financials['calculatedDiscount']
            ));

            return back()->with('success', 'Confirmation & invoice email has been sent successfully to ' . $recipientEmail);
        } catch (\Throwable $e) {
            return back()->with('error', 'Failed to send email: ' . $e->getMessage());
        }
    }

    /**
     * API: Live order tracking data for customers
     */
    public function getTrackingDetails($id)
    {
        $order = Order::with('items.food', 'address', 'user')
            ->where(function ($query) use ($id) {
                if (is_numeric($id)) {
                    $query->where('id', $id)->orWhere('order_number', $id);
                } else {
                    $query->where('order_number', $id);
                }
            })
            ->first();

        if (!$order) {
            return response()->json([
                'success' => false,
                'message' => 'Order not found with provided ID or Order Number.',
            ], 404);
        }

        $statusMap = [
            'pending' => 1,
            'confirmed' => 2,
            'preparing' => 3,
            'out_for_delivery' => 4,
            'delivered' => 5,
            'cancelled' => 0,
        ];

        $currentStep = $statusMap[$order->status] ?? 1;

        $placedTime = $order->created_at->format('h:i A');
        $confirmedTime = $order->created_at->addMinutes(2)->format('h:i A');
        $preparingTime = $order->created_at->addMinutes(8)->format('h:i A');
        $outForDeliveryTime = $order->created_at->addMinutes(20)->format('h:i A');
        $deliveredTime = $order->created_at->addMinutes(35)->format('h:i A');

        $steps = [
            [
                'step' => 1,
                'key' => 'pending',
                'title' => 'Order Placed',
                'description' => 'We received your order and sent it to our kitchen.',
                'icon' => '📝',
                'completed' => $currentStep >= 1 && $order->status !== 'cancelled',
                'current' => $currentStep === 1,
                'time' => $placedTime,
            ],
            [
                'step' => 2,
                'key' => 'confirmed',
                'title' => 'Order Confirmed',
                'description' => 'Kitchen has accepted and queued your order.',
                'icon' => '✅',
                'completed' => $currentStep >= 2 && $order->status !== 'cancelled',
                'current' => $currentStep === 2,
                'time' => $currentStep >= 2 ? $confirmedTime : 'Est ' . $confirmedTime,
            ],
            [
                'step' => 3,
                'key' => 'preparing',
                'title' => 'Preparing Food',
                'description' => 'Our master chef is cooking your meal fresh.',
                'icon' => '🍳',
                'completed' => $currentStep >= 3 && $order->status !== 'cancelled',
                'current' => $currentStep === 3,
                'time' => $currentStep >= 3 ? $preparingTime : 'Est ' . $preparingTime,
            ],
            [
                'step' => 4,
                'key' => 'out_for_delivery',
                'title' => 'Out for Delivery',
                'description' => 'Delivery rider is on the way with your hot meal.',
                'icon' => '🛵',
                'completed' => $currentStep >= 4 && $order->status !== 'cancelled',
                'current' => $currentStep === 4,
                'time' => $currentStep >= 4 ? $outForDeliveryTime : 'Est ' . $outForDeliveryTime,
            ],
            [
                'step' => 5,
                'key' => 'delivered',
                'title' => 'Delivered',
                'description' => 'Order delivered at your doorstep. Enjoy your meal!',
                'icon' => '🎉',
                'completed' => $currentStep >= 5 && $order->status !== 'cancelled',
                'current' => $currentStep === 5,
                'time' => $currentStep >= 5 ? $deliveredTime : 'Est ' . $deliveredTime,
            ],
        ];

        $statusMessages = [
            'pending' => 'Waiting for kitchen confirmation...',
            'confirmed' => 'Kitchen accepted your order! Preparation starting shortly.',
            'preparing' => 'Chef is preparing your fresh meal right now!',
            'out_for_delivery' => 'Your rider is on the road heading to your address.',
            'delivered' => 'Your order has been delivered! Bon appétit!',
            'cancelled' => 'This order was cancelled.',
        ];

        $etaMap = [
            'pending' => '30–35 Mins',
            'confirmed' => '25–30 Mins',
            'preparing' => '15–20 Mins',
            'out_for_delivery' => '5–10 Mins',
            'delivered' => 'Delivered',
            'cancelled' => 'Cancelled',
        ];

        $progressPercentages = [
            'pending' => 10,
            'confirmed' => 25,
            'preparing' => 55,
            'out_for_delivery' => 85,
            'delivered' => 100,
            'cancelled' => 0,
        ];

        $deliveryPartner = null;
        if (in_array($order->status, ['preparing', 'out_for_delivery', 'delivered'])) {
            $deliveryPartner = [
                'name' => 'Amit Sharma',
                'phone' => '+91 98765 43210',
                'rating' => '4.9 ★',
                'vehicle' => 'Electric Scooter (MH-02-EE-1234)',
                'deliveries' => '1,420+ delivered',
            ];
        }

        return response()->json([
            'success' => true,
            'order' => [
                'id' => $order->id,
                'order_number' => $order->order_number,
                'status' => $order->status,
                'status_label' => ucfirst(str_replace('_', ' ', $order->status)),
                'status_message' => $statusMessages[$order->status] ?? 'Processing order...',
                'current_step' => $currentStep,
                'total_steps' => 5,
                'progress_percentage' => $progressPercentages[$order->status] ?? 20,
                'is_cancelled' => $order->status === 'cancelled',
                'estimated_delivery' => $etaMap[$order->status] ?? '25–30 Mins',
                'payment_method' => strtoupper($order->payment_method ?? 'COD'),
                'payment_status' => ucfirst($order->payment_status ?? 'pending'),
                'total_amount' => (float) $order->total_amount,
                'created_at' => $order->created_at->format('d M Y, h:i A'),
                'updated_at' => $order->updated_at->format('d M Y, h:i A'),
                'delivery_partner' => $deliveryPartner,
                'address' => $order->address ? [
                    'full_name' => $order->address->full_name,
                    'mobile' => $order->address->mobile,
                    'address_line' => $order->address->address_line,
                    'city' => $order->address->city,
                    'state' => $order->address->state,
                    'pincode' => $order->address->pincode,
                    'landmark' => $order->address->landmark,
                ] : null,
                'items' => $order->items->map(function ($item) {
                    return [
                        'id' => $item->id,
                        'food_name' => $item->food_name,
                        'quantity' => $item->quantity,
                        'price' => (float) $item->price,
                        'subtotal' => (float) $item->subtotal,
                    ];
                }),
                'steps' => $steps,
            ],
        ]);
    }
}