<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Testing\Fluent\Concerns\Has;

class Shipping extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_id', 'note', 'before_packing_image', 'after_packing_image', 'packing_time'
    ];
    
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
