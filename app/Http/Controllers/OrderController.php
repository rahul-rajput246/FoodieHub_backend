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

    $total = 0;

    foreach ($cartItems as $item) {
        if ($item->food) {
            $total += $item->food->food_price * $item->quantity;
        }
    }

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

        $total = 0;

        foreach ($cart as $item) {
            $food = FoodItems::find($item['id']);

            if ($food) {
                $total += $food->food_price * $item['qty'];
            }
        }

        $order = Order::create([
            'user_id' => Auth::id(),
            'address_id' => $address->id,
            'order_number' => 'ORD-' . date('Y') . '-' . strtoupper(uniqid()),
            'total_amount' => $total,
            'status' => 'Confirmed',
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
    $total = 0;

    foreach ($cart as $item) {
        $food = FoodItems::find($item['id']);

        if ($food) {
            $total += $food->food_price * $item['qty'];
        }
    }

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

    return response()->json([
        'success' => true,
        'message' => 'Payment verified successfully',
        'order_id' => $order->id,
    ]);
}
}