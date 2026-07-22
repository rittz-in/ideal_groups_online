<?php

namespace App\Models;

use CodeIgniter\Model;

class Contact_model extends Model
{
    protected $table      = 'contacts';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'id',
        'name',
        'email',
		'phone',
        'message',
		'is_active',
		'is_deleted'
    ];
}
