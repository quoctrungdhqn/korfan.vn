<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct(){
    	
        parent::__construct(); 
        
        $this->load->helper(array("url"));         
        $this->load->model('News_Model');
        $this->load->model('Product_Model');
        //chuẩn bị template, load các vị trí
        $this->template->set_template('admin');//Template group admin
        $this->template->write_view("header","admin/include/header");
        $this->template->write_view("menu","admin/include/menu");
        $this->template->write_view("left","admin/include/left");
        $this->template->write_view("right","admin/include/right");
        $this->template->write_view("bottom","admin/include/bottom");
    } 
   function index()
   {
   		$data['product'] = $this->Product_Model->getAllProducts('5','0');
   		$data['product_no_limit'] = $this->Product_Model->getAllProductsNoLimit();
   		$data['news'] = $this->News_Model->get_all_items_limit('5','0');
   		$data['news_no_limit'] = $this->News_Model->get_all_items();
   		$this->template->write("title","Trang chủ");
        $this->template->write_view("content","admin/dashboard",$data);
        //Hiển thị nội dung ra template
        $this->template->render();
   }
}