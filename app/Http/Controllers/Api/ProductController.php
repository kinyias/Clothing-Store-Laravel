<?php

namespace App\Http\Controllers\Api;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //return response()->json(Product::with(['category', 'brand', 'variants'])->get(), 200);
        ////test////
        $products = Product::with(['category', 'brand', 'variants'])->get();
        $user = Auth::guard('sanctum')->user();

        $products = $products->map(function ($product) use ($user) {
            $product->is_favorited = $user ? $user->favorites->contains($product->id) : false;
            return $product;
        });
        ////test////

        return response()->json($products, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|unique:products,slug',
            'short_description' => 'nullable|string',
            'description' => 'nullable|string',
            'regular_price' => 'required|numeric',
            'sale_price' => 'nullable|numeric',
            'SKU' => 'nullable|string',
            'stock_status' => 'nullable|string|in:instock,outofstock',
            'featured' => 'nullable|boolean',
            'quantity' => 'nullable|integer',
            'image' => 'required|string', // URL từ Cloudinary
            'images' => 'nullable|string', // Chuỗi URL cách nhau bằng dấu phẩy
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'nullable|exists:brands,id',
        ]);

        $product = Product::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'short_description' => $request->short_description,
            'description' => $request->description,
            'regular_price' => $request->regular_price,
            'sale_price' => $request->sale_price,
            'SKU' => $request->SKU,
            'stock_status' => $request->stock_status ?? 'instock',
            'featured' => $request->featured ?? 0,
            'quantity' => $request->quantity ?? 0,
            'image' => $request->image,
            'images' => $request->images,
            'category_id' => $request->category_id,
            'brand_id' => $request->brand_id,
        ]);

        ////test
        $user = Auth::guard('sanctum')->user();
        $product->is_favorited = $user ? $user->favorites->contains($product->id) : false;
        ////test

        return response()->json($product, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        /////test
        $user = Auth::guard('sanctum')->user();
        $product->load(['category', 'brand', 'variants']);
        $product->is_favorited = $user ? $user->favorites->contains($product->id) : false;
        /////test

        return response()->json($product->load(['category', 'brand', 'variants']), 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|unique:products,slug,' . $product->id,
            'short_description' => 'nullable|string',
            'description' => 'nullable|string',
            'regular_price' => 'required|numeric',
            'sale_price' => 'nullable|numeric',
            'SKU' => 'nullable|string',
            'stock_status' => 'nullable|string|in:instock,outofstock',
            'featured' => 'nullable|boolean',
            'quantity' => 'nullable|integer',
            'image' => 'nullable|string', // URL từ Cloudinary
            'images' => 'nullable|string', // Chuỗi URL cách nhau bằng dấu phẩy
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'nullable|exists:brands,id',
        ]);

        $product->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'short_description' => $request->short_description,
            'description' => $request->description,
            'regular_price' => $request->regular_price,
            'sale_price' => $request->sale_price,
            'SKU' => $request->SKU,
            'stock_status' => $request->stock_status ?? $product->stock_status,
            'featured' => $request->featured ?? $product->featured,
            'quantity' => $request->quantity ?? $product->quantity,
            'image' => $request->image ?? $product->image,
            'images' => $request->images ?? $product->images,
            'category_id' => $request->category_id,
            'brand_id' => $request->brand_id,
        ]);

        ////Test
        $user = Auth::guard('sanctum')->user();
        $product->is_favorited = $user ? $user->favorites->contains($product->id) : false;
        ////Test
        
        return response()->json($product, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return response()->json(null, 204);
    }
}
