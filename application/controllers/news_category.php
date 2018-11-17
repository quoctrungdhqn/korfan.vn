<?php
class News_Category extends CI_Controller { 
	   
    public function __construct(){
    	
        parent::__construct();       
        
        $this->load->model('News_model');
        $this->load->model('News_category_model');
        $this->load->library('pagination');         
        //chuẩn bị template, load các vị trí
        $this->template->set_template('default');//Set Template group default        
        $this->template->write_view("menu","default/include/menu");
        $this->template->write_view("left","default/include/left");
        $this->template->write_view("right","default/include/right");
        $this->template->write_view("bottom","default/include/bottom");
    } 
   function index($id)
   {   	
   		//Lấy tên danh mục
   		$data['cat_title'] = $this->News_category_model->get_items_info($id);
   		//lấy tất cả category con (nếu có)
   		$sub_category = $this->News_category_model->get_sub_category($id);   		
   		if(count($sub_category) > 0){

			foreach($sub_category as $items)
			{
				$array_id[] = $items->id;
			}		

		}
		else 
		{
			$array_id = $id;
		}
   				
   		//Phân trang
   		$total				        = 	$this->News_model->get_items_num_cat($id);   		
		$perpage					=	4; /* Số items hiển thị trên một page*/
		$config['total_rows'] 		= 	$total;
		$config['per_page'] 		= 	$perpage;
		
		$config['full_tag_open'] = "<ul class='pagination'>";
		$config['full_tag_close'] ="</ul>";
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
		$config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
		$config['next_tag_open'] = "<li>";
		$config['next_tagl_close'] = "</li>";
		$config['prev_tag_open'] = "<li>";
		$config['prev_tagl_close'] = "</li>";
		$config['first_tag_open'] = "<li>";
		$config['first_tagl_close'] = "</li>";
		$config['last_tag_open'] = "<li>";
		$config['last_tagl_close'] = "</li>";
		$config['num_links']		= 	10;		
		$config['base_url']			= 	base_url().'/news_category/index/'.$id;
		$config['uri_segment']		= 	4;
		$this->pagination->initialize($config);  # Khởi tạo phân trang
		
		$pagination					= 	$this->pagination->create_links(); # Tạo link phân trang
		$offset 					= 	($this->uri->segment(4)=='') ? 0 : $this->uri->segment(4); # Lấy offset	
		
		$data['list'] 				=   $this->News_model->get_all_items_cats($id, $perpage, $offset);   
		$data['pagination']			=	$pagination;
		//truyền dữ liệu ra form
		$this->template->write_view("header","default/include/header",$data);
		$this->template->write_view("content","default/news/news_category_list",$data);
		$this->template->render();	
   }
   
}
?>