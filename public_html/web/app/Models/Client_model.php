<?php

namespace App\Models;

use CodeIgniter\Model;

class Client_model extends Model
{
    protected $table      = 'clients';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'id',
        'title',
        'slug_url',
		'image',
		'is_active',
		'is_deleted',
    ];
}
