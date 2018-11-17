<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->model('User_group_model');
        $this->load->library('upload');
        $this->load->library('image_lib');
        $this->template->set_template('admin');//Set Template group admin
        $this->template->write_view("header", "admin/include/header");
        $this->template->write_view("menu", "admin/include/menu");
        $this->template->write_view("left", "admin/include/left");
        $this->template->write_view("right", "admin/include/right");
        $this->template->write_view("bottom", "admin/include/bottom");
    }

    public function view($message = null)
    {
        $data['pageTitle'] = 'Quản lý thành viên';

        $user = $this->session->userdata('userLogged');

        if ($user->role == '777') {
            $listUsers = $this->User_model->getAllUsers();
        } else {
            $listUsers = $this->User_model->getUser($user->id);
        }

        $data['list'] = $listUsers;
        $this->template->write_view("content", "admin/user/user_list", $data);
        $this->template->render();
    }

    public function edit($userid = null)
    {
        if ($userid === null) {
            $data['formType'] = 'add';
            $data['page_title'] = 'Thêm thành viên';
            $data['label_password'] = 'Mật khẩu';
            $data['placeholder_password'] = 'Mật khẩu';
        } else {
            $data['formType'] = 'edit';
            $data['page_title'] = 'Sửa thành viên';
            $data['label_password'] = 'Mật khẩu mới';
            $data['placeholder_password'] = 'Để trống nếu không thay đổi';
            $data['userInfo'] = $this->User_model->getUserInfo($userid);
        }

        $groupsList = $this->User_group_model->getAllUserGroup();
        $data['groupsList'] = $groupsList;

        $this->template->write_view("content", "admin/user/user_edit", $data);
        $this->template->render();
    }

    public function save_update()
    {
        $id = $this->input->post('id');
        $oldImage = $this->input->post('oldImage');//Giữ lại giá trị image cũ khi update

        // Upload image
        if (!empty($_FILES['images']['name'][0])) {

            $upload_conf = array(
                'upload_path' => realpath('./uploads/users/'),
                'allowed_types' => 'gif|jpg|png|jpeg',
                'max_size' => '30000',
            );

            $this->upload->initialize($upload_conf);

            // Change $_FILES to new vars and loop them
            foreach ($_FILES['images'] as $key => $val) {
                $i = 1;
                foreach ($val as $v) {
                    $field_name = "file_" . $i;
                    $_FILES[$field_name][$key] = $v;
                    $i++;
                }
            }

            unset($_FILES['images']);

            foreach ($_FILES as $field_name => $file) {
                if (!$this->upload->do_upload($field_name)) {
                    // if upload fail, set image = oldImage
                    $image = $oldImage;
                } else {
                    // otherwise, put the upload datas here.
                    // if you want to use database, put insert query in this loop
                    $upload_data = $this->upload->data();
                    $image = 'uploads/users/' . $upload_data['file_name'];
                }
            }
        } else {
            $image = $oldImage;
        }

        if (!$id) {
            if ($this->User_model->insertUser($image)) {
                $this->session->set_flashdata('message', '<div role="alert" class="alert alert-success"><button data-dismiss="alert" class="close" type="button">×</button>Lưu dữ liệu thành công!</div>');
                redirect('admin/user/view');
            } else {
                $this->session->set_flashdata('message', '<div role="alert" class="alert alert-danger"></div>');
                redirect('admin/user/view');
            }
        } else {
            if ($this->User_model->updateUser($image)) {
                $this->session->set_flashdata('message', '<div role="alert" class="alert alert-success"><button data-dismiss="alert" class="close" type="button">×</button>Lưu dữ liệu thành công!</div>');
                redirect('admin/user/view');
            } else {
                $this->session->set_flashdata('message', '<div role="alert" class="alert alert-danger"></div>');
                redirect('admin/user/view');
            }
        }
    }

    public function delete($userid)
    {
        if ($userid != 1000)//Không cho xóa super admin
        {
            $this->User_model->removeUser($userid);
        }
    }
}

?>