<?php

namespace App\Controllers;

class Settings extends BaseController
{
    public function index()
    {
        $this->data['page_name']  = 'settings';
        $this->data['page_title'] = lang('Common.settings');
        $this->data['path_url']   = 'settings';
        $where      = ['id' => '1',];
        $this->data['settings_data'] = $this->settings_model->where($where)->first();
        $this->data['settings_data']['logo_url'] = base_url()."/assets/uploads/settings/".$this->data['settings_data']['logo'];
        $this->load_view('admin/settings', lang('Common.settings'), 'admin/parent');
    }

    public function add(){

        $this->data['page_name']  = 'add_settings';
        $this->data['page_title'] = lang('Common.add_settings');
        $this->data['path_url']   = 'settings';
    	

        $this->data['page_title'] = lang('Common.settings');
        $where      = ['id' => '1',];
	  	$this->data['settings_data'] = $this->settings_model->where($where)->first();
        $this->data['settings_data']['logo_url'] = base_url()."/assets/uploads/settings/".$this->data['settings_data']['logo'];

        $settings_id = $this->data['settings_data']['id'];
        $input   = $this->validate([
            'website_title'      => ['label' => lang('Common.website_title'), 'rules'=>'required'],
            'email'      => ['label' => lang('Common.email'), 'rules'=>'required'],
            'phone'      => ['label' => lang('Common.phone'), 'rules'=>'required'],
            // 'logo'      => ['label' => lang('Common.logo'), 'rules'=>'required'],
        ]); 


        if (empty($this->request->getVar())) {
            $this->load_view('admin/settings', lang('Common.settings'), 'admin/parent');
        }
        if (!$input) {
            $this->data['validation'] = $this->validator;
            $this->load_view('admin/settings', lang('Common.settings'), 'admin/parent');
        } else {
    		
            $data = [
                'website_title'         => $this->request->getVar('website_title') ? $this->request->getVar('website_title') : "",
                'email'         => $this->request->getVar('email') ? $this->request->getVar('email') : "",
                'contact'         => $this->request->getVar('phone') ? $this->request->getVar('phone') : "",
                'address'       => $this->request->getVar('address') ? $this->request->getVar('address') : "",
                'facebook'      => $this->request->getVar('facebook') ? $this->request->getVar('facebook') : "",
                'twitter'      => $this->request->getVar('twitter') ? $this->request->getVar('twitter') : "",
                'linkedin'      => $this->request->getVar('linkedin') ? $this->request->getVar('linkedin') : "",
                'youtube'      => $this->request->getVar('youtube') ? $this->request->getVar('youtube') : "",
                'prayer_request_email'      => $this->request->getVar('prayer_request_email') ? $this->request->getVar('prayer_request_email') : "",
                'contact_form'      => $this->request->getVar('contact_form') ? $this->request->getVar('contact_form') : "",
                // 'copyright'      => $this->request->getVar('copyright') ? $this->request->getVar('copyright') : "",
            ];

            if(!empty($_FILES["logo"]["name"]) && $_FILES["logo"]["name"] != "") {
                $path = FC_PATH."assets/uploads/settings/";
                $logo_name = time().'_'.preg_replace('/\s+/', '_', $_FILES['logo']['name']);
                $logo_name = str_replace(' ', '-', $logo_name); // Replaces all spaces with hyphens.
                $logo_name = preg_replace('/[^A-Za-z0-9\-.]/', '', $logo_name); // Removes special chars.
                move_uploaded_file($_FILES["logo"]["tmp_name"], $path.$logo_name);
                $data['logo'] = $logo_name;
            } else if ($this->request->getVar('logo')) {
                $data['logo'] = $this->request->getVar('logo');
            }

            $web_update = $this->settings_model->where(array('id' => trim($settings_id)))->set($data)->update();
            
            if($web_update){
                $this->session->setFlashdata('success', lang('Common.successfully_updated'));
                return redirect()->to(route_to('settings_url'));
            }else{
                $this->session->setFlashdata('error', lang('Common.went_wrong'));
                return redirect()->to(route_to('settings_url'));
            }
            
        }
    }

}
