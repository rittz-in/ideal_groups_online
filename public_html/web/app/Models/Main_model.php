<?php

namespace App\Models;

use CodeIgniter\Model;

class Main_model extends Model
{
    public function site_identity()
    {
        $builder = $this->db->table(settings);
        return $builder->get()->getRowArray();
    }

    public function in_track_log($data = [])
    {
        if (count($data) > 0) {
            $builder = $this->db->table('track_log');
            $builder->insert($data);
        }
    }

    public function get_resources($_role_resources_ = '')
    {
        if ($_role_resources_ != '') {
            $get_parent = $this->db->query('SELECT GROUP_CONCAT( DISTINCT(`parent_id`)) AS "role_resources" FROM ' . admin_links . ' WHERE `id` IN (' . $_role_resources_ . ')')->getRowArray();
            return ',' . $get_parent['role_resources'];
        } else {
            return '';
        }
    }

    public function get_admin_links()
    {
        $builder = $this->db->table(admin_links);
        $builder->select('*');
        return $builder->get()->getResultArray();
    }

    public function role_resources($user_role)
    {
        $builder = $this->db->table(roles);
        $builder->select('*');
        $builder->where('id', $user_role);
        $data = $builder->get()->getRowArray();
        if (!empty($data)) {
            $role_permission = explode(',', $data['role_resources']);
        } else {
            $role_permission = [];
        }
        return $role_permission;
    }

    public function login($username = '', $password = '', $type = '')
    {
        $data_return = array();
        if ($username != '' && $password != '') {
            $encryption_key = "C39Ig4jazeQSSUYonBtASg==";
            $iv             = 'kvmjcu94885xfg6h';
            $encrypted      = openssl_encrypt($password, AES_256_CBC, $encryption_key, 0, $iv);

            if ($type == '') {
                $builder = $this->db->table(admin_user);
                $builder->select('id AS user_id,CONCAT(first_name," ",last_name) AS "display_name",email AS user_email,role AS user_role, role_resources AS role_permission');
                $builder->where('email', $username);
                $builder->where('password', $encrypted);
                $builder->where('status', 1);
                $builder->where('is_deleted', 'no');
                $data = $builder->get()->getRowArray();

                if (!empty($data)) {
                    if ($data['user_role'] == 1) {
                        $data['role_permission'] = $this->role_resources($data['user_role']);
                    } else {
                        if ($data['role_permission'] == '') {
                            $data['role_permission'] = ['1'];
                        } else {
                            $data['role_permission'] = explode(',', $data['role_permission']);
                        }
                    }
                    $data_return = array('logged_in' => true, 'data' => $data, 'message' => 'success');
                } else {
                    $data_return = array('logged_in' => false, 'message' => 'Invalid Credential!');
                }
            }
        } else {
            $data_return = array('logged_in' => false, 'message' => 'success');
        }

        return $data_return;
    }
}
