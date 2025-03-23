<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class SearchProductController extends Controller
{
    /**
     * Search and filter products based on query and variant attributes.
     */
    public function index(Request $request)
    {
        $query = $request->input('query');
        $categoryId = $request->input('category_id');
        $colorId = $request->input('color_id');
        $sizeId = $request->input('size_id');
        $materialId = $request->input('material_id');

        $productsQuery = Product::query()
            ->with(['category', 'brand', 'variants.color', 'variants.size', 'variants.material']);

        if ($query) {
            $productsQuery->where('name', 'LIKE', "%{$query}%");
        }

        if ($categoryId) {
            $productsQuery->where('category_id', $categoryId);
        }

        if ($colorId || $sizeId || $materialId) {
            $productsQuery->whereHas('variants', function ($q) use ($colorId, $sizeId, $materialId) {
                if ($colorId) {
                    $q->where('color_id', $colorId);
                }
                if ($sizeId) {
                    $q->where('size_id', $sizeId);
                }
                if ($materialId) {
                    $q->where('material_id', $materialId);
                }
            });
        }

        $products = $productsQuery->get();

        return response()->json($products, 200);
    }
}
