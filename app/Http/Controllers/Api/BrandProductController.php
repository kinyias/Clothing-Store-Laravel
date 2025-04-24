<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Product;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class BrandProductController extends Controller
{
    public function getProductsByBrand($brandId, Request $request)
    {
        // Validate category existence
        $brand = Brand::find($brandId);
        if (!$brand) {
            return response()->json([
                'error' => [
                    'code' => 404,
                    'message' => 'Brand not found.'
                ]
            ], Response::HTTP_NOT_FOUND);
        }

        // Query products with optional filters
        $query = Product::where('brand_id', $brandId);

        // Sorting
        if ($request->has('sort')) {
            $sortField = $request->input('sort', 'created_at');
            $sortOrder = $request->input('order', 'asc');
            $query->orderBy($sortField, $sortOrder);
        }

        // // Pagination
        // $limit = $request->input('limit', 10);
        // $offset = $request->input('offset', 0);
        // $products = $query->skip($offset)->take($limit)->get();

        // // Total count for metadata
        // $total = $query->count();

        // Prepare response
        return response()->json($query->get(), Response::HTTP_OK);
    }
}
