<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use App\Models\Coupon;
use App\Models\Material;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Review;
use App\Models\Size;
use App\Models\Transaction;
use App\Models\Variant;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Intervention\Image\Laravel\Facades\Image;

class AdminController extends Controller
{
    public function index()
    {
        $ttPro = Product::count();
        $ttCate = Category::count();
        $ttOrder = Order::count();
        $ttPriceOrders = Order::sum('subtotal');
        $ttOrdered = Order::where('status', 'ordered')->count();
        $ttDelivered = Order::where('status', 'delivered')->count();
        $ttCanceled = Order::where('status', 'canceled')->count();
        $ttCompleted = Order::where('status', 'completed')->count();
        $orders = Order::orderBy('created_at', 'desc')->limit(5)->get();
        return view('admin.index', compact('ttPro', 'ttCate', 'ttOrder', 'ttPriceOrders', 'ttOrdered', 'ttDelivered', 'ttCanceled', 'ttCompleted', 'orders'));
    }

    public function brands()
    {
        $brands = Brand::orderBy('id', 'DESC')->paginate(10);
        return view('admin.brands', compact('brands'));
    }

    public function add_brand()
    {
        return view('admin.brand-add');
    }

    public function brand_store(Request $request)
{
    $request->validate([
        'name' => 'required',
        'slug' => 'required|unique:brands,slug',
        'image' => 'mimes:png,jpg,jpeg|max:2028'
    ]);

    $brand = new Brand();
    $brand->name = $request->name;
    $brand->slug = Str::slug($request->name);

    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $uploadedFile = $image->storeOnCloudinary('clothingstore');
        $brand->image = $uploadedFile->getSecurePath();
    }

