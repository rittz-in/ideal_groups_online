<?php

namespace App\Models;

use CodeIgniter\Model;

class Settings_model extends Model
{
    protected $table      = settings;
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'id',
        'website_title',
        'email',
        'contact',
        'address',
        'logo',
        'facebook',
        'twitter',
        'instagram',
        'youtube',
        'prayer_request_email',
        'contact_form',
    ];
}
