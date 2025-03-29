<?php

namespace App\Http\Controllers\API;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;
class ReviewController extends Controller
{

    public function allReviews(Request $request)
    {
        $reviews = Review::with(['user' => function ($query) {
            $query->select('id', 'name');
        }, 'product' => function ($query) {
            $query->select('id', 'name');
        }])
        ->orderBy('created_at', 'desc') // Sắp xếp theo thời gian tạo mới nhất
        ->get(); // Lấy tất cả đánh giá

        return response()->json($reviews, 200);
    }

    // Lấy danh sách đánh giá của một sản phẩm
    public function index($productId)
    {
        $product = Product::findOrFail($productId);

        $reviews = Review::where('product_id', $productId)
            ->with(['user' => function ($query) {
                $query->select('id', 'name');
            }])
            ->get();

        return response()->json($reviews, 200);
    }

    // Thêm đánh giá mới
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'comment' => 'nullable|string|max:500',
        ]);

        $user = Auth::user();
        $productId = $request->input('product_id');

        // Kiểm tra xem user đã đánh giá sản phẩm này chưa
        $existingReview = Review::where('user_id', $user->id)
            ->where('product_id', $productId)
            ->first();

        if ($existingReview) {
            return response()->json(['message' => 'Bạn đã đánh giá sản phẩm này rồi'], 400);
        }

        $review = Review::create([
            'user_id' => $user->id,
            'product_id' => $productId,
            'comment' => $request->input('comment'),
        ]);

        $review->load(['user' => function ($query) {
            $query->select('id', 'name');
        }]);

        return response()->json([
            'message' => 'Đã thêm đánh giá thành công',
            'data' => $review,
        ], 201);
    }

    public function destroy($reviewId)
    {
        $user = Auth::user();
        $review = Review::where('user_id', $user->id)
            ->where('id', $reviewId)
            ->firstOrFail();

        $review->delete();

        return response()->json(['message' => 'Đã xóa đánh giá thành công'], 200);
    }
}
