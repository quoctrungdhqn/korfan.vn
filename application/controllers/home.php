<?php

class Home extends CI_Controller
{

    public function __construct()
    {

        parent::__construct();
        $this->load->helper(array("url", "text"));
        $this->load->model('News_model');

        $this->load->model('Product_model');
        $this->load->model('Product_category_model');
        $this->load->model('Configuration_model');
        $this->load->model('Slide_model');

        $this->template->set_template('default');//Set Template group default
        $this->template->write_view("menu", "frontend/include/menu");
        $this->template->write_view("slide", "frontend/include/slide");
        $this->template->write_view("slide", "frontend/include/advertising");
        $this->template->write_view("bottom", "frontend/include/bottom");
    }

    function index()
    {

        /*$data['category'] = $this->Product_category_model->getParents();
        $data['slide'] = $this->Slide_model->getSliders();
        $data['mautrangchu'] = $this->Product_model->getProductHome();
        $data['list_news_featured'] = $this->News_model->get_all_items_limit(7);
        $data['list_news_slide'] = $this->News_model->get_all_items_limit(1);
        $data['list_news_slide_bottom'] = $this->News_model->get_all_items_limit(3);
        $data['daotaoboiduong'] = $this->News_model->get_items_info(1001);
        $data['hoithaohoinghi'] = $this->News_model->get_items_info(1002);
        $data['list_news_cat'] = $this->News_model->get_all_items_limit(3);
*/

        // SEO
        $data['title'] = $this->Configuration_model->getConfigurationInfoCode('title');
        $data['keyword'] = $this->Configuration_model->getConfigurationInfoCode('keyword');
        $data['description'] = $this->Configuration_model->getConfigurationInfoCode('description');

        $this->template->write_view("header", "frontend/include/header", $data);
        $this->template->write_view("content", "frontend/home", $data);
        $this->template->render();
    }

    function search_keyword()
    {
        $keyword = $this->input->post('tour_name');
        $data['results'] = $this->Product_model->search($keyword);
        $data['title1'] = $this->Configuration_model->getConfigurationInfoCode('title');
        $data['slide'] = $this->Slide_model->getSliders();
        //$this->load->view('default/result_view',$data);

        $this->template->write_view("header", "frontend/include/header", $data);
        $this->template->write_view("content", "frontend/result_view", $data);
        $this->template->render();
    }

}

?>