    $brand->save();
    return redirect()->route('admin.brands')->with('status', 'Đã thêm thương hiệu thành công!');
}

    public function brand_edit($id)
    {
        $brand = Brand::find($id);
        return view('admin.brand-edit', compact('brand'));
    }

    public function brand_update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:brands,slug,' . $request->id,
            'image' => 'mimes:png,jpg,jpeg|max:2028'
        ]);
        $brand = Brand::find($request->id);
        $brand->name  = $request->name;
        $brand->slug = Str::slug($request->name);
        if ($request->hasFile('image')) {
             // Delete the old image if it exists
             if ($brand->image) {
                $publicId = pathinfo(parse_url($brand->image, PHP_URL_PATH), PATHINFO_FILENAME);
                Cloudinary::destroy('clothingstore/' . $publicId); // Delete old image
            }
            $image = $request->file('image');
            $uploadedFile = $image->storeOnCloudinary('clothingstore');
            $brand->image = $uploadedFile->getSecurePath();
        }
        $brand->save();
        return redirect()->route('admin.brands')->with('status', 'Đã cập nhật thương hiệu thành công!');
    }

    public function brand_delete($id)
    {
        $brand = Brand::find($id);
        if ($brand->image) {
            $publicId = pathinfo(parse_url($brand->image, PHP_URL_PATH), PATHINFO_FILENAME);
            Cloudinary::destroy('clothingstore/' . $publicId); // Delete old image
        }
        $brand->delete();
        return redirect()->route('admin.brands')->with('status', 'Đã xoá thành công thương hiệu');
    }

    public function categories()
    {
        $categories = Category::withCount('products')->orderBy('id', 'DESC')->paginate(10);
        return view('admin.categories', compact('categories'));
    }

    public function category_add()
    {
        return view('admin.category-add');
    }

    public function category_store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:categories,slug',
            'image' => 'mimes:png,jpg,jpeg|max:2048'
        ]);

        $category = new Category();
        $category->name  = $request->name;
        $category->slug = Str::slug($request->name);
        if ($request->hasFile('image')) {
           $image = $request->file('image');
           $uploadedFile = $image->storeOnCloudinary('clothingstore');
           $category->image = $uploadedFile->getSecurePath();
       }
        $category->save();
        return redirect()->route('admin.categories')->with('status', 'Đã thêm danh mục thành công!');
    }


    // public function GenerateCategoryThumnailsImage($image, $imageName)
    // {
    //     $destinationPath  = public_path('uploads/categories');
    //     $img = Image::read($image->path());
    //     $img->cover(124, 124, "top");
    //     $img->resize(124, 124, function ($constraint) {
    //         $constraint->aspectRatio();
    //     })->save($destinationPath . '/' . $imageName);
    // }

    public function category_edit($id)
    {
        $category = Category::find($id);
        return view('admin.category-edit', compact('category'));
    }

    public function category_update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:categories,slug,' . $request->id,
            'image' => 'mimes:png,jpg,jpeg|max:2028'
        ]);
        $category = Category::find($request->id);
        $category->name  = $request->name;
        $category->slug = Str::slug($request->name);
        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($category->image) {
               $publicId = pathinfo(parse_url($category->image, PHP_URL_PATH), PATHINFO_FILENAME);
               Cloudinary::destroy('clothingstore/' . $publicId); // Delete old image
           }
           $image = $request->file('image');
           $uploadedFile = $image->storeOnCloudinary('clothingstore');
           $category->image = $uploadedFile->getSecurePath();
       }
        $category->save();
        return redirect()->route('admin.categories')->with('status', 'Đã cập nhật danh mục thành công!');
    }

    public function category_delete($id)
    {
        $category = Category::find($id);
        if ($category->image) {
            $publicId = pathinfo(parse_url($category->image, PHP_URL_PATH), PATHINFO_FILENAME);
            Cloudinary::destroy('clothingstore/' . $publicId); // Delete old image
        }
        $category->delete();
        return redirect()->route('admin.categories')->with('status', 'Đã xoá danh mục thành công');
    }

    public function products()
    {
        // $products = Product::orderBy('created_at', 'DESC')->paginate(10);
        // return view('admin.products', compact('products'));
        $products = Product::with(['category', 'brand', 'variants'])->paginate(10);
        return view('admin.products', compact('products'));
    }

    public function product_add()
    {
        $categories = Category::select('id', 'name')->orderBy('name')->get();
        $brands = Brand::select('id', 'name')->orderBy('name')->get();
        return view('admin.product-add', compact('categories', 'brands'));
    }

    public function product_store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:products,slug',
            'short_description' => 'required',
            'description' => 'required',
            'regular_price' => 'required',
            'sale_price' => 'required',
            'SKU' => 'required',
            'stock_status' => 'required',
            'featured' => 'required',
            'quantity' => 'required',
            'image' => 'required|mimes:png,jpg,jpeg|max:2048',
            'category_id' => 'required',
            'brand_id' => 'required'
        ]);

        $product = new Product();
        $product->name = $request->name;
        $product->slug = Str::slug($request->name);
        $product->short_description = $request->short_description;
        $product->description = $request->description;
        $product->regular_price = $request->regular_price;
        $product->sale_price = $request->sale_price;
        $product->SKU = $request->SKU;
        $product->stock_status = $request->stock_status;
        $product->featured = $request->featured;
        $product->quantity = $request->quantity;
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $uploadedFile = $image->storeOnCloudinary('clothingstore/products');
            $product->image = $uploadedFile->getSecurePath();
        }

        $gallery_arr = array();
        if ($request->hasFile('images')) {
            $files = $request->file('images');
            foreach ($files as $file) {
                $uploadedFile = $file->storeOnCloudinary('clothingstore/products/gallery');
                array_push($gallery_arr, $uploadedFile->getSecurePath());
            }
            $product->images = implode(',', $gallery_arr);
        }
        $product->save();
        return redirect()->route('admin.products')->with('status', 'Product has been added successfully!');
    }

    public function product_edit($id)
    {
        $product = Product::find($id);
        $categories = Category::select('id', 'name')->orderBy('name')->get();
        $brands = Brand::select('id', 'name')->orderBy('name')->get();
        return view('admin.product-edit', compact('product', 'categories', 'brands'));
    }

    public function product_update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:products,slug,' . $request->id,
            'short_description' => 'required',
            'description' => 'required',
            'regular_price' => 'required',
            'sale_price' => 'required',
            'SKU' => 'required',
            'stock_status' => 'required',
            'featured' => 'required',
            'quantity' => 'required',
            'image' => 'mimes:png,jpg,jpeg|max:2048',
            'category_id' => 'required',
            'brand_id' => 'required'
        ]);

        $product = Product::find($request->id);
        $product->name = $request->name;
        $product->slug = Str::slug($request->name);
        $product->short_description = $request->short_description;
        $product->description = $request->description;
        $product->regular_price = $request->regular_price;
        $product->sale_price = $request->sale_price;
        $product->SKU = $request->SKU;
        $product->stock_status = $request->stock_status;
        $product->featured = $request->featured;
        $product->quantity = $request->quantity;
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;

        if ($request->hasFile('image')) {
            // Xóa ảnh cũ trên Cloudinary nếu tồn tại
            if ($product->image) {
                $publicId = pathinfo(parse_url($product->image, PHP_URL_PATH), PATHINFO_FILENAME);
                Cloudinary::destroy('clothingstore/products/' . $publicId);
            }
            $image = $request->file('image');
            $uploadedFile = $image->storeOnCloudinary('clothingstore/products');
            $product->image = $uploadedFile->getSecurePath();
        }

        // $gallery_arr = array();
        if ($request->hasFile('images')) {
            // Xóa các ảnh gallery cũ trên Cloudinary
            if ($product->images) {
                foreach (explode(',', $product->images) as $oldImage) {
                    $publicId = pathinfo(parse_url($oldImage, PHP_URL_PATH), PATHINFO_FILENAME);
                    Cloudinary::destroy('clothingstore/products/gallery/' . $publicId);
                }
            }

            $gallery_arr = array();
            $files = $request->file('images');
            foreach ($files as $file) {
                $uploadedFile = $file->storeOnCloudinary('clothingstore/products/gallery');
                array_push($gallery_arr, $uploadedFile->getSecurePath());
            }
            $product->images = implode(',', $gallery_arr);
        }

        $product->save();
        return redirect()->route('admin.products')->with('status', 'Product has been updated successfully!');
    }

    public function delete_product($id)
    {
        $product = Product::find($id);
        // Xóa ảnh chính trên Cloudinary nếu tồn tại
        if ($product->image) {
            $publicId = pathinfo(parse_url($product->image, PHP_URL_PATH), PATHINFO_FILENAME);
            Cloudinary::destroy('clothingstore/products/' . $publicId);
        }

        // Xóa các ảnh gallery trên Cloudinary nếu tồn tại
        if ($product->images) {
            foreach (explode(',', $product->images) as $image) {
                $publicId = pathinfo(parse_url($image, PHP_URL_PATH), PATHINFO_FILENAME);
                Cloudinary::destroy('clothingstore/products/gallery/' . $publicId);
            }
        }
        $product->delete();
        return redirect()->route('admin.products')->with('status', 'Record has been deleted successfully !');
    }

    public function search(Request $request) {
        $query = $request->input('query');
        $results = Product::where('name', 'LIKE', "%{$query}%")->get()->take(8);
        return response()->json($results);
    }
    public function searchProducts(Request $request)
    {
        $query = $request->input('query'); // Tìm kiếm theo tên
        $categoryId = $request->input('category_id'); // Lọc theo danh mục
        $colorId = $request->input('color_id'); // Lọc theo màu sắc
        $sizeId = $request->input('size_id'); // Lọc theo kích thước
        $materialId = $request->input('material_id'); // Lọc theo chất liệu

        $products = Product::query()
            ->with(['category', 'brand', 'variants.color', 'variants.size', 'variants.material']); // Load các quan hệ

        // Tìm kiếm theo tên nếu có query
        if ($query) {
            $products->where('name', 'LIKE', "%{$query}%");
        }

        // Lọc theo danh mục nếu có
        if ($categoryId) {
            $products->where('category_id', $categoryId);
        }

        // Lọc theo màu sắc, kích thước, chất liệu thông qua variants
        if ($colorId || $sizeId || $materialId) {
            $products->whereHas('variants', function ($q) use ($colorId, $sizeId, $materialId) {
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

        // Lấy kết quả phân trang
        $products = $products->paginate(10);

        // Trả về view với dữ liệu
        return view('admin.products', compact('products'));
    }

    public function coupons(){
        $coupons = Coupon::orderBy('expiry_date','DESC')->paginate(12);
        return view('admin.coupons', compact("coupons"));
    }

    public function coupon_add(){
        return view('admin.coupon-add');
    }

    public function coupon_store(Request $request){
        $request->validate([
            'code'=> 'required',
            'type'=>'required',
            'value'=>'required|numeric',
            'cart_value'=>'required|numeric',
            'expiry_date'=>'required|date',
            ]
        );

        $coupon = new Coupon();
        $coupon->code = $request->code;
        $coupon->type = $request->type;
        $coupon->value = $request->value;
        $coupon->cart_value = $request->cart_value;
        $coupon->expiry_date = $request->expiry_date;
        $coupon->save();
        return redirect()->route('admin.coupons')->with('status', 'Mã khuyễn mãi đã được thêm thành công');
    }

    public function coupon_edit($id){
        $coupon = Coupon::find($id);
        return view('admin.coupon-edit', compact('coupon'));
    }

    public function coupon_update(Request $request){
        $request->validate([
            'code'=> 'required',
            'type'=>'required',
            'value'=>'required|numeric',
            'cart_value'=>'required|numeric',
            'expiry_date'=>'required|date',
            ]
        );

        $coupon = Coupon::find($request->id);
        $coupon->code = $request->code;
        $coupon->type = $request->type;
        $coupon->value = $request->value;
        $coupon->cart_value = $request->cart_value;
        $coupon->expiry_date = $request->expiry_date;
        $coupon->save();
        return redirect()->route('admin.coupons')->with('status', 'Mã khuyễn mãi đã được cập nhật thành công');
    }

    public function coupon_delete($id){
        $coupon=Coupon::find($id);
        $coupon->delete();
        return redirect()->route('admin.coupons')->with('status', "Mã khuyễn mãi đã được xoá thành công");
    }

    public function orders(){
        $orders = Order::orderBy('created_at','DESC')->paginate(12);
        return view('admin.orders', compact('orders'));
    }

    public function order_details($order_id){
        $order = Order::find($order_id);
        $orderItems = OrderItem::where('order_id', $order_id)->orderBy('id')->paginate(12);
        $transaction = Transaction::where('order_id', $order_id)->first();
        return view('admin.order-details', compact('order', "orderItems", 'transaction'));
    }

    public function update_order_status(Request $request){
        $order = Order::find($request->order_id);
        $order->status = $request->order_status;
        if($request->order_status == 'delivered'){
            $order->delivered_date = Carbon::now();
        }else if($request->order_status=='canceled'){
            $order->canceled_date = Carbon::now();
        }
        $order->save();

        if($request->order_status == 'delivered'){
            $transaction = Transaction::where('order_id', $request->order_id)->first();
            $transaction->status='approved';
            $transaction->save();
        }
        return back()->with('status', 'Thay đổi trạng thái thành công');
    }


    // Colors
    public function colors()
    {
        $colors = Color::withCount('variants')->paginate(10);
        return view('admin.colors', compact('colors'));
    }

    public function colorAdd()
    {
        return view('admin.color-add');
    }

    public function colorStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:7', // Ví dụ: #FF0000
        ]);

        Color::create([
            'name' => $request->name,
            'code' => $request->code,
        ]);

        return redirect()->route('admin.colors')->with('status', 'Color added successfully!');
    }

    public function colorEdit($id)
    {
        $color = Color::findOrFail($id);
        return view('admin.color-edit', compact('color'));
    }

    public function colorUpdate(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:7',
        ]);

        $color = Color::findOrFail($id);
        $color->update([
            'name' => $request->name,
            'code' => $request->code,
        ]);

        return redirect()->route('admin.colors')->with('status', 'Color updated successfully!');
    }

    public function colorDelete($id)
    {
        $color = Color::findOrFail($id);
        $color->delete();

        return redirect()->route('admin.colors')->with('status', 'Color deleted successfully!');
    }

    // Sizes
    public function sizes()
    {
        $sizes = Size::withCount('variants')->paginate(10);
        return view('admin.sizes', compact('sizes'));
    }

    public function sizeAdd()
    {
        return view('admin.size-add');
    }

    public function sizeStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:10', // Ví dụ: S, M, L
        ]);

        Size::create([
            'name' => $request->name,
            'code' => $request->code,
        ]);

        return redirect()->route('admin.sizes')->with('status', 'Size added successfully!');
    }

    public function sizeEdit($id)
    {
        $size = Size::findOrFail($id);
        return view('admin.size-edit', compact('size'));
    }

    public function sizeUpdate(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:10',
        ]);

        $size = Size::findOrFail($id);
        $size->update([
            'name' => $request->name,
            'code' => $request->code,
        ]);

        return redirect()->route('admin.sizes')->with('status', 'Size updated successfully!');
    }

    public function sizeDelete($id)
    {
        $size = Size::findOrFail($id);
        $size->delete();

        return redirect()->route('admin.sizes')->with('status', 'Size deleted successfully!');
    }

    // Materials
    public function materials()
    {
        $materials = Material::withCount('variants')->paginate(10);
        return view('admin.materials', compact('materials'));
    }

    public function materialAdd()
    {
        return view('admin.material-add');
    }

    public function materialStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:50', // Ví dụ: cotton, polyester
        ]);

        Material::create([
            'name' => $request->name,
            'code' => $request->code,
        ]);

        return redirect()->route('admin.materials')->with('status', 'Material added successfully!');
    }

    public function materialEdit($id)
    {
        $material = Material::findOrFail($id);
        return view('admin.material-edit', compact('material'));
    }

    public function materialUpdate(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:50',
        ]);

        $material = Material::findOrFail($id);
        $material->update([
            'name' => $request->name,
            'code' => $request->code,
        ]);

        return redirect()->route('admin.materials')->with('status', 'Material updated successfully!');
    }

    public function materialDelete($id)
    {
        $material = Material::findOrFail($id);
        $material->delete();

        return redirect()->route('admin.materials')->with('status', 'Material deleted successfully!');
    }

    // Variants
    public function variants()
    {
        $variants = Variant::with(['product', 'color', 'size', 'material'])->paginate(10);
        $products = Product::all();
        $colors = Color::all();
        $sizes = Size::all();
        $materials = Material::all();
        return view('admin.variants', compact('variants', 'products', 'colors', 'sizes', 'materials'));
    }

    public function variantAdd()
    {
        $products = Product::all();
        $colors = Color::all();
        $sizes = Size::all();
        $materials = Material::all();
        return view('admin.variant-add', compact('products', 'colors', 'sizes', 'materials'));
    }

    public function variantStore(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'color_id' => 'nullable|exists:colors,id',
            'size_id' => 'nullable|exists:sizes,id',
            'material_id' => 'nullable|exists:materials,id',
            'regular_price' => 'required|numeric|min:0',
            'sale_price' => 'nullable|numeric|min:0',
        ]);

        Variant::create([
            'product_id' => $request->product_id,
            'color_id' => $request->color_id,
            'size_id' => $request->size_id,
            'material_id' => $request->material_id,
            'regular_price' => $request->regular_price,
            'sale_price' => $request->sale_price,
        ]);

        return redirect()->route('admin.variants')->with('status', 'Variant added successfully!');
    }

    public function variantEdit($id)
    {
        $variant = Variant::findOrFail($id);
        $products = Product::all();
        $colors = Color::all();
        $sizes = Size::all();
        $materials = Material::all();
        return view('admin.variant-edit', compact('variant', 'products', 'colors', 'sizes', 'materials'));
    }

    public function variantUpdate(Request $request, $id)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'color_id' => 'nullable|exists:colors,id',
            'size_id' => 'nullable|exists:sizes,id',
            'material_id' => 'nullable|exists:materials,id',
            'regular_price' => 'required|numeric|min:0',
            'sale_price' => 'nullable|numeric|min:0',
        ]);

        $variant = Variant::findOrFail($id);
        $variant->update([
            'product_id' => $request->product_id,
            'color_id' => $request->color_id,
            'size_id' => $request->size_id,
            'material_id' => $request->material_id,
            'regular_price' => $request->regular_price,
            'sale_price' => $request->sale_price,
        ]);

        return redirect()->route('admin.variants')->with('status', 'Variant updated successfully!');
    }

    public function variantDelete($id)
    {
        $variant = Variant::findOrFail($id);
        $variant->delete();

        return redirect()->route('admin.variants')->with('status', 'Variant deleted successfully!');
    }

    public function reviews()
    {
        $reviews = Review::with('user', 'product')->latest()->paginate(10);
        return view('admin.reviews', compact('reviews'));
    }

    public function reviewDelete($id)
    {
        $review = Review::findOrFail($id);
        $review->delete();
        return redirect()->route('admin.reviews')->with('status', 'Đánh giá đã được xóa thành công!');
    }
}
