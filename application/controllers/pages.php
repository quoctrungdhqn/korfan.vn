<?php
class Pages extends CI_Controller { 
	   
    public function __construct(){
    	
        parent::__construct();       
        
        $this->load->model('News_model'); 
        $this->load->model('News_category_model');
        $this->load->model('Product_category_model');
        $this->load->model('Product_model');
        $this->load->library('pagination');  
		$this->load->model('Pages_Model');		
        //chu?n b? template, load các v? trí
        $this->template->set_template('default');//Set Template group default        
        $this->template->write_view("menu","default/include/menu");
        $this->template->write_view("left","default/include/left");
        $this->template->write_view("right","default/include/right");
        $this->template->write_view("bottom","default/include/bottom");
    } 
   
   function detail($id)
   {   	
		
   		$data['list'] = $this->Pages_Model->get_items_alias($id);
        if($data['list']==null)
		{
			redirect('my404');
		}
   		$seo_detail = $data['list'];
   		if($seo_detail->seo_title!='')
   		{
			$data['config'] = $this->Pages_Model->get_items_alias($id);
		}
		else
		{
			$data['config'] = $this->Pages_Model->get_items_alias($id);
		}
   		  		
		//truy?n d? li?u ra form
		$this->template->write_view("header","default/include/header",$data);
		$this->template->write_view("content","default/include/pages_detail",$data);
		$this->template->render();	
   }
   
}
?>