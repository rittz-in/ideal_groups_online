<?php

namespace App\Controllers;

class User extends BaseController
{
    public function index()
    {
        $this->data['page_name']  = 'user';
        $this->data['page_title'] = lang('Common.user');
        $this->data['path_url']   = 'user';
        $this->load_view('admin/user/list', lang('Common.user'), 'admin/parent');
    }

    public function add($slug = '')
    {
        $this->data['page_name']  = 'add_user';
        $this->data['page_title'] = lang('Common.add_user');
        $this->data['path_url']   = 'user';

        $this->data['slug']  = $slug;
        $role_resources_temp = [];
        if ($slug != '') {
            $this->data['page_title'] = lang('Common.edit_user');

            $where      = ['is_deleted' => 'no', 'encryption_admin_user_id' => $slug];
            $count_user = $this->admin_user_model->where($where)->countAllResults();
            if ($count_user > 0) {
                $this->data['user_data'] = $this->admin_user_model->where($where)->first();
                $role_resources_temp     = explode(',', $this->data['user_data']['role_resources']);
            } else {
                $this->session->setFlashdata('error', 'User is not valid');
                return redirect()->to(route_to('user_list_url'));
            }
            $user_id = $this->data['user_data']['id'];
            $input   = $this->validate([
                'email'      => ['label' => lang('Common.email'), 'rules' => 'required|valid_email|is_unique[' . admin_user . '.email,id,' . $user_id . ']'],
                'first_name' => ['label' => lang('Common.first_name'), 'rules' => 'required'],
                'last_name'  => ['label' => lang('Common.last_name'), 'rules' => 'required'],
                'gender'     => ['label' => lang('Common.gender'), 'rules' => 'required'],
                'mobile'     => ['label' => lang('Common.mobile'), 'rules' => 'required|integer'],
            ]);
        } else {
            $input = $this->validate([
                'email'      => ['label' => lang('Common.email'), 'rules' => 'required|valid_email|is_unique[' . admin_user . '.email]'],
                'first_name' => ['label' => lang('Common.first_name'), 'rules' => 'required'],
                'last_name'  => ['label' => lang('Common.last_name'), 'rules' => 'required'],
                'gender'     => ['label' => lang('Common.gender'), 'rules' => 'required'],
                'mobile'     => ['label' => lang('Common.mobile'), 'rules' => 'required|integer'],
                'password'   => ['label' => lang('Common.password'), 'rules' => 'required'],
            ]);
            $role_resources_temp = [];
        }

        $admin_links                = $this->main_model->get_admin_links();
        $temp_a                     = [];
        $this->data['_admin_links'] = [];

        foreach ($admin_links as $k => $v) {
            if (isset($v['parent_id']) && $v['parent_id'] > 0) {
                $index   = array_search($v['parent_id'], $temp_a);
                $checked = (in_array($v['id'], $role_resources_temp)) ? 'checked' : '';

                $this->data['_admin_links'][$index]['items'][] = array('id' => $v['id'], 'class' => 'role-checkbox-modal custom-control-input', 'text' => $v['name'], 'add_info' => '', 'check' => $checked, 'value' => $v['id']);
            } else {
                array_push($temp_a, $v['id']);
                $checked                      = (in_array($v['id'], $role_resources_temp)) ? 'checked' : '';
                $this->data['_admin_links'][] = array('id' => $v['id'], 'class' => 'role-checkbox-modal custom-control-input', 'text' => $v['name'], 'add_info' => '', 'check' => $checked, 'value' => $v['id']);
            }
        }

        if (empty($this->request->getVar())) {
            $this->load_view('admin/user/add', lang('Common.user'), 'admin/parent');
        }
        if (!$input) {
            $this->data['validation'] = $this->validator;
            $this->load_view('admin/user/add', lang('Common.user'), 'admin/parent');
        } else {

            if ($this->request->getVar('role_resources') != null && count($this->request->getVar('role_resources')) > 0) {
                $_role_resources_ = '1,' . implode($this->request->getVar('role_resources'), ',');
            } else {
                $_role_resources_ = '1';
            }

            if ($_role_resources_ != '' && $this->request->getVar('role_resources') != null && count($this->request->getVar('role_resources')) > 0) {
                $_role_resources_ .= $this->main_model->get_resources($_role_resources_);
            }

            if ($slug == '') {
                $encryption_key = "C39Ig4jazeQSSUYonBtASg==";
                $iv             = 'kvmjcu94885xfg6h';
                $encrypted      = openssl_encrypt($this->request->getVar('password'), AES_256_CBC, $encryption_key, 0, $iv);

                $data = [
                    'email'          => $this->request->getVar('email'),
                    'password'       => $encrypted,
                    'first_name'     => $this->request->getVar('first_name'),
                    'last_name'      => $this->request->getVar('last_name'),
                    'gender'         => $this->request->getVar('gender'),
                    'mobile'         => $this->request->getVar('mobile'),
                    'date'           => get_current_date(),
                    'is_deleted'     => 'no',
                    'status'         => ($this->request->getVar('status') == '1') ? '1' : '0',
                    'role'           => '2',
                    'role_resources' => $_role_resources_,
                ];

                $insert_user = $this->admin_user_model->insert($data);
                if ($insert_user) {
                    $data = [
                        'encryption_admin_user_id' => $this->encrypt($insert_user),
                    ];
                    $this->admin_user_model->where(array('id' => trim($insert_user)))->set($data)->update();

                    $this->session->setFlashdata('success', lang('Common.successfully_saved'));
                    return redirect()->to(route_to('user_add_url'));
                } else {
                    $this->session->setFlashdata('error', lang('Common.went_wrong'));
                    return redirect()->to(route_to('user_add_url'));
                }
            } else {
                $data = [
                    'email'          => $this->request->getVar('email'),
                    'first_name'     => $this->request->getVar('first_name'),
                    'last_name'      => $this->request->getVar('last_name'),
                    'gender'         => $this->request->getVar('gender'),
                    'mobile'         => $this->request->getVar('mobile'),
                    'status'         => ($this->request->getVar('status') == '1') ? '1' : '0',
                    'role_resources' => $_role_resources_,
                ];
                $web_update = $this->admin_user_model->where(array('id' => trim($user_id)))->set($data)->update();
                if ($web_update) {
                    $this->session->setFlashdata('success', lang('Common.successfully_updated'));
                    return redirect()->to(route_to('user_list_url'));
                } else {
                    $this->session->setFlashdata('error', lang('Common.went_wrong'));
                    return redirect()->to(route_to('user_add_url'));
                }
            }
        }
    }

