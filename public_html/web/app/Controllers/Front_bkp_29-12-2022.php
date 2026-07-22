<?php

namespace App\Controllers;
use App\Helpers\MailHelper;
use App\Libraries\Mailer;

class Front extends BaseController
{
    public function index()
    {
            $this->data['page_name'] = "Home";
            $this->data['page_title'] = "Home";
            $this->data['page_url'] = "index";

            $where = ['is_active'=>'active','is_deleted'=>'no'];
            $this->data['cat_limit1'] = $this->admin_category_model->where($where)->limit(1)->first();
            $this->data['cat_limit2'] = $this->admin_category_model->where($where)->limit(1,1)->first();
            $this->data['categories'] = $this->admin_category_model->where($where)->limit(4,2)->find();
            $this->data['products'] = $this->admin_product_model->where($where)->limit(6)->find();
            $this->load_view('home', 'Home', 'parent'); 
    }

    public function about()
    {
            $this->data['page_name'] = "About";
            $this->data['page_title'] = "About";
            $this->data['page_url'] = "about-us";
            $this->load_view('about', 'about', 'parent'); 
    }

    public function products()
    {
            $this->data['page_name'] = "Products";
            $this->data['page_title'] = "Products";
            $this->data['page_url'] = "products";

            $where = ['is_active'=>'active','is_deleted'=>'no'];

        //     $this->admin_product_model = new Product_model();
            $this->data['categories'] = $this->admin_category_model->where($where)->findAll();
            $this->load_view('products', 'products', 'parent'); 
    }

    public function product_list($id)
    {
        $this->data['page_name'] = "Products_list";
        
        $this->data['page_url'] = "products_list";

        $where = ['id'=>$id];
        $category_id = ['category_id'=>$id];
        $this->data['category_name'] = $this->admin_category_model->where($where)->first();

        $this->data['products'] = $this->admin_product_model->where($category_id)->orderBy("title","ASC")->findAll();

        $this->data['page_title'] = $this->data['category_name']['title'];
        $this->load_view('products_list', 'products_list', 'parent'); 

        
    }


    public function category_form($id)
    {

        $data = [
                'cat_id' => $id,
                'fname' => $this->request->getVar('fname'),
                'lname' => $this->request->getVar('lname'),
                'mobile' => $this->request->getVar('mobile'),
                'email' => $this->request->getVar('email'),
                'quality' => $this->request->getVar('quality'),
                'qty' => $this->request->getVar('qty'),
            ];

            $insert_catlog = $this->catlog_model->insert($data);
            if($insert_catlog)
            {
                $site_setting = $this->main_model->site_identity();
                $mailBody = MailHelper::buildcatlogMail($data, $site_setting);

                $from = $site_setting['smtp_email'];
                $to = ['dev.decentinfoways@gmail.com'];
                $subject = $form_title;
                $message = array(
                        'username' => $data['fname'],
                        'message' => $mailBody,
                        'button' => [],
                );
                $this->send_mail($from, $to, $subject, $message);
                $this->session->setFlashdata('success', 'Catlog Information Successfullly Submitted');
                echo json_encode(['type'=>'success','message'=>'Catlog Information Successfullly Submitted']);
                
                

            }

            
            
            



    }



    public function clients()
    {
            $this->data['page_name'] = "Clients";
            $this->data['page_title'] = "Clients";
            $this->data['page_url'] = "clients";
            $where = ['is_active'=>'active','is_deleted'=>'no'];    
            $this->data['clients'] = $this->admin_client_model->where($where)->findAll();    
            $this->load_view('clients', 'clients', 'parent'); 
    }

    public function contact()
    {
            $this->data['page_name'] = "Contact";
            $this->data['page_title'] = "Contact";
            $this->data['page_url'] = "contact";
            $this->load_view('contact', 'contact', 'parent'); 
    }

        public function contact_details()
        {
                $data = [
                        'name' => $this->request->getvar('name'),
                        'email' => $this->request->getvar('email'),
                        'phone' => $this->request->getvar('phone'),
                        'message'=> $this->request->getvar('message'),
                        
                ];

                  $site_setting = $this->main_model->site_identity();

                    $mailBody = MailHelper::buildContactUsMail($data, $site_setting);
                    
                    $from = $site_setting['smtp_email'];

                      
                    //$to = [$mailTo['mail_to']];
                    $to = ['dev.decentinfoways@gmail.com'];

                    
                    $subject = 'New Contact';
                    $message = array(
                        'username' => $data['name'],
                        'message' => $mailBody,
                        'button' => [],
                    );

                    
                $this->send_mail($from, $to, $subject, $message);
                   

                $insert_contact = $this->admin_contact_model->insert($data);
                
                if($insert_contact)
                {
                        $this->session->setFlashdata('success', lang('Common.successfully_saved'));
                        return redirect()->to(route_to('contact_page_url'));

                }
                else
                {
                        $this->session->setFlashdata('success', lang('Common.successfully_saved'));
                        return redirect()->to(route_to('contact_page_url'));

                }

                    
        }


   
}   
?> 
