<?php
namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class Auth implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        
        if (in_array('is_ajax', $arguments) && in_array('is_cron_job', $arguments)) {

        } else {
            if (session()->get('userdata') && !in_array('is_ajax', $arguments)) {
                session()->set('previous_url', current_url());
            }
            if (!session()->get('userdata')) {
                return redirect()->to(route_to('login_url'));
            }

            if (!empty($arguments)) {
                if (session()->get('userdata')) {
                    $role_permission = session()->get('userdata')['role_permission'];
                    foreach ($arguments as $key => $value) {
                        if (strpos($value, "role") === 0) {
                            $role_id = explode('|', $value)[1];
                            if ($role_id != '') {
                                if (!in_array($role_id, $role_permission)) {
                                    session()->setFlashdata('error', 'Unauthorized Request!');
                                    return redirect()->to('/');
                                }
                            }
                        }
                    }
                }
            }
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
    }
}
