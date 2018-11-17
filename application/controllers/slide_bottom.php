<?php
class Slide_bottom extends CI_Controller
{

	public function __construct()
	{

		parent::__construct();

		$this->load->model('News_model');
		$this->load->model('Product_model');
		$this->load->model('Product_category_model');
		$this->load->model('Configuration_model');
		$this->load->model('Web_Link_Model');
		$this->load->model('Slide_model');
		//chuẩn bị template, load các vị trí
		$this->template->set_template('default');//Set Template group default
		$this->template->write_view("menu","default/include/menu");
		$this->template->write_view("slide_bottom","default/include/slide_bottom");
		$this->template->write_view("right","default/include/right");
		$this->template->write_view("bottom","default/include/bottom");
	}
	function index()
	{
		$data['artiles'] = $this->News_Model->get_all_items();
		
		$data['title1'] = $this->Configuration_model->getConfigurationInfoCode('title');
		$data['keyword'] = $this->Configuration_model->getConfigurationInfoCode('keyword');
		$data['description'] = $this->Configuration_model->getConfigurationInfoCode('description');
		//truyền dữ liệu ra form
		$this->template->write_view("header","default/include/header",$data);
		$this->template->write_view("menu","default/include/menu",$data);
		//$this->template->write_view("content","default/home", $data);
		$this->template->render();
	}

}
?>