<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Variant extends Model
{
    use HasFactory;

    public function product() {
        return $this->belongsTo(Product::class);
    }

    protected $fillable = ['product_id', 'color_id', 'size_id', 'material_id', 'regular_price', 'sale_price', ];

    // Biến thể thuộc về 1 màu
    public function color()
    {
        return $this->belongsTo(Color::class, 'color_id');
    }

    // Biến thể thuộc về 1 kích thước
    public function size()
    {
        return $this->belongsTo(Size::class, 'size_id');
    }

    // Biến thể thuộc về 1 chất liệu
    public function material()
    {
        return $this->belongsTo(Material::class, 'material_id');
    }
}
