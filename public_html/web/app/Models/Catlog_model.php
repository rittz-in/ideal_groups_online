<?php

namespace App\Models;

use CodeIgniter\Model;

class Catlog_model extends Model
{
    protected $table      = 'catlog_information';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'id',
        'cat_id',
        'fname',
        'lname',
        'mobile',
        'email',
        'quality',
        'qty',
    ];
}
