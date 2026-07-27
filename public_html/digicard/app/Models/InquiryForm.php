<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InquiryForm extends Model
{
    use HasFactory;
    protected $table = 'inquiry_form';
    protected $fillable = [
        'name', 'phone', 'email', 'topic', 'Description','created_by'
    ];
}
