<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Shipping;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class ShippingController extends Controller
{
    public function getOrdersToPack() //Lấy đơn hàng để đóng gói
    {
        try {
            $orders = Order::with('orderItems.product')
                ->where('status', 'ordered')
                ->get();

            $orders = $orders->map(function ($order) {
                $order->makeHidden(['subtotal', 'discount', 'tax', 'total', 'user_id', 'phone', 'name']); //ẩn thông tin không cần thiết
                return $order;
            });

            return response()->json([
                'success' => true,
                'message' => 'Orders to pack retrieved successfully',
                'data' => $orders
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve orders',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    // public function getOtherOrders()
    // {
    //     try {
    //         $orders = Order::with('orderItems.product', 'shipping')
    //             ->where('status', '!=', 'ordered')
    //             ->get();

    //         // Ẩn thông tin không cần thiết
    //         $orders = $orders->map(function ($order) {
    //             $order->makeHidden(['subtotal', 'discount', 'tax', 'total', 'user_id', 'phone', 'name']);
    //             return $order;
    //         });

    //         return response()->json([
    //             'success' => true,
    //             'message' => 'Other orders retrieved successfully',
    //             'data' => $orders
    //         ], 200);
    //     } catch (\Exception $e) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Failed to retrieve orders',
    //             'error' => $e->getMessage()
    //         ], 500);
    //     }
    // }

    public function getOtherOrders()
    {
        try {
            $user = Auth::user(); // Lấy user hiện tại
            $shippings = Shipping::with(['order.orderItems.product']) // Tải quan hệ order và orderItems
                ->whereHas('order', function ($query) use ($user) {
                    $query->where('user_id', $user->id); // Lọc theo user_id từ bảng Order
                })
                ->get();

            // Map dữ liệu để giữ cấu trúc tương tự như trước
            $orders = $shippings->map(function ($shipping) {
                $order = $shipping->order;
                return (object) [
                    'id' => $order->id,
                    'status' => $order->status,
                    'address' => $order->address,
                    'city' => $order->city,
                    'orderItems' => $order->orderItems,
                    'shipping' => (object) [
                        'note' => $shipping->note,
                        'beforePackingImage' => $shipping->before_packing_image,
                        'afterPackingImage' => $shipping->after_packing_image,
                        'packingTime' => $shipping->packing_time,
                    ],
                ];
            });

            // Ẩn thông tin không cần thiết từ orderItems nếu cần
            $orders = $orders->map(function ($order) {
                $order->makeHidden(['subtotal', 'discount', 'tax', 'total', 'user_id', 'phone', 'name']);
                return $order;
            });

            return response()->json([
                'success' => true,
                'message' => 'Other orders retrieved successfully',
                'data' => $orders
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve orders',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function show($orderId)
    {
        try {
            $order = Order::with('orderItems.product')->find($orderId);

            if (!$order || $order->status !== 'ordered') {
                return response()->json([
                    'success' => false,
                    'message' => 'Order not found or not in ordered status'
                ], 404);
            }

            // Ẩn thông tin không cần thiết
            $order->makeHidden(['subtotal', 'discount', 'tax', 'total', 'user_id', 'phone', 'name']);

            return response()->json([
                'success' => true,
                'message' => 'Order retrieved successfully',
                'data' => $order
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve order',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function confirmPacking(Request $request, $orderId)
    {
        $validator = Validator::make($request->all(), [
            'note' => 'nullable|string|max:255',
            'before_packing_image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'after_packing_image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation errors',
                'errors' => $validator->errors()
            ], 422);
        }

        $order = Order::find($orderId);
        if (!$order || $order->status !== 'ordered') {
            return response()->json([
                'success' => false,
                'message' => 'Order not found or not in ordered status'
            ], 404);
        }

        if (!$request->hasFile('before_packing_image') || !$request->hasFile('after_packing_image')) {
            return response()->json([
                'success' => false,
                'message' => 'Missing required images'
            ], 400);
        }

        try {
            // Tạo public_id duy nhất
            $beforeUniqueId = Str::uuid()->toString();
            $afterUniqueId = Str::uuid()->toString();

            // Upload ảnh lên Cloudinary
            $beforeUrl = $request->file('before_packing_image')
                ->storeOnCloudinaryAs('clothingstore/shipping/before', "before_packing_{$orderId}_{$beforeUniqueId}")
                ->getSecurePath();

            $afterUrl = $request->file('after_packing_image')
                ->storeOnCloudinaryAs('clothingstore/shipping/after', "after_packing_{$orderId}_{$afterUniqueId}")
                ->getSecurePath();

            // Lưu thông tin đóng gói
            $shipping = Shipping::create([
                'order_id' => $orderId,
                'note' => $request->note,
                'before_packing_image' => $beforeUrl,
                'after_packing_image' => $afterUrl,
                'packing_time' => Carbon::now(),
            ]);

            $order->status = 'waiting';
            $order->save();

            return response()->json([
                'success' => true,
                'message' => 'Order packed successfully',
                'data' => $shipping
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to confirm packing',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function cancelOrder(Request $request, $orderId)
    {
        try {
            $order = Order::find($orderId);
            if (!$order || $order->status !== 'ordered') {
                return response()->json([
                    'success' => false,
                    'message' => 'Order not found or not in ordered status'
                ], 404);
            }

            $order->status = 'canceled';
            $order->save();

            return response()->json([
                'success' => true,
                'message' => 'Order canceled successfully'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to cancel order',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
