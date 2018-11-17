<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Product extends CI_Controller
{

    public function __construct()
    {

        parent::__construct();
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
        $this->load->model('Product_model');

        $list = $this->Product_model->getAllProductsNoLimit();

        $data['list'] = $list;
        $data['page_title'] = 'Quản lý sản phẩm';

        $this->template->write_view("content", "admin/products/product_list", $data);

        $this->template->render();

    }

    public function edit($proid = null)
    {
        if ($proid === null) {

            $data['page_title'] = 'Thêm mới sản phẩm';

            $data['formType'] = 'add';

        } else {

            $data['page_title'] = 'Sửa sản phẩm';

            $data['formType'] = 'edit';

            $this->load->model('Product_model');

            $data['product'] = $this->Product_model->getProductInfo($proid);

        }

        //Lấy dữ liệu danh mục cha

        $this->load->library('mynestedsetmodel', array('tableName' => 'cp_products_categories'));

        $parent = $this->mynestedsetmodel->getTree(0, 0, @$catid);

        foreach ($parent as $item) {

            $select[$item->id] = str_repeat('|---', $item->level) . $item->name;

        }

        $data['select'] = $select;

        $this->template->write_view("content", "admin/products/product_edit", $data);

        $this->template->render();

    }

    public function save_update()
    {

        $id = $this->input->post('id');

        $this->load->model('Product_model');

        $oldPic = $this->input->post('oldImage');//Giữ lại giá trị image cũ khi update

        if (!empty($_FILES['image']['name'][0])) {

            $upload_conf = array(
                'upload_path' => realpath('./uploads/products/'),
                'allowed_types' => 'gif|jpg|png',
                'max_size' => '30000',
            );

            $this->upload->initialize($upload_conf);

            // Change $_FILES to new vars and loop them
            foreach ($_FILES['image'] as $key => $val) {
                $i = 1;
                foreach ($val as $v) {
                    $field_name = "file_" . $i;
                    $_FILES[$field_name][$key] = $v;
                    $i++;
                }
            }
            // Unset the useless one ;)
            unset($_FILES['image']);

            // Put each errors and upload data to an array
            $error = array();
            $success = array();

            // main action to upload each file
            foreach ($_FILES as $field_name => $file) {
                if (!$this->upload->do_upload($field_name)) {
                    // if upload fail, grab error
                    $error['upload'][] = $this->upload->display_errors();
                } else {
                    // otherwise, put the upload datas here.
                    // if you want to use database, put insert query in this loop
                    $upload_data = $this->upload->data();
                    // print_r($upload_data);
                    $hinh[] = $upload_data['file_name'];
                    // set the resize config
                    $resize_conf = array(
                        // it's something like "/full/path/to/the/image.jpg" maybe
                        'source_image' => $upload_data['full_path'],
                        // and it's "/full/path/to/the/" + "thumb_" + "image.jpg
                        // or you can use 'create_thumbs' => true option instead
                        'new_image' => $upload_data['file_path'] . 'thumb_' . $upload_data['file_name'],
                        'width' => 476,
                        'height' => 350
                    );

                    // initializing
                    $this->image_lib->initialize($resize_conf);

                    // do it!
                    if (!$this->image_lib->resize()) {
                        // if got fail.
                        $error['resize'][] = $this->image_lib->display_errors();
                    } else {
                        // otherwise, put each upload data to an array.
                        $success[] = $upload_data;
                    }

                }


                // see what we get
                if (count($error > 0)) {
                    $data['error'] = $error;
                } else {
                    $data['success'] = $upload_data;
                }

            }
            $image = implode(',', $hinh);
        } else {
            $image = $oldPic;
            //print_r($image);exit;
        }

        if (!$id) //Thêm 1 sản phẩm mới

        {

            if ($this->Product_model->insertProduct($image)) {

                $this->session->set_flashdata('message', '<div role="alert" class="alert alert-success"><button data-dismiss="alert" class="close" type="button">×</button>Lưu dữ liệu thành công!</div>');
                redirect('admin/product/view');

            } else {
                $this->session->set_flashdata('message', '<div role="alert" class="alert alert-danger"></div>');
                redirect('admin/product/view');

            }

        } else //Cập nhật sản phẩm

        {

            if ($this->Product_model->updateProduct($image)) {
                $this->session->set_flashdata('message', '<div role="alert" class="alert alert-success"><button data-dismiss="alert" class="close" type="button">×</button>Lưu dữ liệu thành công!</div>');
                redirect('admin/product/view');

            } else {
                $this->session->set_flashdata('message', '<div role="alert" class="alert alert-danger"></div>');
                redirect('admin/product/view');

            }

        }

    }

    public function delete($id)
    {
        $this->load->model('Product_model');
        $this->Product_model->deleteItem($id);
    }

}

