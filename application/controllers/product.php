<?php

	class Product extends CI_Controller { 

    public function __construct(){

        parent::__construct(); 

        $this->load->helper(array("url"));
		$this->load->model('Product_model'); 
        $this->load->model('Product_category_model');         
		$this->load->library('pagination'); 
        //chuẩn bị template, load các vị trí

        $this->template->set_template('default');//Set Template group default        
        $this->template->write_view("menu","default/include/menu");
        $this->template->write_view("left","default/include/left");
        $this->template->write_view("right","default/include/right");
        $this->template->write_view("bottom","default/include/bottom");
        //$this->template->write_view("slide_bottom","default/include/slide_bottom");

    } 

  public function index(){
		
			$total				        = 	$this->Product_model->getProductsNum();
		
			$perpage					=	12; /* Số sản phẩm hiển thị trên một page*/
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
			
			$config['base_url']			= 	base_url().'/product/index/';
			$config['uri_segment']		= 	3;
			$this->pagination->initialize($config);  # Khởi tạo phân trang
				
			$data['pagination']					= 	$this->pagination->create_links(); # Tạo link phân trang
			$offset 					= 	($this->uri->segment(3)=='') ? 0 : $this->uri->segment(3); # Lấy offset	
			$data['list'] = $this->Product_model->getAllProducts($perpage, $offset);		
		
		//truyền dữ liệu ra form
		$this->template->write_view("header","default/include/header",$data);
		$this->template->write_view("content","default/products/product_category",$data);
		$this->template->render();
	}

   public function detail($alias) {
		$data['detail'] = $this->Product_model->getProductAlias($alias);
        $data['config'] = $this->Product_model->getProductAlias($alias);
		$data['category'] = $this->Product_category_model->getAllProductsCategories();
        //SẢn phẩm liên quan

        $catid = $data['detail']->categoryId;               

        $data['relative_product'] = $this->Product_model->getRelativeProducts($catid,'3');	

		//print_r($data['relative_product']);

		//truyền dữ liệu ra form
		$this->template->write_view("header","default/include/header",$data);
		$this->template->write_view("content","default/products/product_detail",$data);
		$this->template->render();

	}

	public function order($id) {	
		
		$data['detail'] = $this->Product_model->getProductInfo($id);
		$data['config'] = $this->Product_model->getProductInfo($id);
		
		if($this->input->post('btnSend')){ 			
			
			$this->load->helper(array('form','url'));
			$config = array(
				'protocol' => 'smtp',
				'smtp_host'=> 'ssl://smtp.googlemail.com',
				'smtp_port'=> '465',
				'smtp_user'=> 'fireroxlv@gmail.com',
				'smtp_pass'=> 'Firerox@2016'
			);

			//if ($this->form_validation->run() != FALSE){
			$this->load->library('email', $config);
			$this->email->set_newline("\r\n");
			$config['mailtype'] = 'html';
			$this->email->initialize($config);
			//$link_web = "http://firerox.info/uploads/product/".$this->input->post('image');
			$link_web = $this->input->post('linkweb');
			$message = "<div><h3>Thông tin khách hàng</h3><div>Tên tour : ".$this->input->post('tour')."</div><div>Tên khách hàng : ".$this->input->post('name')."</div><div>Địa chỉ email : ".$this->input->post('email')."</div><div>Điện thoại : ".$this->input->post('phone')."</div><div>Địa chỉ : ".$this->input->post('address')."</div>";
			$message .= $this->input->post('message');
			$message .= "</div>";
			$message .= "
			<style>
			.table-bordered {
			border: 1px solid #ddd;
			}
			table {
			background-color: transparent;
			max-width: 100%;
			}
			</style>
			";
			$this->email->from($this->input->post('email'), $this->input->post('title'));
			$this->email->reply_to($this->input->post('email'));
			$this->email->to('buiphankhai1979@gmail.com');
			//$this->email->cc('admin@firerox.org,hieund@firerox.org');	
			//$this->email->bbc('hieund@firerox.org');			
			$this->email->subject('Yêu cầu đặt tour trên dulichbiendaokyco.com');
			$this->email->message($message);
			if($this->email->send())
			{
				//$this->session->set_flashdata('message', '<div role="alert" class="alert alert-success"><button data-dismiss="alert" class="close" type="button">×</button>Mail sent. Thanks !</div>');
				echo "<script>alert('Yêu cầu thành công! Chúng tôi sẽ liên hệ trong thời gian sớm nhất. Xin cảm ơn quý khách!')</script>";
			}
			else
			{
				show_error($this->email->print_debugger());
			}
		}
		       
		//truyền dữ liệu ra form
		$this->template->write_view("header","default/include/header",$data);

		$this->template->write_view("content","default/products/order",$data);

		$this->template->render();

	}

	public function search() {

		

		$data['title']= $this->Configuration_model->getConfigurationInfoCode('title');

		$data['keyword']= $this->Configuration_model->getConfigurationInfoCode('keyword');

		$data['description']= $this->Configuration_model->getConfigurationInfoCode('description');

		$data['list'] = $this->Product_model->getSearchProducts();

		//truyền dữ liệu ra form

		$this->template->write_view("header","default/header",$data);

		$this->template->write_view("content","default/product_search",$data);

		$this->template->render();

	}

	

}

?>