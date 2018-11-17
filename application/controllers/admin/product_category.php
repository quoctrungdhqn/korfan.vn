<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Product_Category extends CI_Controller
{

    public function __construct()
    {

        parent::__construct();

        $this->template->set_template('admin');//Set Template group admin
        $this->template->write_view("header", "admin/include/header");
        $this->template->write_view("menu", "admin/include/menu");
        $this->template->write_view("left", "admin/include/left");
        $this->template->write_view("right", "admin/include/right");
        $this->template->write_view("bottom", "admin/include/bottom");
        $this->load->model('Product_category_model');

    }

    public function view()

    {

        $this->load->library('mynestedsetmodel', array('tableName' => 'cp_products_categories'));
        $list = $this->mynestedsetmodel->getTree(0, 0);

        $data['page_title'] = 'Quản lý danh mục sản phẩm';
        $data['list'] = $list;

        $this->template->write_view("content", "admin/products/product_category_list", $data);

        $this->template->render();

    }

    public function edit($catid = null)

    {

        if ($catid === null) {

            $data['page_title'] = 'Thêm mới danh mục';

            $data['formType'] = 'add';

        } else {

            $data['page_title'] = 'Sửa danh mục';

            $data['formType'] = 'edit';

            $this->load->model('Product_category_model');

            $data['catInfo'] = $this->Product_category_model->getProductsCategoryInfo($catid);

        }

        $this->load->library('mynestedsetmodel', array('tableName' => 'cp_products_categories'));

        $parent = $this->mynestedsetmodel->getTree(0, 0, @$catid);

        foreach ($parent as $item) {

            $select[$item->id] = str_repeat('|---', $item->level) . $item->name;

        }

        $data['select'] = @$select;

        $this->template->write_view("content", "admin/products/product_category_edit", $data);

        $this->template->render();

    }

    public function save_update()
    {
        $id = $this->input->post('id');
        $this->load->model('Product_category_model');
        $this->load->library('mynestedsetmodel', array('tableName' => 'cp_products_categories'));
        $data = array(
            'name' => $this->input->post('name'),
            'alias' => mb_strtolower(url_title(removesign($this->input->post('name')))),
            'parents' => $this->input->post('parents'),
            'detail' => $this->input->post('detail'),
            'seo_title' => $this->input->post('seo_title'),
            'seo_keyword' => $this->input->post('seo_keyword'),
            'seo_description' => $this->input->post('seo_description'),
            'state' => $this->input->post('state')
        );

        if (!$id) {
            if ($this->mynestedsetmodel->insertNode($data, $data['parents'])) {
                $this->session->set_flashdata('message', '<div role="alert" class="alert alert-danger"></div>');
                redirect('admin/product_category/view');
            } else {
                $this->session->set_flashdata('message', '<div role="alert" class="alert alert-success"><button data-dismiss="alert" class="close" type="button">×</button>Lưu dữ liệu thành công!</div>');
                redirect('admin/product_category/view');
            }
        } else {
            if ($this->mynestedsetmodel->updateNode($data, $id, $data['parents'])) {
                $this->session->set_flashdata('message', '<div role="alert" class="alert alert-danger"></div>');
                redirect('admin/product_category/view');
            } else {
                $this->session->set_flashdata('message', '<div role="alert" class="alert alert-success"><button data-dismiss="alert" class="close" type="button">×</button>Lưu dữ liệu thành công!</div>');
                redirect('admin/product_category/view');
            }
        }
    }


    public function saveOrder()

    {

        $this->load->model('Product_category_model');

        $data = $this->Product_category_model->getAllProductsCategories();

        $orderArr = $this->input->post('ordering');


        $this->load->library('mynestedsetmodel', array('tableName' => 'cp_products_categories'));

        $this->mynestedsetmodel->orderTree($data, $orderArr);

        redirect('admin/product_category/view');

    }


    public function delete($id)

    {
        $this->load->model('Product_category_model');
        $this->Product_category_model->deleteItem($id);
    }

}

