<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Products extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'price',
        'discount_price',
        'product_image',
        'slug',
        'parent_id',
        'status',
        'category_name',
        'trending',
    ];

    protected $casts = [
        'trending' => 'boolean',
        'price' => 'decimal:2',
        'discount_price' => 'decimal:2',

    ];


    protected static function boot()
    {
        parent::boot();

        static::creating(function ($product) {
            if (empty($product->slug)) {
                $product->slug = Str::slug($product->name, '-');
            }
        });
        static::updating(function ($product) {
             $product->slug = Str::slug($product->name, '-');
        });
    }
}
