<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\Favorite;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    // Lấy danh sách sản phẩm yêu thích
    public function index()
    {
        $user = Auth::user();
        $favorites = Favorite::where('user_id', $user->id)->with('product')->get();
        return response()->json($favorites, 200);
    }

    // Thêm sản phẩm vào danh sách yêu thích
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id'
        ]);

        $user = Auth::user();
        $productId = $request->input('product_id');

        // Kiểm tra xem sản phẩm đã được yêu thích chưa
        $existingFavorite = Favorite::where('user_id', $user->id)
            ->where('product_id', $request->product_id)
            ->first();

        if ($existingFavorite) {
            return response()->json(['message' => 'Sản phẩm đã có trong danh sách yêu thích'], 400);
        }

        Favorite::create([
            'user_id' => $user->id,
            'product_id' => $request->product_id,
        ]);

        return response()->json(['message' => 'Đã thêm vào danh sách yêu thích'], 201);
    }

    // Xóa sản phẩm khỏi danh sách yêu thích
    public function destroy($productId)
    {
        $user = Auth::user();
        $favorite = Favorite::where('user_id', $user->id)->where('product_id', $productId)->firstOrFail();
        $favorite->delete();

        return response()->json(['message' => 'Đã xóa khỏi danh sách yêu thích'], 200);
    }
}
