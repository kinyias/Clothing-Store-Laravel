<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'code'];

    public function variants()
    {
        return $this->hasMany(Variant::class, 'size_id');
    }
}
