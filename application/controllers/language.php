<?php
class Language extends CI_Controller { 
	   
    public function __construct(){
    	
        parent::__construct();
		//$this->load->helper(array("url","text")); 
		$this->load->model('News_model');
		$this->load->model('Product_model');
		$this->load->model('Product_category_model');
		$this->load->model('Configuration_model');
		$this->load->model('Slide_model');
		//chuẩn bị template, load các vị trí
		$this->template->set_template('default');//Set Template group default
		$this->template->write_view("menu","default/include/menu");
		$this->template->write_view("slide_bottom","default/include/slide_bottom");
		$this->template->write_view("right","default/include/right");
		$this->template->write_view("bottom","default/include/bottom");
    } 
   function index($lang,$urlReturn)
   {   	
   	 //$lang = $this->input->get('lang');
   	 //echo $lang;
      //$urlReturn = $this->input->get('return');
      $urlReturn2 = str_replace('hieund','/',$urlReturn);
      $this->config->set_item('language', $lang);
      $this->session->set_userdata('languageTT', $lang);
      redirect(base_url().$urlReturn2);
   }
}
?>