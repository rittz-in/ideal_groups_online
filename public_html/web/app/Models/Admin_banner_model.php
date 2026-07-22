<?php

namespace App\Models;

use CodeIgniter\Model;

class Admin_banner_model extends Model
{
    protected $table      = 'banners';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'id',
        'title',
        'slug_url',
        'sub_title',
        'button_link',
        'button_text',
        'image',
        'page',
        'banner_start',
        'banner_end',
        'order_by',
        'is_active',
        'created_at',
        'updated_at',
        'created_by',
        'is_deleted',
        'is_page',
    ];
}
