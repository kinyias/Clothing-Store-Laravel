<?php

namespace App\Http\Controllers\Api;

use App\Models\Material;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Material::all(), 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:materials,name',
            'code' => 'required|unique:materials,code',
        ]);

        $material = Material::create($request->all());

        return response()->json($material, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Material $material)
    {
        return response()->json($material, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Material $material)
    {
        $request->validate([
            'name' => 'required|unique:materials,name,' . $material->id,
            'code' => 'required|unique:materials,code,' . $material->id,
        ]);

        $material->update($request->all());

        return response()->json($material, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Material $material)
    {
        $material->delete();
        return response()->json(null, 204);
    }
}
