<?php

namespace App\Controllers;


class Home extends BaseController
{
    public function index()
    {

        $this->data['page_name'] = 'home_page';
        $this->data['page_title'] = 'Home';
        $from = 'xxxx@gmail.com';
        $to = array('teamindusdelhi@gmail.com');
        $subject = 'Your Account is Created!';
        $message = array(
            'username' => 'Team',
            'message' => 'We are happy to have you with us. You account is created. simply click on this link, login to your account.',
            //'button'   => array('text' => 'LOGIN HERE', 'link' => $this->data['base_url'] . 'login'),
        );
        //$this->send_mail($from, $to, $subject, $message);

        $this->load_view('admin/main_page', 'Dashboard', 'admin/parent');
    }

    public function login($slug = '')
    {


        //echo $this->request->getVar('username');die;
        $this->data['page_name'] = 'login';
        $this->data['page_title'] = 'Login';
        $this->data['path_url'] = 'login';

        $this->data['type'] = $slug;

        if ($this->data['type'] == 'agent') {
            $this->data['page_title'] = 'Agent Login';
        }

        $input = $this->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        if (!$input) {
            $this->data['validation'] = $this->validator;
            $this->load_view('admin/login', $header, '');
        } else {

            $email = $this->request->getVar('email');
            $password = $this->request->getVar('password');

            $checklogin = $this->main_model->login($email, $password, $this->data['type']);
            if ($checklogin['logged_in'] == true) {
                $this->session->set("userdata", $checklogin['data']);
                //return redirect()->to('/admin/');
                if (isset($this->data['session_data']['previous_url'])) {
                    return redirect()->to($this->data['session_data']['previous_url']);
                } else {
                    return redirect()->to('/admin/');
                }
            } else {
                $this->session->setFlashdata('error', 'Invalid user!');
                if ($this->data['type'] == 'agent') {
                    return redirect()->to(route_to('agent_login_url'));
                } else {
                    return redirect()->to('/admin/login');
                }
            }
        }
    }

