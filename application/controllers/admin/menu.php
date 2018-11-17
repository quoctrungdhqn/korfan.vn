<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Menu extends CI_Controller
{

    public function __construct()
    {

        parent::__construct();

        $this->template->set_template('admin');//Set Template group admin
        $this->template->write_view("header", "admin/include/header");
        $this->template->write_view("menu", "admin/include/menu");
        $this->template->write_view("left", "admin/include/left");
        $this->template->write_view("right", "admin/include/right");
        $this->template->write_view("bottom", "admin/include/bottom");;

        $this->load->model("Menu_model");
        $this->load->model("Menu_type_model");
        $this->load->model("News_Category_Model");
        $this->load->model("Pages_model");
        $items = $this->Menu_model->all();

        $this->load->library("multi_menu");
        $this->multi_menu->set_items($items);
    }


    public function view()
    {
        $data['list_menu'] = $this->Menu_model->getParents();

        $data['content'] = 'admin/menu/menu_list';
        $data['pageTitle'] = 'Quản lý menu';
        $this->template->write_view("content", "admin/menu/menu_list", $data);
        $this->template->render();
    }

    public function edit($id = null)
    {
        if ($id === null) {
            $data['pageTitle'] = 'Thêm mới menu';
            $data['formType'] = 'add';
        } else {
            $data['pageTitle'] = 'Sửa menu';
            $data['formType'] = 'edit';
            $data['list'] = $this->Menu_model->get_info($id);
        }
        $this->load->library('mynestedsetmodel', array('tableName' => 'cp_products_categories'));
        $parent = $this->mynestedsetmodel->getTree(0, 0, @$catid);

        foreach ($parent as $item) {
            $select['danh-muc/' . $item->alias] = str_repeat('|---', $item->level) . $item->name;
        }

        $data['select'] = $select;

        $data['news_category'] = $this->News_Category_Model->get_all_items();
        $data['pages'] = $this->Pages_model->get_all_items();
        $data['menu_type'] = $this->Menu_type_model->get_all_items();
        $this->template->write_view("content", "admin/menu/menu_edit", $data);
        $this->template->render();
    }

    public function save_update()
    {
        $id = $this->input->post('id');

        if (!$id) {
            if ($this->Menu_model->insert()) {
                $this->session->set_flashdata('message', '<div role="alert" class="alert alert-success"><button data-dismiss="alert" class="close" type="button">×</button>Lưu dữ liệu thành công!</div>');
                redirect('admin/menu/view');
            } else {
                $this->session->set_flashdata('message', '<div role="alert" class="alert alert-danger"></div>');
                redirect('admin/menu/view');
            }
        } else {
            if ($this->Menu_model->update()) {
                $this->session->set_flashdata('message', '<div role="alert" class="alert alert-success"><button data-dismiss="alert" class="close" type="button">×</button>Lưu dữ liệu thành công!</div>');
                redirect('admin/menu/view');
            } else {
                $this->session->set_flashdata('message', '<div role="alert" class="alert alert-danger"></div>');
                redirect('admin/menu/view');
            }
        }
    }

    public function saveOrder()
    {
        $this->load->model('menu_model');
        $data = $this->Menu_model->getAllProductsCategories();
        $orderArr = $this->input->post('ordering');

        $this->load->library('mynestedsetmodel', array('tableName' => 'cp_products_categories'));
        $this->mynestedsetmodel->orderTree($data, $orderArr);
        redirect('admin/menu/view');
    }

    public function delete($id)
    {
        $this->Menu_model->delete($id);
    }

}