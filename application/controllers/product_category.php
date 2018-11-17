<?php

	class Product_category extends CI_Controller { 

	   

    public function __construct(){

        parent::__construct(); 

        $this->load->helper(array("url"));
        $this->load->model('Product_category_model');
		$this->load->model('Configuration_model');
        $this->load->model('Product_model');         

        //chuẩn bị template, load các vị trí

        $this->template->set_template('default');//Set Template group default        
        $this->template->write_view("menu","default/include/menu");
        $this->template->write_view("left","default/include/left");
        $this->template->write_view("right","default/include/right");
        //$this->template->write_view("slide_bottom","default/include/slide_bottom");
        $this->template->write_view("bottom","default/include/bottom"); 

    } 

    public function category($slug){

    	$id = $this->Product_category_model->getProductsSlug($slug);
		
		$data['list'] = $this->Product_model->getAllProductsByCat($id->id);
		
		//$data['list_1'] = $this->Product_model->getAllProductLimitsId_1();
		//echo $id->id;
		$data['child_prents'] = $this->Product_category_model->getCategoryChild($id->id);
		
		$data['text'] = $id->detail;
		$data['name'] = $id->name;
		$data['id'] = $id->id;
		
		//SEO

		$data['title1'] = $this->Configuration_model->getConfigurationInfoCode('title');
		$data['keyword'] = $this->Configuration_model->getConfigurationInfoCode('keyword');
		$data['description'] = $this->Configuration_model->getConfigurationInfoCode('description');

		//truyền dữ liệu ra form

		$this->template->write_view("header","default/include/header",$data);

		$this->template->write_view("content","default/products/product_category",$data);

		$this->template->render();

	}

	

  

   public function detail($alias) {

		

		$data['detail'] = $this->Product_model->getProductAlias($alias);

        

        //SẢn phẩm liên quan

        $catid = $data['detail']->categoryId;               

        $data['relative_product'] = $this->Product_model->getRelativeProducts($catid,'5');				

		//truyền dữ liệu ra form

		$this->template->write_view("content","default/products/product_detail",$data);

		$this->template->render();

	}

	

	public function search() {

		$data['list'] = $this->Product_model->getSearchProducts();

		//truyền dữ liệu ra form

		$this->template->write_view("content","default/product_detail",$data);

		$this->template->render();

	}

	public function menu() {

		$menu = array();	   

	    $menu = $this->Product_category_model->getCategoryChild(1000); // lấy menu root

	    $menu_sub = array();

	    if($menu){

	           foreach($menu as $k => $v)

	                 $menu_sub[$k]= $this->Product_category_model->getCategoryChild($v['id']); //lấy sub-menu kế tiếp root

	    }	    

	    $data['menu'] = $menu;

	    $data['menu_sub'] = $menu_sub;

	    $data['data']= array( 'menu' => $menu, 'menu1' => $menu_sub );

	    //truyền dữ liệu ra form

		$this->template->write_view("content","default/menutest",$data);

		$this->template->render();

	}

}

?>