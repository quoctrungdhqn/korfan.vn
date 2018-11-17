<?php
class News extends CI_Controller { 
	   
    public function __construct(){
    	
        parent::__construct();       
        
        $this->load->model('News_model'); 
        $this->load->model('News_category_model');
        $this->load->model('Product_category_model');
        $this->load->model('Product_model');
        $this->load->library('pagination'); 
        $this->load->model('Binhluan_model');      
        //chuẩn bị template, load các vị trí
        $this->template->set_template('default');//Set Template group default        
        $this->template->write_view("menu","default/include/menu");
        $this->template->write_view("left","default/include/left");
        $this->template->write_view("right","default/include/right");
        $this->template->write_view("bottom","default/include/bottom");
    } 
   function index()
   {   	
   		$total				        = 	$this->News_model->get_items_num_cat(1015);
		
			$perpage					=	5; /* Số sản phẩm hiển thị trên một page*/
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
			$config['num_links']		= 	5;	
			
			$config['base_url']			= 	base_url().'/news/index/';
			$config['uri_segment']		= 	3;
			$this->pagination->initialize($config);  # Khởi tạo phân trang
				
			$data['pagination']					= 	$this->pagination->create_links(); # Tạo link phân trang
			$offset 					= 	($this->uri->segment(3)=='') ? 0 : $this->uri->segment(3); # Lấy offset	
			$data['list'] = $this->News_model->get_all_items_cats(1015,$perpage, $offset);
			 $data['config'] =  $this->News_category_model->get_items_info(1015);
   		//print_r($data['list_archive']);exit;
		//truyền dữ liệu ra form
		$this->template->write_view("header","default/include/header",$data);
		$this->template->write_view("content","default/news/news_list",$data);
		$this->template->render();	
   }

function camnang()
   {   	
   		$total				        = 	$this->News_model->get_items_num_cat(1016);
		
			$perpage					=	5; /* Số sản phẩm hiển thị trên một page*/
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
			$config['num_links']		= 	5;	
			
			$config['base_url']			= 	base_url().'/camnang/index/';
			$config['uri_segment']		= 	3;
			$this->pagination->initialize($config);  # Khởi tạo phân trang
				
			$data['pagination']					= 	$this->pagination->create_links(); # Tạo link phân trang
			$offset 					= 	($this->uri->segment(3)=='') ? 0 : $this->uri->segment(3); # Lấy offset	
			$data['list'] = $this->News_model->get_all_items_cats(1016,$perpage, $offset);
			 $data['config'] =  $this->News_category_model->get_items_info(1016);
   		//print_r($data['list_archive']);exit;
		//truyền dữ liệu ra form
		$this->template->write_view("header","default/include/header",$data);
		$this->template->write_view("content","default/news/news_list",$data);
		$this->template->render();	
   }

   public function detail($alias) {
		
		$data['list'] = $this->News_model->get_items_alias($alias);
        $data['config'] =  $this->News_model->get_items_alias($alias);
		
		$detail = $this->News_model->get_items_alias($alias);
		$id = $detail->id;
		$hist = $detail->hits+1;
		
		$data['hits'] = $this->News_model->updateHit($id, $hist);
		
		//echo $hist;
		
		
		//echo $id;
		
		
        // print_r($data['config']);
         //SEO
		
        //SẢn phẩm liên quan
       	$catid = $data['config']->id_category;               
        $data['relative_product'] = $this->News_model->getRelativeProducts($catid,'4');
        				
		//truyền dữ liệu ra form
		$this->template->write_view("header","default/include/header",$data);
		$this->template->write_view("content","default/news/news_detail",$data);
		$this->template->render();
	}   
   function comment()
   { 
   		  
   		if($this->input->post('btnSend')){
				
				$this->load->helper(array('form', 'url'));    
		           
		            //Chuẩn bị dữ liệu lưu đơn hàng xuống db
		            $data = array(
					'namecm' => $this->input->post('namecm'),					
					'noidungcm' => $this->input->post('noidungcm'),	
					'published' => ('0'),	
					'articlesId' => $this->input->post('id')	
					            
				);                        		
		           		//Nếu gửi mail và lưu xuống db thành công
		           		if($this->db->insert('comment', $data)){					
			        	//$this->session->set_flashdata('message', '<div role="alert" class="alert alert-success"><button data-dismiss="alert" class="close" type="button">×</button>Gửi bình luận thành công</div>');
			        	$data['message'] = '<div role="alert" class="alert alert-success"><button data-dismiss="alert" class="close" type="button">×</button>Gửi bình luận thành công</div>';
			        	//redirect('home');
			        }
			        else
			        {
			        	$data['message'] = '<div role="alert" class="alert alert-danger"><button data-dismiss="alert" class="close" type="button">×</button>Gửi thất bại, vui lòng thử lại</div>';
			           // $this->session->set_flashdata('message', '<div role="alert" class="alert alert-danger"><button data-dismiss="alert" class="close" type="button">×</button>Gửi thất bại, vui lòng thử lại</div>');
			        }
				//}			
				
					
		}		
   		//$data['relative_list'] = $this->News_model->get_items_relative();   		
		//truyền dữ liệu ra form
		$this->template->write_view("header","default/include/header",$data);
		$this->template->write_view("content","default/news/news_comment");
		$this->template->render();	
   }
   
   public function category($slug)
   {	
		$id = $this->News_category_model->getProductsSlug($slug);
		$data['id']=$id->id;
		
		$data['list'] = $this->News_model->getAllProductsByCat($id->id);
		
		$data['text'] = $id->detail;
		
		$this->template->write_view("header","default/include/header",$data);
		$this->template->write_view("content","default/news/news_category");
		$this->template->render();
   }
}
?>