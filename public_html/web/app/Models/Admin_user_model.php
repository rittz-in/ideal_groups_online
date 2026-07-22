<?php

namespace App\Models;

use CodeIgniter\Model;

class Admin_user_model extends Model
{
    protected $table      = admin_user;
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'id',
        'password',
        'email',
        'first_name',
        'last_name',
        'gender',
        'dob',
        'mobile',
        'mobile2',
        'join_date',
        'profile_pic',
        'admin_user_type',
        'date',
        'address',
        'country',
        'region',
        'city',
        'residential_address',
        'business_address',
        'status',
        'isApprove',
        'role',
        'encryption_admin_user_id',
        'is_deleted',
        'role_resources',
    ];
}
