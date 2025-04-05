<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Shipping;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

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

    public function getOtherOrders()
    {
        try {
            $orders = Order::with('orderItems.product', 'shipping')
                ->where('status', '!=', 'ordered')
                ->get();

            // Ẩn thông tin không cần thiết
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

        try {
            $order = Order::find($orderId);
            if (!$order || $order->status !== 'ordered') {
                return response()->json([
                    'success' => false,
                    'message' => 'Order not found or not in ordered status'
                ], 404);
            }

            // Upload ảnh lên Cloudinary
            $beforeImage = $request->file('before_packing_image')->storeOnCloudinary('clothingstore/shipping/before');
            $afterImage = $request->file('after_packing_image')->storeOnCloudinary('clothingstore/shipping/after');

            // Lưu thông tin đóng gói
            $shipping = Shipping::create([
                'order_id' => $orderId,
                'note' => $request->note,
                'before_packing_image' => $beforeImage->getSecurePath(),
                'after_packing_image' => $afterImage->getSecurePath(),
                'packing_time' => Carbon::now(),
            ]);

            // Cập nhật trạng thái đơn hàng
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
}
