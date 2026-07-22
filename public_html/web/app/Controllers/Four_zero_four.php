<?php

namespace App\Controllers;

class Four_zero_four extends BaseController
{
    public function index()
    {
        $this->data['page_name']  = '404';
        $this->data['page_title'] = '404';
        
        $this->load_view('admin/404', $header, '');
    }

}
