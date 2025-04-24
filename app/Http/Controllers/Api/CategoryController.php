<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        return response()->json(Category::all(), 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:categories,slug,',

        ]);

        $category = Category::create($request->all());

        return response()->json($category, 201);
    }

    public function show(Category $category)
    {
        return response()->json($category, 200);
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:categories,slug,' . $category->id,
       
        ]);
        Log::info($category->name);
        $category->name  = $request->name;
        $category->slug = Str::slug($request->name);
        // $image = $request->file('image');
        // $file_extention = $request->file('image')->extension();
        // $file_name = Carbon::now()->timestamp . '.' . $file_extention;
        // $this->GenerateCategoryThumnailsImage($image, $file_name);
        // $category->image =  $file_name;
        $category->save();
        return response()->json($category, 200);
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return response()->json(null, 204);
    }
}
