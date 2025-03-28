<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrderItemController extends Controller
{
    /**
     * Display a listing of order items.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $orderItems = OrderItem::with(['product', 'order'])->paginate(10);
            return response()->json([
                'success' => true,
                'message' => 'Order items retrieved successfully',
                'data' => $orderItems
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve order items',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Store a newly created order item in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_id' => 'required|exists:products,id',
            'order_id' => 'required|exists:orders,id',
            'color' => 'required|string|max:50',
            'material' => 'required|string|max:50',
            'size' => 'required|string|max:20',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:1',
            'options' => 'nullable|json',
            'rstatus' => 'nullable|boolean'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation errors',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $orderItem = OrderItem::create([
                'product_id' => $request->product_id,
                'order_id' => $request->order_id,
                'color' => $request->color,
                'material' => $request->material,
                'size' => $request->size,
                'price' => $request->price,
                'quantity' => $request->quantity,
                'options' => $request->options,
                'rstatus' => $request->rstatus ?? false
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Order item created successfully',
                'data' => $orderItem->load(['product', 'order'])
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create order item',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified order item.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $orderItem = OrderItem::with(['product', 'order'])->find($id);

            if (!$orderItem) {
                return response()->json([
                    'success' => false,
                    'message' => 'Order item not found'
                ], 404);
            }

            return response()->json([
                'success' => true,
                'message' => 'Order item retrieved successfully',
                'data' => $orderItem
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve order item',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update the specified order item in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $orderItem = OrderItem::find($id);

        if (!$orderItem) {
            return response()->json([
                'success' => false,
                'message' => 'Order item not found'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'product_id' => 'sometimes|exists:products,id',
            'order_id' => 'sometimes|exists:orders,id',
            'color' => 'sometimes|string|max:50',
            'material' => 'sometimes|string|max:50',
            'size' => 'sometimes|string|max:20',
            'price' => 'sometimes|numeric|min:0',
            'quantity' => 'sometimes|integer|min:1',
            'options' => 'nullable|json',
            'rstatus' => 'nullable|boolean'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation errors',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $orderItem->update([
                'product_id' => $request->product_id ?? $orderItem->product_id,
                'order_id' => $request->order_id ?? $orderItem->order_id,
                'color' => $request->color ?? $orderItem->color,
                'material' => $request->material ?? $orderItem->material,
                'size' => $request->size ?? $orderItem->size,
                'price' => $request->price ?? $orderItem->price,
                'quantity' => $request->quantity ?? $orderItem->quantity,
                'options' => $request->has('options') ? $request->options : $orderItem->options,
                'rstatus' => $request->has('rstatus') ? $request->rstatus : $orderItem->rstatus
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Order item updated successfully',
                'data' => $orderItem->load(['product', 'order'])
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update order item',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified order item from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $orderItem = OrderItem::find($id);

            if (!$orderItem) {
                return response()->json([
                    'success' => false,
                    'message' => 'Order item not found'
                ], 404);
            }

            $orderItem->delete();

            return response()->json([
                'success' => true,
                'message' => 'Order item deleted successfully'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete order item',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get order items by order ID
     *
     * @param  int  $orderId
     * @return \Illuminate\Http\Response
     */
    public function getByOrder($orderId)
    {
        try {
            $orderItems = OrderItem::with(['product', 'order'])
                ->where('order_id', $orderId)
                ->get();

            return response()->json([
                'success' => true,
                'message' => 'Order items retrieved successfully',
                'data' => $orderItems
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve order items',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}