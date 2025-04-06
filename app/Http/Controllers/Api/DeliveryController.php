<?php

// app/Http/Controllers/DeliveryController.php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Delivery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class DeliveryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $deliveries = Delivery::with(['user', 'order'])->get();
        return response()->json($deliveries);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'order_id' => 'required|exists:orders,id',
            'image_pickup' => 'nullable|url', // Validate as URL string
            'image_delivered' => 'nullable|url', // Validate as URL string
        ]);
    
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
    
        $data = $request->only(['user_id', 'order_id', 'image_pickup', 'image_delivered']);
    
        $delivery = Delivery::create($data);
    
        return response()->json([
            'message' => 'Delivery created successfully',
            'data' => $delivery
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $delivery = Delivery::with(['user', 'order'])->find($id);
        
        if (!$delivery) {
            return response()->json(['message' => 'Delivery not found'], 404);
        }

        return response()->json($delivery);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $delivery = Delivery::find($id);
        
        if (!$delivery) {
            return response()->json(['message' => 'Delivery not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'user_id' => 'sometimes|exists:users,id',
            'order_id' => 'sometimes|exists:orders,id',
            'image_pickup' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image_delivered' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $data = $request->only(['user_id', 'order_id']);
        
        // Handle image updates
        if ($request->hasFile('image_pickup')) {
            // Delete old image if exists
            if ($delivery->image_pickup) {
                Storage::disk('public')->delete($delivery->image_pickup);
            }
            $data['image_pickup'] = $request->file('image_pickup')->store('deliveries', 'public');
        }
        
        if ($request->hasFile('image_delivered')) {
            // Delete old image if exists
            if ($delivery->image_delivered) {
                Storage::disk('public')->delete($delivery->image_delivered);
            }
            $data['image_delivered'] = $request->file('image_delivered')->store('deliveries', 'public');
        }

        $delivery->update($data);

        return response()->json([
            'message' => 'Delivery updated successfully',
            'data' => $delivery
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $delivery = Delivery::find($id);
        
        if (!$delivery) {
            return response()->json(['message' => 'Delivery not found'], 404);
        }

        // Delete associated images
        if ($delivery->image_pickup) {
            Storage::disk('public')->delete($delivery->image_pickup);
        }
        
        if ($delivery->image_delivered) {
            Storage::disk('public')->delete($delivery->image_delivered);
        }

        $delivery->delete();

        return response()->json(['message' => 'Delivery deleted successfully']);
    }
    /**
     * Update deliveries by order ID.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $orderId
     * @return \Illuminate\Http\Response
     */
    public function updateByOrderId(Request $request, $orderId)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'user_id' => 'sometimes|exists:users,id',
            'image_pickup' => 'nullable|url', // Assuming URLs, adjust if files
            'image_delivered' => 'nullable|url',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation errors',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            // Find deliveries by order_id
            $deliveries = Delivery::where('order_id', $orderId)->get();

            if ($deliveries->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'message' => 'No deliveries found for order ID ' . $orderId
                ], 404);
            }

            // Prepare update data
            $data = $request->only(['user_id', 'image_pickup', 'image_delivered']);

            // Update each delivery
            foreach ($deliveries as $delivery) {
                $delivery->update($data);
            }

            // Fetch updated deliveries with relationships
            $updatedDeliveries = Delivery::where('order_id', $orderId)
                ->with(['user', 'order'])
                ->get();

            return response()->json([
                'success' => true,
                'message' => 'Deliveries updated successfully for order ID ' . $orderId,
                'data' => $updatedDeliveries
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update deliveries',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}