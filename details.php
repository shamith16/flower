<?php require_once("includes".DIRECTORY_SEPARATOR."initialize.php");

	// 1. the current page number ($current_page)
	$page = !empty($_GET['page']) ? (int)$_GET['page'] : 1;

	// 2. records per page ($per_page)
	$per_page = 5;

	// 3. total record count ($total_count)
	$total_count = Photograph::count_all();
	

	// Find all photos
	// use pagination instead
	//$photos = Photograph::find_all();
	
	$pagination = new Pagination($page, $per_page, $total_count);
	
	// Instead of finding all records, just find the records 
	// for this page
	$sql = "SELECT * FROM photographs ";
	$sql .= "LIMIT {$per_page} ";
	$sql .= "OFFSET {$pagination->offset()}";
	$photos = Photograph::find_by_sql($sql);
	
	// Need to add ?page=$page to all links we want to 
	// maintain the current page (or store $page in $session)
	

include_layout_template("header.php");
?>
<div class="left_content">
 <div class="crumb_nav">
            <a href="index.php">Home</a> &gt;&gt; Details
            </div>
            <div class="title"><span class="title_icon"><img src="images/bullet1.gif" alt="" title="" /></span>Product Details</div>

        	<div class="feat_prod_box_details">
            
           <?php $list=0; foreach($photos as $pro):?>
		
                <div class="prod_img"  style="padding-bottom: 50px;"><a href="more.php?pr=<?php echo $pro->id; ?>&&tb1=1"><img src="<?php echo $pro->image_path(); ?>"  width="130px" border="0" /></a>
                <div align="left"><a href="<?php echo $pro->image_path(); ?>" rel="lightbox"><img src="images/zoom.png"  height="40px" width="60px" border="0" /></a>
                <a href="comments.php?id=<?php echo $pro->id; ?>&&bk=<?php echo $pagination->current_page;?>" class="com_btn" title="comments"><?php echo count($pro->comments());?></a>
                </div>
                </div>
                
                <div class="prod_det_box">
                	<div class="box_top"></div>
                    <div class="box_center">
                    <div class="prod_title"><?php echo $pro->caption; ?></div>
                    <p class="details"><?php echo substr(strip_tags($pro->description,"<a>"),0,200)." ..."; ?></p>
                    <div class="price"><strong>Price : </strong> <span class="red" style="font-size: 12px;"><b><?php echo $pro->price; ?> $</b></span></div>
                    <div class="price"><strong>Color : </strong> 
                    <span class="colors"><img src="images/pro_color_frame.png"  width="15px" border="0" style="background-color: #<?php echo $pro->color; ?>;" /></span>                    
                    </div>
                    <a href="more.php?pr=<?php echo $pro->id; ?>&&tb1=1" class="more">more</a>
                    <div class="clear"></div>
                    </div>
                    
                    <div class="box_bottom"></div>
                </div>    
            <div class="clear"></div>                
            <div  style="margin-bottom: 3em; width: 500px;"><span  class='st_yahoo_hcount' displayText='Yahoo'></span><span  class='st_twitter_hcount' displayText='Tweet'></span><span  class='st_facebook_hcount' displayText='Facebook'></span><span  class='st_stumbleupon_hcount' displayText='StumbleUpon'></span><span  class='st_plusone_hcount' ></span></div>                        
            <?php $list++; endforeach; ?>
            </div> 
   
             
             
<div class="pagination">   
<?php
	if($pagination->total_pages() > 1) {
		
		if($pagination->has_previous_page()) { 
    	echo "<a href=\"details.php?page=";
      echo $pagination->previous_page();
      echo "\">&laquo; Previous</a> "; 
    }
  
		for($i=1; $i <= $pagination->total_pages(); $i++) {
			if($i == $page) {
				echo " <span class=\"current\">{$i}</span> ";
			} else {
				echo " <a href=\"details.php?page={$i}\">{$i}</a> "; 
			}
		}

		if($pagination->has_next_page()) { 
			echo " <a href=\"details.php?page=";
			echo $pagination->next_page();
			echo "\">Next &raquo;</a> "; 
    }
		
	}

?>
</div>  
<div class="clear"></div>
</div>
<?php include_layout_template("footer.php");?>