    public function registration($value = '')
    {
        //echo $this->request->getVar('username');die;
        $this->data['page_name'] = 'registration';
        $this->data['page_title'] = 'Registration';
        $this->data['path_url'] = 'registration';

        $this->data['type'] = $value;

        if ($this->data['type'] == 'agent') {
            $is_agent = '1';
            $this->data['page_title'] = 'Agent Registration';
        } else {
            $is_agent = '';
        }
        if (isset($is_agent) && $is_agent == '1') {
            $input = $this->validate([
                'first_name' => ['label' => 'First name', 'rules' => 'required'],
                'last_name' => ['label' => 'Last name', 'rules' => 'required'],
                'email' => ['label' => 'Email', 'rules' => 'required|valid_email|is_unique[' . admin_users . '.user_email]'],
                'mobile_number' => ['label' => 'Mobile Number', 'rules' => 'required'],
                'password' => ['label' => 'Password', 'rules' => 'required'],
                'confirm_password' => ['label' => 'Coinfirm Password', 'rules' => 'required|matches[password]'],
            ]);
        } else {
            $input = $this->validate([
                'first_name' => ['label' => 'First name', 'rules' => 'required'],
                'last_name' => ['label' => 'Last name', 'rules' => 'required'],
                'email' => ['label' => 'Email', 'rules' => 'required|valid_email|is_unique[' . tbl_web_user . '.user_email]'],
                'mobile_number' => ['label' => 'Mobile Number', 'rules' => 'required'],
                'password' => ['label' => 'Password', 'rules' => 'required'],
                'confirm_password' => ['label' => 'Coinfirm Password', 'rules' => 'required|matches[password]'],
            ]);
        }

        if (empty($this->request->getVar())) {
            $this->load_view('admin/registration', $header, 'admin/parent');
        }
        if (!$input) {
            $this->data['validation'] = $this->validator;
            $this->load_view('admin/registration', $header, 'admin/parent');
        } else {

            $first_name = $this->request->getVar('first_name');
            $last_name = $this->request->getVar('last_name');
            $email = $this->request->getVar('email');
            $mobile_number = $this->request->getVar('mobile_number');
            $password = $this->request->getVar('password');

            $encryption_key = "C39Ig4jazeQSSUYonBtASg==";
            $iv = 'kvmjcu94885xfg6h';

            $password_ = openssl_encrypt($password, AES_256_CBC, $encryption_key, 0, $iv);

            if (isset($is_agent) && $is_agent == '1') {
                $data = [
                    'user_fname' => $first_name,
                    'user_lname' => $last_name,
                    'user_email' => $email,
                    'user_password' => $password_,
                    'encryption_key' => $encryption_key,
                    'iv' => $iv,
                    'CreatedDate' => date('Y-m-d h:i:s'),
                    'user_role_name' => 'agent',
                    'user_role' => '3',
                    'status' => 'active',
                    'first_time_login' => 'no',
                    'password_reset_option' => 'yes',
                ];
                $register = $this->admin_users_model->insert($data);
            } else {
                $data = [
                    'first_name' => $first_name,
                    'last_name' => $last_name,
                    'user_email' => $email,
                    'user_password' => $password_,
                    'encryption_key' => $encryption_key,
                    'iv' => $iv,
                    'status' => 'active',
                    'user_create_date' => date('Y-m-d h:i:s'),
                ];
                $register = $this->web_user_model->insert($data);
            }
            if ($register) {
                $sub_message = '
                <tr>
                    <td colspan="2" style="padding: 15px 30px 0px;mso-line-height-rule:exactly;">
                        <p style="color: #5C5E62;font-size: 16px;margin: 0;text-align:center;">
                            <span style="font-weight: bold;font-size: 30px;">Thank you for creating an account with ' . $this->data['website_title'] . '</span><br/>
                        </p>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="padding: 20px 0px 0px;mso-line-height-rule:exactly; ">
                        <p style="border-top: 2px solid #B0A378;margin: 0;line-height: 0.15;mso-line-height:0.15;">&nbsp;</p>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="padding: 15px 30px 0px;font-size: 18px;mso-line-height-rule:exactly;">
                        <p style="font-style: normal;font-weight: normal;font-size: 14px;text-align: justify;color: #5C5E62;">
                            Your username is: <a style="color:#B0A378;" href="mailto:' . $email . '">' . $email . '</a><br/><br/>We are happy to have you with us. To book a tour, simply click on this link, login to your account and book a tour!
                        </p>
                    </td>
                </tr>
                <tr>
                    <td align="center" colspan="2" style="padding:30px 30px 30px;">
                        ' . mail_button(array('text' => 'LOGIN HERE', 'url' => $this->data['site_url'] . 'admin/login')) . '
                    </td>
                </tr>';

                $popular_tours = $this->tour_model->popular_tours();
                $popular_tours_ = [
                    'tour_data' => $popular_tours,
                    'site_url' => $this->data['site_url'],
                    'tour_banner_image' => $this->data['upload_assets_url']['tour_banner_image'],
                ];
                $sub_message .= $this->main_model->popular_tours($popular_tours_);
                $from = 'xxxx@gmail.com';
                $to = array($email);
                $subject = lang("Mailer_subjects.registration");
                $message = array(
                    'username' => $first_name . ' ' . $last_name,
                    'message' => $sub_message,
                );
                $this->send_mail($from, $to, $subject, $message);
                return redirect()->to('/admin/');
            } else {
                $this->session->setFlashdata('error', 'Something went wrong!');
                return redirect()->to(route_to('registration_url'));
            }
        }
    }

    public function logout()
    {
        $this->session->remove('userdata');
        //return redirect()->to(route_to('login_url'));
        return redirect()->back();
    }

    public function change_currency()
    {
        $this->session->set("currency", $this->request->getVar('currency'));
    }

    public function search($value = '')
    {
        $this->data['page_name'] = 'search';
        $this->data['page_title'] = 'Search';
        $this->data['path_url'] = 'search';
        $this->data['search'] = $_GET['search'];
        $where = " Title LIKE '%" . $this->data['search'] . "%'  ";
        $this->data['tours_data'] = $this->tour_model->where($where)->get()->getResultArray();
        //print_r($this->tour_model->getLastQuery());die;
        $this->load_view('admin/search', $header, 'admin/parent');
    }

