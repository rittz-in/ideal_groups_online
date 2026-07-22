<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
  use HasFactory;

  protected $fillable = [
    'order_id',
    'product_id',
    'product_name',
    'price',
    'quantity',
    'total',
    'special_instructions',
    'batch_group',
    'status',
  ];

  protected $casts = [
    'price' => 'decimal:2',
    'total' => 'decimal:2',
  ];

  /**
   * Relationship with Order
   */
  public function order()
  {
    return $this->belongsTo(Order::class);
  }

  /**
   * Relationship with Product
   */
  public function product()
  {
    return $this->belongsTo(Products::class, 'product_id');
  }
}
