<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\Favorite;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $favorites = Favorite::where('user_id', $user->id)
            ->with(['product' => function ($query) {
                $query->with(['brand', 'variants']);
            }])->get();

        // thêm is_favorited vào mỗi sản phẩm (để đồng bộ với API /api/v1/products)
        $favorites = $favorites->map(function ($favorite) use ($user) {
            $favorite->product->is_favorited = true; // danh sách yêu thích, nên luôn là true
            return $favorite;
        });

        return response()->json($favorites, 200);
    }

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

    public function destroy($productId)
    {
        $user = Auth::user();
        $favorite = Favorite::where('user_id', $user->id)->where('product_id', $productId)->firstOrFail();
        $favorite->delete();

        return response()->json(['message' => 'Đã xóa khỏi danh sách yêu thích'], 200);
    }
}