    public function get_all()
    {
        $draw          = intval($this->request->getVar("draw"));
        $start         = intval($this->request->getVar("start"));
        $length        = intval($this->request->getVar("length"));
        $global_search = $this->request->getVar("global_search");

        $column = (isset($this->request->getVar('order')[0]['column']) && $this->request->getVar('order')[0]['column'] != '') ? $this->request->getVar('order')[0]['column'] : '3';
        $dir    = (isset($this->request->getVar('order')[0]['dir']) && $this->request->getVar('order')[0]['dir'] != '') ? $this->request->getVar('order')[0]['dir'] : 'DESC';

        $column_ = ['first_name', 'email', 'status', 'id'];

        $where = ['is_deleted' => 'no', 'role' => '2'];

        $like = [];
        if ($global_search != '') {
            $like['first_name'] = $global_search;
            $like['last_name']  = $global_search;
            $like['email']      = $global_search;

            $user_data           = $this->admin_user_model->groupStart()->where($where)->groupStart()->orLike($like)->groupEnd()->groupEnd()->orderBy($column_[$column], $dir)->findAll($length, $start);
            $count_user_Filtered = $this->admin_user_model->groupStart()->where($where)->groupStart()->orLike($like)->groupEnd()->groupEnd()->countAllResults();
        } else {
            $user_data           = $this->admin_user_model->where($where)->orderBy($column_[$column], $dir)->findAll($length, $start);
            $count_user_Filtered = $this->admin_user_model->where(array('is_deleted' => 'no', 'role' => '2'))->countAllResults();
        }

        $count_user = $this->admin_user_model->where(array('is_deleted' => 'no', 'role' => '2'))->countAllResults();

        $data = [];

        foreach ($user_data as $i => $r) {
            $action = '';
            $action .= anchor(route_to('user_edit_url', $r['encryption_admin_user_id']), '<span class="svg-icon svg-icon-3">
                <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                    <path d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953)" />
                    <path d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                </svg>
            </span>', 'title="' . lang('Common.edit_user') . '" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1"');

            $action .= anchor('#', '<span class="svg-icon svg-icon-3">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <rect x="0" y="0" width="24" height="24"></rect>
                        <path d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z" fill="#000000" fill-rule="nonzero"></path>
                        <path d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#000000" opacity="0.3"></path>
                    </g>
                </svg>
            </span>', 'title="' . lang('Common.delete_user') . '" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 user-delete-btn" data-idos="' . $r['encryption_admin_user_id'] . '"');

            $data[] = array(
                '<div class="d-flex align-items-center">
                    <div class="d-flex justify-content-start flex-column">
                        <span class="text-dark fw-bolder fs-6">' . $r['first_name'] . ' ' . $r['last_name'] . '</span>
                        <small class="text-muted fw-bold d-block">' . lang('Common.created_date') . ': ' . $this->date_format($r['date']) . '</small>
                    </div>
                </div>',
                '<a href="mailto:' . $r['email'] . '">' . $r['email'] . '</a>',
                ($r['status'] == '1') ? '<span class="badge badge-light-success fs-8 fw-bolder">Active</span>' : '<span class="badge badge-light-danger fs-8 fw-bolder">Inactive</span>',
                '<div class="d-flex justify-content-end">' . $action . '</div>',
            );
        }
        $output = array(
            "draw"            => $draw,
            "recordsTotal"    => $count_user,
            "recordsFiltered" => $count_user_Filtered,
            "data"            => $data,
        );
        echo json_encode($output);
        exit();
    }

    public function delete($slug = '')
    {
        $this->data['page_name']  = 'delete_user';
        $this->data['page_title'] = 'Delete user';
        $this->data['path_url']   = 'user';

        $this->data['slug'] = $slug;

        $response = ['status' => 'error', 'message' => ''];
        if ($slug != '') {
            $this->data['page_title'] = 'Delete user';

            $where      = ['is_deleted' => 'no', 'encryption_admin_user_id' => $slug];
            $count_user = $this->admin_user_model->where($where)->countAllResults();
            if ($count_user > 0) {
                $this->data['user_data'] = $this->admin_user_model->where($where)->first();
            } else {
                $response = ['status' => 'error', 'message' => 'user is not valid!'];
                echo json_encode($response);
                exit;
            }
            $user_id = $this->data['user_data']['id'];
        } else {
            $response = ['status' => 'error', 'message' => lang('Common.went_wrong')];
            echo json_encode($response);
            exit;
        }

        $data = [
            'is_deleted' => 'yes',
        ];
        $web_update = $this->admin_user_model->where(array('id' => trim($user_id)))->set($data)->update();
        if ($web_update) {
            $response = ['status' => 'success', 'message' => lang('Common.successfully_deleted')];
            echo json_encode($response);
            exit;
        } else {
            $response = ['status' => 'error', 'message' => lang('Common.went_wrong')];
            echo json_encode($response);
            exit;
        }
    }
}
