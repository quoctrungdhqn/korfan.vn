<?php
class Menu extends CI_Controller
{

	public function __construct()
	{

		parent::__construct();

		$this->load->model('News_model');
		$this->load->model('Pages_Model');
		$this->load->model('Product_model');
		$this->load->model('Product_category_model');
		$this->load->model('Configuration_model');
		$this->load->model('Web_Link_Model');
		$this->load->model('Slide_model');
		//chuẩn bị template, load các vị trí
		$this->template->set_template('default');//Set Template group default
		$this->template->write_view("menu","default/include/menu");
		// $this->template->write_view("left","default / include / left");
		$this->template->write_view("right","default/include/right");
		$this->template->write_view("bottom","default/include/bottom");
	}
	function index()
	{
		$data['category'] = $this->Product_category_model->getAllProductsCategories();
		$data['slide'] = $this->Slide_model->getSliders();
		$data['title1'] = $this->Configuration_model->getConfigurationInfoCode('title');
		$data['keyword'] = $this->Configuration_model->getConfigurationInfoCode('keyword');
		$data['description'] = $this->Configuration_model->getConfigurationInfoCode('description');

		//truyền dữ liệu ra form
		$this->template->write_view("header","default/include/header",$data);
		$this->template->write_view("menu","default/include/menu",$data);
		//$this->template->write_view("content","default/home", $data);
		$this->template->render();
	}
	

	
	function detail_leu()
	{
		$this->template->write_view("header","default/include/header");
		$this->template->write_view("menu","default/include/cho_thue_leu");
		//$this->template->write_view("content","default/home", $data);
		$this->template->render();
	}
	
	function detail_amthanh()
	{
		$this->template->write_view("header","default/include/header");
		$this->template->write_view("menu","default/include/am_thanh");
		//$this->template->write_view("content","default/home", $data);
		$this->template->render();
	}
	
	function detail_7()
	{	
		$this->template->write_view("header","default/include/header");
		$this->template->write_view("menu","default/include/xe_7");
		//$this->template->write_view("content","default/home", $data);
		$this->template->render();
	}
	
	function detail_16()
	{	
		$this->template->write_view("header","default/include/header");
		$this->template->write_view("menu","default/include/xe_16");
		//$this->template->write_view("content","default/home", $data);
		$this->template->render();
	}
	
	function detail_29()
	{	
		$this->template->write_view("header","default/include/header");
		$this->template->write_view("menu","default/include/xe_29");
		//$this->template->write_view("content","default/home", $data);
		$this->template->render();
	}
	
	function detail_45()
	{	
		$this->template->write_view("header","default/include/header");
		$this->template->write_view("menu","default/include/xe_45");
		//$this->template->write_view("content","default/home", $data);
		$this->template->render();
	}
	
	function detail()
	{	
		$this->template->write_view("header","default/include/header");
		$this->template->write_view("menu","default/include/cho_thue_xe");
		//$this->template->write_view("content","default/home", $data);
		$this->template->render();
	}
	
	
	function detail_visa()
	{	
		$this->template->write_view("header","default/include/header");
		$this->template->write_view("menu","default/include/visa");
		//$this->template->write_view("content","default/home", $data);
		$this->template->render();
	}
}
?>