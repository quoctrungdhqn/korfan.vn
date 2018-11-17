<div class="NewsListContainer DefaultModule ListItems">
    <div class="newsCategory defaultTitle">
        <h1>
        <?php echo $config->title;?>
            </h1>
    </div>
    <div class="defaultContent newsList">
    <?php if(count($list)>0){?>
    <?php foreach($list as $items){?>
        
                <table cellspacing="0" cellpadding="0" class="newsList_Item">
                    <tbody>
                    <tr>
                        <td class="newsList_Image">
                            <a href="<?php echo base_url()?>bai-viet/<?php echo $items->alias;?>">
                                <img alt="<?php echo $items->title;?>" src="<?php echo base_url()?>uploads/news/<?php echo $items->images;?>">
                            </a>
                        </td>
                        <td class="newsList_Content">
                            <div>
                                <a class="newsList_Title" href="<?php echo base_url()?>bai-viet/<?php echo $items->alias;?>">
                                    <?php echo $items->title;?>
                                </a> 
                                <span style="display: none;" class="newsList_Date">
                                    (04/09/2014 11:26:00 SA)</span>
                            </div>
                            <div>
                                <span class="newsList_Summary">
                                    <?php  
                      $text = strip_tags($items->detail);
             		  echo word_limiter($text,50);
            	    ?>
</span> <span class="newsList_LinkDetail"></span>
                            </div>
                        </td>
                    </tr>
                </tbody></table>
                <hr class="newsList_Seperator">
            
      <?php } 
      	}
      	else{
			echo "Nội dung đang cập nhật";
		}
      ?>        
               
    </div>
     <?php echo $pagination;?>
    <div class="clear defaultFooter newsList-footer">
        <div>
       
        </div>
    </div>
    <div class="clear">
    </div>
</div>