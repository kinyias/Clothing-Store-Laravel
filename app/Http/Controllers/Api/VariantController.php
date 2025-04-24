<?php

namespace App\Http\Controllers\Api;

use App\Models\Variant;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VariantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Variant::all(), 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'color_id' => 'required|exists:colors,id',
            'size_id' => 'required|exists:sizes,id',
            'material_id' => 'required|exists:materials,id',
            'regular_price' => 'required|numeric|min:0', 
            'sale_price' => 'nullable|numeric|min:0',
        ]);

        $variant = Variant::create($request->all());

        return response()->json($variant, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Variant $variant)
    {
        return response()->json($variant, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Variant $variant)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'color_id' => 'required|exists:colors,id',
            'size_id' => 'required|exists:sizes,id',
            'material_id' => 'required|exists:materials,id',
            'regular_price' => 'required|numeric|min:0',
            'sale_price' => 'nullable|numeric|min:0',
        ]);

        $variant->update($request->all());

        return response()->json($variant, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Variant $variant)
    {
        $variant->delete();
        return response()->json(null, 204);
    }
}
