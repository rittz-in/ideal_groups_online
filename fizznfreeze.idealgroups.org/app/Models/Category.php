<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Category extends Model  // Singular name
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'slug',
        'parent_id',
        'status',
    ];

    protected $casts = [

    ];

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function products()
    {
        return $this->hasMany(Products::class, 'category_name', 'name');
    }

    public function getIconAttribute()
    {
        $icons = [
            'Maggie' => 'fa-solid fa-burger',
            'Puff' => 'fa-solid fa-bowl-food',
            'Sandwich' => 'fa-solid fa-cheese',
            'French Fries' => 'fa-solid fa-bars-staggered',
            'Pizza' => 'fa-solid fa-pizza-slice',
            'Fresh Juice' => 'fa-solid fa-glass-water',
            'Fresh Soda' => 'fa-solid fa-glass-water',
            'Mocktail' => 'fa-solid fa-wine-glass',
            'Milk Shakes' => 'fa-solid fa-glass-water',
            'Strawberry with Chocolate' => 'fa-solid fa-ice-cream',
            'Pasta' => 'fa-solid fa-plate-wheat',
        ];

        return $icons[$this->name] ?? 'fa-solid fa-utensils';
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($category) {
            if (empty($category->slug)) {
                $category->slug = Str::slug($category->name, '-');
            }
        });

        static::updating(function ($category) {
            $category->slug = Str::slug($category->name, '-');
        });
    }
}
