<?php

namespace App\Http\Controllers\Api;

use App\Models\Size;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SizeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Size::all(), 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:sizes,name',
            'code' => 'required|unique:sizes,code',
        ]);

        $size = Size::create($request->all());

        return response()->json($size, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Size $size)
    {
        return response()->json($size, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Size $size)
    {
        $request->validate([
            'name' => 'required|unique:sizes,name,' . $size->id,
            'code' => 'required|unique:sizes,code,' . $size->id,
        ]);

        $size->update($request->all());

        return response()->json($size, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Size $size)
    {
        $size->delete();
        return response()->json(null, 204);
    }
}
