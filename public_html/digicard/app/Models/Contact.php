<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;
    protected $table = 'contacts';
    protected $fillable = [
        'branch_name', 'address', 'phone', 'email', 'map', 'time_status', 'sunday_to', 'sunday_from', 'monday_to', 'monday_from', 'tuesday_to', 'tuesday_from', 'wednesday_to', 'wednesday_from', 'thursday_to', 'thursday_from', 'friday_to', 'friday_from', 'saturday_to', 'saturday_From'
    ];
}
