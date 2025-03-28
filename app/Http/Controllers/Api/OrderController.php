<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    /**
     * Display a listing of the orders.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $orders = Order::with('user')->paginate(10);
            return response()->json([
                'success' => true,
                'message' => 'Orders retrieved successfully',
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

    /**
     * Store a newly created order in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'subtotal' => 'required|numeric|min:0',
            'discount' => 'nullable|numeric|min:0',
            'tax' => 'required|numeric|min:0',
            'total' => 'required|numeric|min:0',
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'locality' => 'required|string|max:255',
            'address' => 'required|string',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'landmark' => 'nullable|string|max:255',
            'zip' => 'required|string|max:20',
            'type' => 'nullable|string|max:50',
            'status' => 'nullable|in:ordered,delivered,canceled',
            'is_shipping_different' => 'nullable|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation errors',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $order = Order::create($request->all());
            return response()->json([
                'success' => true,
                'message' => 'Order created successfully',
                'data' => $order
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create order',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified order.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $order = Order::with('user')->find($id);
            
            if (!$order) {
                return response()->json([
                    'success' => false,
                    'message' => 'Order not found'
                ], 404);
            }

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

    /**
     * Update the specified order in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $order = Order::find($id);
        
        if (!$order) {
            return response()->json([
                'success' => false,
                'message' => 'Order not found'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'user_id' => 'sometimes|exists:users,id',
            'subtotal' => 'sometimes|numeric|min:0',
            'discount' => 'nullable|numeric|min:0',
            'tax' => 'sometimes|numeric|min:0',
            'total' => 'sometimes|numeric|min:0',
            'name' => 'sometimes|string|max:255',
            'phone' => 'sometimes|string|max:20',
            'locality' => 'sometimes|string|max:255',
            'address' => 'sometimes|string',
            'city' => 'sometimes|string|max:255',
            'state' => 'sometimes|string|max:255',
            'country' => 'sometimes|string|max:255',
            'landmark' => 'nullable|string|max:255',
            'zip' => 'sometimes|string|max:20',
            'type' => 'nullable|string|max:50',
            'status' => 'nullable|in:ordered,delivered,canceled',
            'is_shipping_different' => 'nullable|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation errors',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            // Handle status change dates
            if ($request->has('status')) {
                if ($request->status === 'delivered' && $order->status !== 'delivered') {
                    $request->merge(['delivered_date' => now()]);
                } elseif ($request->status === 'canceled' && $order->status !== 'canceled') {
                    $request->merge(['canceled_date' => now()]);
                }
            }

            $order->update($request->all());
            return response()->json([
                'success' => true,
                'message' => 'Order updated successfully',
                'data' => $order
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update order',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified order from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $order = Order::find($id);
            
            if (!$order) {
                return response()->json([
                    'success' => false,
                    'message' => 'Order not found'
                ], 404);
            }

            $order->delete();
            return response()->json([
                'success' => true,
                'message' => 'Order deleted successfully'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete order',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get orders by user ID
     *
     * @param  int  $userId
     * @return \Illuminate\Http\Response
     */
    public function getByUser($userId)
    {
        try {
            $orders = Order::where('user_id', $userId)->get();
            
            return response()->json([
                'success' => true,
                'message' => 'User orders retrieved successfully',
                'data' => $orders
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve user orders',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update order status
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateStatus(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'status' => 'required|in:ordered,delivered,canceled'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation errors',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $order = Order::find($id);
            
            if (!$order) {
                return response()->json([
                    'success' => false,
                    'message' => 'Order not found'
                ], 404);
            }

            $data = ['status' => $request->status];
            
            // Set delivered_date or canceled_date if status is changing to those values
            if ($request->status === 'delivered' && $order->status !== 'delivered') {
                $data['delivered_date'] = now();
            } elseif ($request->status === 'canceled' && $order->status !== 'canceled') {
                $data['canceled_date'] = now();
            }

            $order->update($data);
            
            return response()->json([
                'success' => true,
                'message' => 'Order status updated successfully',
                'data' => $order
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update order status',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}