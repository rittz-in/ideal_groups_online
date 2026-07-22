<?php

namespace App\Controllers;


use App\Models\Admin_user_model;
use App\Models\Admin_banner_model;
use App\Models\Main_model;
use App\Models\Settings_model;
use App\Models\Home_settings_model;
use App\Models\Category_model;
use App\Models\Product_model;
use App\Models\Client_model;
use App\Models\Contact_model;
use App\Models\Catlog_model;



use CodeIgniter\Controller;




use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var array
     */
    protected $helpers = ['url', 'form', 'text', 'cookie', 'common'];

    /**
     * Constructor.
     */
    //public $data = array();

    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);
        //--------------------------------------------------------------------
        // Preload any models, libraries, etc, here.
        //--------------------------------------------------------------------
        // E.g.: $this->session = \Config\Services::session();
        $this->session = \Config\Services::session();
        $this->encrypter = \Config\Services::encrypter();
        //$this->parser    = \Config\Services::parser();
        helper($this->helpers);
        //$this->request->setLocale('en');
        $locale = 'gu';

        $this->main_model = new Main_model();
        $this->settings_model = new Settings_model();
		$this->home_settings_model = new Home_settings_model();
        $this->admin_user_model = new Admin_user_model();
        $this->admin_banner_model = new Admin_banner_model();
        $this->admin_category_model = new Category_model();
        $this->admin_product_model = new Product_model();
        $this->admin_client_model = new Client_model();
        $this->admin_contact_model = new Contact_model();
        $this->catlog_model = new Catlog_model();

        
        
        
        
        
        // $this->admin_all_banner_model = new Admin_all_banner_model();
        

       

       
        $this->data['site_identity'] = $this->main_model->site_identity();
        $this->data['base_url'] = base_url() . '/';
        $this->data['site_logo'] = base_url() . '/assets/uploads/settings/' . $this->data['site_identity']['logo'];
        $this->data['image_tool_path'] = $this->data['base_url'] . "image-tool/index.php?src=";
        $this->data['upload_image_path'] = $this->data['base_url'] . "assets/uploads/";
        $this->data['assets_path'] = $this->data['base_url'] . "assets/";
        $this->data['admin_assets_path'] = $this->data['base_url'] . "assets/admin/";
        $this->data['website_title'] = $this->data['site_identity']['website_title'];
        $this->data['facebook'] = $this->data['site_identity']['facebook'];
        $this->data['instagram'] = $this->data['site_identity']['instagram'];
        $this->data['twitter'] = $this->data['site_identity']['twitter'];
        $this->data['youtube'] = $this->data['site_identity']['youtube'];
        $this->data['address'] = $this->data['site_identity']['address'];
        $this->data['contact'] = $this->data['site_identity']['contact'];
        $this->data['email'] = $this->data['site_identity']['email'];
        $this->data['contact_email'] = $this->data['site_identity']['contact_form'];
        $this->data['prayer_request_email'] = $this->data['site_identity']['prayer_request_email'];
       // $this->data['site_url'] = $this->data['site_identity']['site_url'];
      //  $this->data['upload_url'] = $this->data['site_identity']['site_url'] . //'upload_data/';
        $this->data['upload_assets_url'] = $this->upload_assets_url();
        $this->data['commonBanners'] = $this->admin_banner_model->query('SELECT * FROM `banners` where is_deleted="no"  and is_active="active" ORDER By id DESC')->getResultArray();


        $this->data['session_data'] = session()->get();
        $this->data['session_flash'] = session()->getFlashdata();

        $this->data['session_userdata'] = session()->get('userdata');
        $this->data['UserData'] = $this->admin_user_model->where('id',$this->data['session_userdata']['user_id'])->get()->getRowArray();

        if (!isset($this->data['session_userdata']) && empty($this->data['session_userdata'])) {
            $this->data['session_userdata']['role_permission'] = [];
        }
        $this->data['is_logged_in'] = (isset($this->data['session_data']['userdata'])) ? true : false;

        $this->data['total_currency'] = array(
            'INR' => 1,
        );
        if (isset($this->data['session_data']['currency']) && $this->data['session_data']['currency'] == '') {
            session()->set('currency', 'INR');
        } elseif (!isset($this->data['session_data']['currency'])) {
            session()->set('currency', 'INR');
        }
        $this->data['session_currency'] = session()->get('currency');
        $this->data['IPAddress'] = $request->getIPAddress();
        $this->data['request_method'] = $request->getMethod();


        $this->data['settings'] = $this->settings_model->select("website_title, logo, contact, email, address, facebook, twitter, instagram, youtube")->find()[0];

        $this->data["settings"]["logo_url"] = $this->data["settings"]["logo"] ? $this->data['upload_image_path'] . "settings/" . $this->data["settings"]["logo"] : "";


        $log = [];
        $log['session_id'] = session_id();
        $log['server'] = json_encode($_SERVER);
        $log['url'] = current_url();
        $log['get_post'] = json_encode(array('get' => $this->request->getGet(), 'post' => $this->request->getPost()));
        $log['created_at'] = date('Y-m-d h:i:s');
        $log['user_id'] = ($this->data['is_logged_in']) ? $this->data['session_userdata']['user_id'] : '';
        $log['ip'] = $_SERVER['REMOTE_ADDR'];
        $insert = $this->main_model->in_track_log($log);
    }

    public function get_slug($title)
    {
        return url_title($title, '-', true);
    }

    public function upload_assets_url()
    {
        return array(
            'product_image' => $this->data['upload_url'] . 'product/images/',
        );
    }

    public function date_format($date)
    {
        return date("d M Y, h:i a", strtotime($date));
    }

    public function encrypt($string)
    {
        return bin2hex($this->encrypter->encrypt($string));
    }

    public function decrypt($string)
    {
        return $this->encrypter->decrypt(hex2bin($string));
    }

    public function load_view($child_view, $header, $layout = null)
    {
        if ($header) {
            $this->data['header'] = $header;
        }
        if ($layout) {
            $this->data['child_view'] = $child_view;
            return view($layout, $this->data);
        } else {
            echo view($child_view, $this->data);
        }
    }

    public function send_mail($from = '', $to = array(), $subject = '', $message = array(), $attachments = array())
    {
        $email = \Config\Services::email();
        $email->setFrom('dev.decentinfoways@gmail.com', $this->data['website_title']);
        // $email->setFrom('vcprajapati.mscit@gmail.com', $this->data['site_identity']['user_nicename']);
        foreach ($to as $key => $value) {
            $email->setTo($value);
        }
        // $email->setSubject($this->data['site_identity']['user_nicename'] . ' : ' . $subject);
        $email->setSubject($this->data['website_title'] . ' : ' . $subject);
        $email->setMessage($this->mail_template($message, $subject));
        foreach ($attachments as $key => $value) {
            $email->attach($value['path'], 'attachment', $value['name']);
        }

        if ($email->send()) {
            return 'Email successfully sent';
        } else {
            $data1 = $email->printDebugger(['headers']);
            print_r($data1);
        }
    }

    public function mail_template($message, $subject)
    {
        $str = '<!--[if (gte mso 9)|(IE)]>
            <style type="text/css">
            a{
                font-weight: normal !important;
                text-decoration: none !important;
                border-radius:30px !important;
            }
            </style>
            <![endif]-->
            <style>
                html,body { padding: 0; margin:0; }
            </style>
            <div style="font-family:Arial,Helvetica,sans-serif; line-height: 1.5; font-weight: normal; font-size: 15px; color: #2F3044; min-height: 100%; margin:0; padding:0; width:100%; background-color:#edf2f7">
                <table align="center" border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse;margin:0 auto; padding:0; max-width:600px" width="100%">
                    <tbody>
                        <tr>
                            <td align="center" style="text-align:center; padding: 40px" valign="center">
                                <a href="' . $this->data['site_url'] . '" rel="noopener" target="_blank">
                                    <!--<img alt="' . $this->data['website_title'] . '" src="' . $this->data['site_url'] . 'writable/uploads/_logo.jpg" style="height: 45px"/>-->
                                    <h3>' . $this->data['website_title'] . '</h3>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td align="left" valign="center">
                                <div style="text-align:left; margin: 0 20px; padding: 40px; background-color:#ffffff; border-radius: 6px">
                                    <div style="padding-bottom: 30px; font-size: 17px;">
                                        <strong>
                                            Hello ' . $message['username'] . '!
                                        </strong>
                                    </div>
                                    ' . $message['message'] . '
                                    <!--<div style="padding-bottom: 20px">
                                        Your Keenthemes password was just changed.
                                    </div>
                                    <div style="padding-bottom: 40px">
                                        If you didn\'t change your password, please contact our
                                        <a href="#" rel="noopener" style="text-decoration:none;color: #009EF7; font-weight: bold" target="_blank">
                                            support team
                                        </a>
                                        . Your security is very important to us!
                                    </div>-->
                                    <div style="padding-bottom: 10px">
                                        Kind regards,
                                        <br/>
                                        The ' . $this->data['website_title'] . ' Team.
                                        <tr>
                                            <td align="center" style="font-size: 13px; text-align:center;padding: 20px; color: #6d6e7c;" valign="center">
                                                <!--<p>
                                                    6, Prakashnagar Society, Maninagar, Ahmedabad.
                                                </p>-->
                                                <p>
                                                    Copyright ©
                                                    <a href="' . $this->data['site_url'] . '" rel="noopener" target="_blank">
                                                        ' . $this->data['website_title'] . '
                                                    </a>
                                                    .
                                                </p>
                                            </td>
                                        </tr>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>';
        return $str;
    }
}
