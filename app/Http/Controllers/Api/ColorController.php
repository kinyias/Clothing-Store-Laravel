<?php

namespace App\Http\Controllers\Api;

use App\Models\Color;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Color::all(), 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:colors,name',
            'code' => 'required|unique:colors,code',
        ]);

        $color = Color::create($request->all());

        return response()->json($color, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Color $color)
    {
        return response()->json($color, 200);
    }

    public function update(Request $request, Color $color)
    {
        $request->validate([
            'name' => 'required|unique:colors,name,' . $color->id,
            'code' => 'required|unique:colors,code,' . $color->id,
        ]);

        $color->update($request->all());

        return response()->json($color, 200);
    }

    public function destroy(Color $color)
    {
        $color->delete();
        return response()->json(null, 204);
    }
}