    public function reset_password()
    {
    
        $this->data['page_name'] = 'reset_password';
        $this->data['page_title'] = 'Reset Password';
        $this->data['path_url'] = '';

        $userID = $_SESSION['userdata']['user_id'];
        $where = ['id' => $userID];
        $old_pass = $this->request->getVar('old_password');

        /*$user_details = $this->admin_banner_model->query('SELECT * FROM `banners` where is_deleted="no"  and is_active="active" ORDER By id DESC')->getResultArray();*/
        $user_details = $this->admin_user_model->where($where)->get()->getRowArray();


        $encryption_key = "C39Ig4jazeQSSUYonBtASg==";
        $iv = 'kvmjcu94885xfg6h';
        $encrypted = openssl_encrypt($old_pass, AES_256_CBC, $encryption_key, 0, $iv);

        /*validation for input*/
        if (!empty($this->request->getVar())) {

            $input = $this->validate([
                'old_password' => ['label' => 'Old Password Required', 'rules' => 'required'],
                'new_password' => ['label' => 'New Password Requires', 'rules' => 'required'],
                'confirm_password' => ['label' => 'Confirm Password Required', 'rules' => 'required'],
            ]);

         
            if (!$input) {
                $this->load_view('admin/reset_password', 'Reset Password', 'admin/parent');
            } else {

                /*Check Old Password*/
                if ($user_details['password'] == $encrypted) {

                    /*Encrypting new Password*/
                    $new_encrypted_pass = openssl_encrypt($this->request->getVar('new_password'), AES_256_CBC, $encryption_key, 0, $iv);

                    $data = [
                        'password' => $new_encrypted_pass,
                    ];
                    
                    $reset_password_data = $this->admin_user_model->set($data)->update();
                    $this->session->setFlashdata('success', lang('Common.successfully_saved'));
                    return redirect()->to(route_to('reset_password_url'));
                } else {
                   
                    $this->session->setFlashdata('error', lang('Common.wrong_old_pass'));
                    $this->load_view('admin/reset_password', 'Reset Password', 'admin/parent');
                }
            }

        } else {
            $this->load_view('admin/reset_password', 'Reset Password', 'admin/parent');
        }
    }

    public function client_profile()
    {
        $this->data['page_name'] = 'client_profile';
        $this->data['page_title'] = 'Admin Profile';
        $this->data['path_url'] = '';

        $where = ['is_client' => 'yes'];
        $clientData = $this->admin_user_model->where($where)->get()->getRowArray();

        $userID = $clientData['id'];
        $emailID = $clientData['email'];
        $encryption_key = "C39Ig4jazeQSSUYonBtASg==";
        $iv = 'kvmjcu94885xfg6h';
        $password = openssl_decrypt($clientData['password'], AES_256_CBC, $encryption_key, 0, $iv);
        $this->data['user_id'] = $userID;
        $this->data['user_email'] = $emailID;
        $this->data['user_pass'] = $password;


        /*$user_details = $this->admin_banner_model->query('SELECT * FROM `banners` where is_deleted="no"  and is_active="active" ORDER By id DESC')->getResultArray();*/
     /*   $user_details = $this->admin_user_model->where($where)->get()->getRowArray();*/

        /*validation for input*/
        if (!empty($this->request->getVar())) {
            $input = $this->validate([
                'email' => ['label' => 'Email Required', 'rules' => 'required'],
                'new_password' => ['label' => 'New Password Requires', 'rules' => 'required'],
            ]);

            if (!$input) {
                $this->load_view('admin/client_profile', 'Client Profile', 'admin/parent');
            } else {
                
                    $new_encrypted_pass = openssl_encrypt($this->request->getVar('new_password'), AES_256_CBC, $encryption_key, 0, $iv);

                    $data = [
                        'email' => $this->request->getVar('email'),
                        'password' => $new_encrypted_pass,
                    ];

                    $reset_password_data = $this->admin_user_model->where(array('id' => $clientData['id']))->set($data)->update();
                    $this->session->setFlashdata('success', lang('Common.successfully_saved'));
                    return redirect()->to(route_to('client_profile_url'));
            }

        } else {
            $this->load_view('admin/client_profile', 'Admin Profile', 'admin/parent');
        }
    }
}
