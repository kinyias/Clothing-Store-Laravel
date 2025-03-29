<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AddressController extends Controller
{
    /**
     * Display a listing of addresses.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $addresses = Address::where('user_id', $request->user()->id)
                ->orderBy('isdefault', 'desc')
                ->get();

            return response()->json([
                'success' => true,
                'message' => 'Addresses retrieved successfully',
                'data' => $addresses
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve addresses',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Store a newly created address in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
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
            'isdefault' => 'nullable|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation errors',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            // If this is being set as default, remove default from others
            if ($request->isdefault) {
                Address::where('user_id', $request->user()->id)
                    ->update(['isdefault' => false]);
            }

            $address = Address::create([
                'user_id' => $request->user()->id,
                'name' => $request->name,
                'phone' => $request->phone,
                'locality' => $request->locality,
                'address' => $request->address,
                'city' => $request->city,
                'state' => $request->state,
                'country' => $request->country,
                'landmark' => $request->landmark,
                'zip' => $request->zip,
                'type' => $request->type ?? 'home',
                'isdefault' => $request->isdefault ?? false,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Address created successfully',
                'data' => $address
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create address',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified address.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        try {
            $address = Address::where('user_id', $request->user()->id)
                ->find($id);

            if (!$address) {
                return response()->json([
                    'success' => false,
                    'message' => 'Address not found'
                ], 404);
            }

            return response()->json([
                'success' => true,
                'message' => 'Address retrieved successfully',
                'data' => $address
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve address',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update the specified address in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $address = Address::where('user_id', $request->user()->id)
            ->find($id);

        if (!$address) {
            return response()->json([
                'success' => false,
                'message' => 'Address not found'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
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
            'isdefault' => 'nullable|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation errors',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            // If this is being set as default, remove default from others
            if ($request->has('isdefault') && $request->isdefault) {
                Address::where('user_id', $request->user()->id)
                    ->where('id', '!=', $id)
                    ->update(['isdefault' => false]);
            }

            $address->update([
                'name' => $request->name ?? $address->name,
                'phone' => $request->phone ?? $address->phone,
                'locality' => $request->locality ?? $address->locality,
                'address' => $request->address ?? $address->address,
                'city' => $request->city ?? $address->city,
                'state' => $request->state ?? $address->state,
                'country' => $request->country ?? $address->country,
                'landmark' => $request->has('landmark') ? $request->landmark : $address->landmark,
                'zip' => $request->zip ?? $address->zip,
                'type' => $request->has('type') ? $request->type : $address->type,
                'isdefault' => $request->has('isdefault') ? $request->isdefault : $address->isdefault,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Address updated successfully',
                'data' => $address
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update address',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified address from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        try {
            $address = Address::where('user_id', $request->user()->id)
                ->find($id);

            if (!$address) {
                return response()->json([
                    'success' => false,
                    'message' => 'Address not found'
                ], 404);
            }

            // If deleting default address, set another as default
            if ($address->isdefault) {
                $newDefault = Address::where('user_id', $request->user()->id)
                    ->where('id', '!=', $id)
                    ->first();

                if ($newDefault) {
                    $newDefault->update(['isdefault' => true]);
                }
            }

            $address->delete();

            return response()->json([
                'success' => true,
                'message' => 'Address deleted successfully'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete address',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Set address as default
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function setDefault(Request $request, $id)
    {
        try {
            $address = Address::where('user_id', $request->user()->id)
                ->find($id);

            if (!$address) {
                return response()->json([
                    'success' => false,
                    'message' => 'Address not found'
                ], 404);
            }

            // Remove default from all other addresses
            Address::where('user_id', $request->user()->id)
                ->where('id', '!=', $id)
                ->update(['isdefault' => false]);

            // Set this address as default
            $address->update(['isdefault' => true]);

            return response()->json([
                'success' => true,
                'message' => 'Address set as default successfully',
                'data' => $address
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to set address as default',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}