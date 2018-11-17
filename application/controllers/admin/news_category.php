<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class News_Category extends CI_Controller
{

    public function __construct()
    {

        parent::__construct();

        $this->load->model('News_Category_Model');
        //chuẩn bị template, load các vị trí
        $this->template->set_template('admin');//Template group admin
        $this->template->write_view("header", "admin/include/header");
        $this->template->write_view("menu", "admin/include/menu");
        $this->template->write_view("left", "admin/include/left");
        $this->template->write_view("right", "admin/include/right");
        $this->template->write_view("bottom", "admin/include/bottom");
    }

    public function view()
    {
        $this->load->library('mynestedsetmodel', array('tableName' => 'cp_categories'));
        $list = $this->mynestedsetmodel->getTree(0, 0);

        $data['page_title'] = 'Quản lý danh mục bài viết';
        $data['list'] = $list;
        $this->template->write_view("content", "admin/news/news_category_list", $data);
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
            $data['info'] = $this->News_Category_Model->get_items_info($catid);
        }

        $this->load->library('mynestedsetmodel', array('tableName' => 'cp_categories'));
        $parent = $this->mynestedsetmodel->getTree(0, 0, @$catid);

        foreach ($parent as $item) {
            $select[$item->id] = str_repeat('|---', $item->level) . $item->title;
        }

        $data['select'] = @$select;
        $this->template->write_view("content", "admin/news/news_category_edit", $data);
        $this->template->render();
    }

    public function save_update()
    {
        $id = $this->input->post('id');
        $user = $this->session->userdata('userLogged');
        $this->load->library('mynestedsetmodel', array('tableName' => 'cp_categories'));
        $data = array(
            'title' => $this->input->post('title'),
            'alias' => mb_strtolower(url_title(removesign($this->input->post('title')))),
            'parents' => $this->input->post('parents'),
            'detail' => $this->input->post('detail'),
            'created' => date('Y-m-d H:i:s'),
            'created_by' => $user->id,
            'seo_title' => $this->input->post('seo_title'),
            'seo_keyword' => $this->input->post('seo_keyword'),
            'seo_description' => $this->input->post('seo_description'),
            'published' => $this->input->post('published')
        );

        if (!$id) {
            if ($this->mynestedsetmodel->insertNode($data, $data['parents'])) {
                $this->session->set_flashdata('message', '<div role="alert" class="alert alert-danger"><button data-dismiss="alert" class="close" type="button">×</button>Lưu dữ liệu thất bại!</div>');
                redirect('admin/news_category/view');
            } else {
                $this->session->set_flashdata('message', '<div role="alert" class="alert alert-success"><button data-dismiss="alert" class="close" type="button">×</button>Lưu dữ liệu thành công!</div>');
                redirect('admin/news_category/view');
            }
        } else {
            if ($this->mynestedsetmodel->updateNode($data, $id, $data['parents'])) {
                $this->session->set_flashdata('message', '<div role="alert" class="alert alert-success"><button data-dismiss="alert" class="close" type="button">×</button>Lưu dữ liệu thành công!</div>');
                redirect('admin/news_category/view');
            } else {
                $this->session->set_flashdata('message', '<div role="alert" class="alert alert-success"><button data-dismiss="alert" class="close" type="button">×</button>Lưu dữ liệu thành công!</div>');
                redirect('admin/news_category/view');
            }
        }
    }

    public function save_order()
    {
        $this->load->model('news_category_model');
        $data = $this->news_category_model->getAllProductsCategories();
        $orderArr = $this->input->post('ordering');

        $this->load->library('mynestedsetmodel', array('tableName' => 'cp_products_categories'));
        $this->mynestedsetmodel->orderTree($data, $orderArr);
        redirect('admin/news_category/view/');
    }

    public function delete($id = null)
    {
        if ($id != null && $id > 0) {
            $this->load->library('mynestedsetmodel', array('tableName' => 'cp_categories'));
            $this->mynestedsetmodel->removeNode($id, 'branch');
            redirect('admin/news_category/view/');
        }
    }

}

?>