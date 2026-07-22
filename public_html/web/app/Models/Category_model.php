<?php

namespace App\Models;

use CodeIgniter\Model;

class Category_model extends Model
{
    protected $table      = 'category';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'id',
        'title',
        'slug_url',
		'image',
        'cat_img',
        'quality',
        'qty',
        'price',
		'is_active',
		'is_deleted',
    ];
}
