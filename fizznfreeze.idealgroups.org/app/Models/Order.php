<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
  use HasFactory, SoftDeletes;

  protected $fillable = [
    'order_number',
    'table_id',
    'table_number',
    'customer_name',
    'customer_mobile',
    'subtotal',
    'tax',
    'discount',
    'total',
    'status',
    'payment_status',
    'payment_method',
    'notes',
    'confirmed_at',
    'prepared_at',
    'served_at',
    'completed_at',
  ];

  protected $casts = [
    'subtotal' => 'decimal:2',
    'tax' => 'decimal:2',
    'discount' => 'decimal:2',
    'total' => 'decimal:2',
    'confirmed_at' => 'datetime',
    'prepared_at' => 'datetime',
    'served_at' => 'datetime',
    'completed_at' => 'datetime',
  ];

  /**
   * Generate unique order number
   * Uses withTrashed() to include soft-deleted orders so their numbers are never reused.
   * Retries until a truly unique number is found (handles race conditions).
   */
  public static function generateOrderNumber(): string
  {
    $prefix = 'ORD';
    $date = now()->format('Ymd');

    do {
      // Include soft-deleted orders so we never reuse a number that was already taken
      $lastOrder = self::withTrashed()
        ->whereDate('created_at', now()->toDateString())
        ->orderBy('id', 'desc')
        ->first();

      $sequence = $lastOrder ? (int) substr($lastOrder->order_number, -4) + 1 : 1;
      $orderNumber = $prefix . $date . str_pad($sequence, 4, '0', STR_PAD_LEFT);

      // Keep incrementing until we find one that doesn't exist at all (including trashed)
    } while (self::withTrashed()->where('order_number', $orderNumber)->exists());

    return $orderNumber;
  }


  /**
   * Relationship with OrderItems
   */
  public function items()
  {
    return $this->hasMany(OrderItem::class);
  }

  /**
   * Relationship with Table
   */
  public function table()
  {
    return $this->belongsTo(Table::class);
  }

  /**
   * Get status badge color
   */
  public function getStatusBadgeAttribute(): string
  {
    return match ($this->status) {
      'pending' => 'warning',
      'confirmed' => 'info',
      'completed' => 'success',
      'cancelled' => 'danger',
      default => 'secondary',
    };
  }

  /**
   * Get payment status badge color
   */
  public function getPaymentBadgeAttribute(): string
  {
    return $this->payment_status === 'paid' ? 'success' : 'warning';
  }
}