<?php

namespace App\Controllers;

class HomeBanners extends BaseController
{
    public function index()
    {
        $this->data['page_name']  = 'home_page_banner';
        $this->data['page_title'] = lang('Common.home_banners');
        $this->data['path_url']   = 'home_banners';
        $this->load_view('admin/home_banners/list', lang('Common.home_banners'), 'admin/parent');
    }


    public function add($slug = '')
    {
        $this->data['page_name']  = 'add_home_page_banner';
        $this->data['page_title'] = lang('Common.add_banner');
        $this->data['path_url']   = 'banner';

        $this->data['slug']  = $slug;
        if ($slug != '') 
        {
            $this->data['page_title'] = lang('Common.edit_home_banner');
            $where      = ['is_deleted' => 'no', 'id' => $slug];
            $count_banner = $this->admin_banner_model->where($where)->countAllResults();
            if($count_banner > 0)
            {
                $this->data['banner_data'] = $this->admin_banner_model->where($where)->first();
                // $this->data['banner_data']['image_url'] = base_url()."/assets/uploads/banners/".$this->data['banner_data']['image'];
            }
            else 
            {
                $this->session->setFlashdata('error', 'Banner is not valid');
                return redirect()->to(route_to('home_banners_list_url'));
            }

            $banner_id = $this->data['banner_data']['id'];
            $input   = $this->validate([
                'title'      => ['label' => lang('Common.title'), 'rules' => 'required'],
            ]); 
        } 
        else 
        {
            $input = $this->validate([
                'title' => ['label' => lang('Common.title'), 'rules' => 'required'],
            ]);
            
        }
        
        if (empty($this->request->getVar())) 
        {
            $this->load_view('admin/home_banners/add', lang('Common.home_banners'), 'admin/parent');
        }
        if (!$input) 
        {
            $this->data['validation'] = $this->validator;
            $this->load_view('admin/home_banners/add', lang('Common.home_banners'), 'admin/parent');
        } 
        else 
        {
            /* -----------------Start Insert Section-------------------*/
            if ($slug == '') 
            {
                $data = [
                    'title'         => $this->request->getVar('title'),
                    'order_by' => $this->request->getVar('order_by'),
                    'slug_url'     => $this->get_slug($this->request->getVar('title')),
                    'created_at'    => get_current_date(),
                    'updated_at'    => get_current_date(),
                    'page'     => 'home',
                    'is_deleted'     => 'no',
                    'is_active'      => ($this->request->getVar('is_active') == '1') ? 'active' : 'inactive'
                    
                ];

                if(!empty($_FILES["image"]["name"])) 
                {
                   
                    $path = FC_PATH."assets/uploads/banners/";
                    $image_name = time().'_'.preg_replace('/\s+/', '_', $_FILES['image']['name']);
                    $image_name = str_replace(' ', '-', $image_name); // Replaces all spaces with hyphens.
                    $image_name = preg_replace('/[^A-Za-z0-9\-.]/', '', $image_name); // Removes special chars.
                    move_uploaded_file($_FILES["image"]["tmp_name"], $path.$image_name);
                    $data['image'] = $image_name;
                } 
                
                $insert_banner = $this->admin_banner_model->insert($data);
               
                if ($insert_banner)
                {
                    $this->session->setFlashdata('success', lang('Common.successfully_saved'));
                    return redirect()->to(route_to('home_banner_add_url'));
                } 
                else 
                {
                    $this->session->setFlashdata('error', lang('Common.went_wrong'));
                    return redirect()->to(route_to('home_banner_add_url'));
                }
            } 
            else 
            {
                /* -----------------Start Update Section-------------------*/
                
                $data = [
                    'title'         => $this->request->getVar('title') ? $this->request->getVar('title') : "",
                    'order_by' => $this->request->getVar('order_by'),
                    'slug_url'     => $this->get_slug($this->request->getVar('title')),
                    'created_at'  => get_current_date(),
                    'updated_at'    => get_current_date(),
                    'page'    => 'home',
                    'is_deleted'    => 'no',
                    'is_active'     => ($this->request->getVar('is_active') == '1') ? 'active' : 'inactive'
                    
                ];

               


                if(!empty($_FILES["image"]["name"]) && $_FILES["image"]["name"] != "") {
                    $path = FC_PATH."assets/uploads/banners/";
                    $image_name = time().'_'.preg_replace('/\s+/', '_', $_FILES['image']['name']);
                    $image_name = str_replace(' ', '-', $image_name); // Replaces all spaces with hyphens.
                    $image_name = preg_replace('/[^A-Za-z0-9\-.]/', '', $image_name); // Removes special chars.
                    move_uploaded_file($_FILES["image"]["tmp_name"], $path.$image_name);
                    $data['image'] = $image_name;
                } 
                

                $web_update = $this->admin_banner_model->where(array('id' => trim($banner_id)))->set($data)->update();
                
                if ($web_update) 
                {
                    $this->session->setFlashdata('success', lang('Common.successfully_updated'));
                    return redirect()->to(route_to('home_banners_list_url'));
                } 
                else 
                {
                    $this->session->setFlashdata('error', lang('Common.went_wrong'));
                    return redirect()->to(route_to('home_banner_add_url'));
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

        $column = (isset($this->request->getVar('order')[0]['column']) && $this->request->getVar('order')[0]['column'] != '') ? $this->request->getVar('order')[0]['column'] : '4';
        $dir    = (isset($this->request->getVar('order')[0]['dir']) && $this->request->getVar('order')[0]['dir'] != '') ? $this->request->getVar('order')[0]['dir'] : 'DESC';


        $column_ = ['title','is_active', 'id'];

        $where = ['is_deleted' => 'no','is_active'=>'active','page' => 'home'];

        $like = [];
        if ($global_search != '') 
        {
            $like['title'] = $global_search;
            $like['is_active']  = $global_search;

            $banners_data           = $this->admin_banner_model->select("*")->groupStart()->where($where)->groupStart()->orLike($like)->groupEnd()->groupEnd()->orderBy($column_[$column], $dir)->findAll($length, $start);
            $count_user_Filtered = $this->admin_banner_model->groupStart()->where($where)->groupStart()->orLike($like)->groupEnd()->groupEnd()->countAllResults();

        } 
        else 
        {
            $banners_data = $this->admin_banner_model->select("*")->where($where)->findAll();
           
            $count_user_Filtered = $this->admin_banner_model->where($where)->countAllResults();
        }

        $count_banners = $this->admin_banner_model->where($where)->countAllResults();

        $data = [];

        foreach ($banners_data as $i => $r) 
        {
         
            $action = '';
            $action .= anchor(route_to('home_banner_edit_url', $r['id']), '<span class="svg-icon svg-icon-3">
                <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                    <path d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953)" />
                    <path d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                </svg>
            </span>', 'title="' . lang('Common.edit_home_banner') . '" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1"');

            $action .= anchor('#', '<span class="svg-icon svg-icon-3">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <rect x="0" y="0" width="24" height="24"></rect>
                        <path d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z" fill="#000000" fill-rule="nonzero"></path>
                        <path d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#000000" opacity="0.3"></path>
                    </g>
                </svg>
            </span>', 'title="' . lang('Common.delete_home_banner') . '" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 user-delete-btn" data-idos="' . $r['id'] . '"');

            $banner_image = ($r['image'] != "") ? "uploads/banners/".$r['image'] : "admin/media/placeholder-image.jpg";
            $data[] = array(
                '<div class="d-flex align-items-center">
                    <div class="d-flex justify-content-start flex-column">
                        <span><image class="h-30px" src="'.base_url().'/assets/'.$banner_image.'">
                        <span class="text-dark fw-bolder fs-6">' . $r['title'] .'</span>
                        <small class="text-muted fw-bold d-block">' . lang('Common.created_at') . ': ' . $this->date_format($r['created_at']) . '</small>
                    </div>
                </div>',
               
                ($r['is_active'] == 'active') ? '<span class="badge badge-light-success fs-8 fw-bolder">Active</span>' : '<span class="badge badge-light-danger fs-8 fw-bolder">Inactive</span>',
                '<div class="d-flex justify-content-end">' . $action . '</div>',
            );
        }
        $output = array(
            "draw"            => $draw,
            "recordsTotal"    => $count_banners,
            "recordsFiltered" => $count_user_Filtered,
            "data"            => $data,
        );
        echo json_encode($output);
        exit();
    }

    public function delete($id = '')
    {
        $this->data['page_name']  = 'delete_home_banner';
        $this->data['page_title'] = 'Delete banner';
        $this->data['path_url']   = 'home_banners';

        $this->data['id'] = $id;

        $response = ['is_active' => 'error', 'message' => ''];

        if($id != ''){
            
            $this->data['page_title'] = 'Delete banner';
            
            $where  = ['is_deleted'=>'no', 'id'=>$id];
            $count_banner = $this->admin_banner_model->where($where)->countAllResults();
            
            if($count_banner > 0){
                $this->data['banner_data'] = $this->admin_banner_model->where($where)->first();
            } else {
                $response = ['is_active' => 'error', 'message' => 'banner is not valid!'];
                echo json_encode($response);
                exit;
            }
            $banner_id = $this->data['banner_data']['id'];
        } else {
            $response = ['is_active' => 'error', 'message' => lang('Common.went_wrong')];
            echo json_encode($response);
            exit;
        }

        $data = [
            'is_deleted' => 'yes',
        ];

        $web_update = $this->admin_banner_model->where(array('id' => trim($banner_id)))->set($data)->update();
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
