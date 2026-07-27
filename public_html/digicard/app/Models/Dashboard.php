<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dashboard extends Model
{
    use HasFactory;

    protected $fillable = ['username', 'designation', 'phone_no', 'email', 'website', 'address', 'color', 'logo', 'created_by', 'BrandName','slogan','banner'];
}
