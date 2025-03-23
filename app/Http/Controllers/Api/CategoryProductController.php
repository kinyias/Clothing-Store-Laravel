<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CategoryProductController extends Controller
{
    public function getProductsByCategory($categoryId, Request $request)
    {
        // Validate category existence
        $category = Category::find($categoryId);
        if (!$category) {
            return response()->json([
                'error' => [
                    'code' => 404,
                    'message' => 'Category not found.'
                ]
            ], Response::HTTP_NOT_FOUND);
        }

        // Query products with optional filters
        $query = Product::where('category_id', $categoryId);

        // Sorting
        if ($request->has('sort')) {
            $sortField = $request->input('sort', 'id');
            $sortOrder = $request->input('order', 'asc');
            $query->orderBy($sortField, $sortOrder);
        }

        // Pagination
        $limit = $request->input('limit', 10);
        $offset = $request->input('offset', 0);
        $products = $query->skip($offset)->take($limit)->get();

        // Total count for metadata
        $total = $query->count();

        // Prepare response
        return response()->json($products, Response::HTTP_OK);
    }
}