<?php 
	$CI =& get_instance();
	$CI->load->model('Product_category_model');	
	$CI->load->model('News_model');	
	$news = $CI->News_model->get_all_items_cats(1015,10,0);	
	
	$menu = array();	   
	$menu = $CI->Product_category_model->getCategoryChild(1000); // lấy menu root
	$menu_sub = array();
	if($menu)
	{
	   foreach($menu as $k => $v)	           		
		$menu_sub[$k]= $CI->Product_category_model->getCategoryChild($v['id']); //lấy sub-menu kế tiếp root             
	}	    
	    $data['menu'] = $menu;
	    $data['menu_sub'] = $menu_sub;	 
	    $i=0;   
?>	
<div class="left" id="cphMain_ctl00_LeftPane">
<div class="DefaultModule cate-menu" id="cate-menu">
    <div class="defaultTitle cate-menu-title">
        <span>Danh mục tour</span>
    </div>
    <div class="defaultContent cate-menu-content">
       <ul>
            <?php foreach($menu as $list){?>
                    <li class="level0 level0-1770824 first"><a href="<?php echo base_url(); ?>danh-muc-tour/<?php echo $list['alias']?>">
                        <span>
                           <?php echo $list['name']?></span></a>
                           <?php 		
            if ($menu_sub[$i] != null) {?>
                        <ul style="display: block;">
                            <?php 
				   	foreach($menu_sub as $k=>$v) {																								foreach($v as $item){
					if($list['id']==$item['parents']){
				   ?>
                                    <li class="level1 level1-1770828 first"><a href="<?php echo base_url(); ?>danh-muc-tour/<?php echo $item['alias']?>">
                                        <span>
                                            <?php echo $item['name']?></span></a>
                                        
                                    </li>
                                
                            <?php } }}?>         
                                
                        </ul>
			 <?php } ?>     
                    </li>
                
             <?php } ?>      
                
        </ul>
    </div>
    <div class="defaultFooter cate-menu-footer"><div></div></div>
</div>

<span class="hidden">
    </span>
<div class="newsLastest DefaultModule">
    <div class="defaultTitle newsLastest-Title">
        <span>Tin du lịch</span></div>
    <div class="defaultContent newsLastest-content">
        <?php
				if(count($news) > 0){
					foreach($news as $items){
				
			?>	
                <div class="newsLastest_Item">
                    <div class="newsLastest_Image">
                        <a href="<?php echo base_url()?>bai-viet/<?php echo $items->alias?>">
                            <img title="<?php echo $items->title;?>" width="60" height="60" src="<?php echo base_url(); ?>uploads/news/thumb_<?php echo $items->images; ?>"/>
                        </a>
                    </div>
                    <div class="newsLastest_Title">
                        <a href="<?php echo base_url()?>bai-viet/<?php echo $items->alias?>"><span>
                             <?php echo $items->title;?></span></a>
                        <p class="newsLastest_Summary">
                           <?php  
                      $text = strip_tags($items->detail);
             		  echo word_limiter($text,50);
            	    ?>

                        </p>
                    </div>
                    <div class="Clear"></div>
                </div>
            <div class="viewMore">
            <a href="<?php echo base_url()?>bai-viet/<?php echo $items->alias?>">
                Xem thêm
            </a>
        </div>
        <div class="Clear"></div>
           <?php
				}
					//echo $pagination;
					}     
            ?>
        
        
        
        
    </div>
    <div class="clear defaultFooter newsLastest-footer"><div></div></div>
</div>


<div class="DefaultModule" id="TextHTML-Module">
    <p><img style="height: 290px; width: 280px;" src="http://media.bizwebmedia.net/Sites/105759/data/banners/bannerqc.png?0"></p>
        
</div>
</div>