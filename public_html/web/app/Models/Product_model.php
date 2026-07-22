<?php

namespace App\Models;

use CodeIgniter\Model;

class Product_model extends Model
{
    protected $table      = 'products';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'id',
        'title',
        'slug_url',
		'category_id',
        'image',
		'is_active',
		'is_deleted',
    ];
}
