<?php

namespace App\Models;

use CodeIgniter\Model;

class Home_settings_model extends Model
{
    protected $table      = 'home_page_settings';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'id',
        'title',
		'description',
		'online_giving_title',
		'online_giving_image',
		'online_giving_url',
		'vlcc_events_title',
		'vlcc_events_image',
		'vlcc_events_url',
		'visitor_welcome_center_title',
		'visitor_welcome_center_image',
		'visitor_welcome_center_url',
		'send_prayer_request_title',
		'send_prayer_request_image',
		'send_prayer_request_url',
    ];
}
