<?php require_once("includes".DIRECTORY_SEPARATOR."initialize.php");
    if(empty($_GET['pr'])) {
	  $session->message("No photograph ID was provided.");
	  redirect_to('details.php');
	}
	
    $pro = Photograph::find_by_id($_GET['pr']);
    $category = $pro->category_id;
    if(!$pro) {
    $session->message("The photo could not be located.");
    redirect_to('details.php');
    }

    $cate = Category::find_by_id($category);
    $all_pro = Photograph::find_were_cate($category);
    
   	// 1. the current page number ($current_page)
	$page = !empty($_GET['page']) ? (int)$_GET['page'] : 1;

	// 2. records per page ($per_page)
	$per_page = 6;

	// 3. total record count ($total_count)
	$total_count = count($all_pro);
	

	// Find all photos
	// use pagination instead
	//$photos = Photograph::find_all();
	
	$pagination = new Pagination($page, $per_page, $total_count-1);
	
	// Instead of finding all records, just find the records 
	// for this page
	$sql = "SELECT * FROM photographs ";
    $sql .= "WHERE category_id = {$pro->category_id} ";
    $sql .= "AND id != {$pro->id} ";
	$sql .= "LIMIT {$per_page} ";
	$sql .= "OFFSET {$pagination->offset()} ";
    
	$per_pag_cate_p = Photograph::find_by_sql($sql);
	

include_layout_template("header.php");
?>
<div class="left_content">
 <div class="crumb_nav">

            <a href="details.php">Details</a> &gt;&gt; <?php echo $pro->caption; ?>
            </div>
            <div class="title"><span class="title_icon"><img src="images/bullet1.gif" alt="" title="" /></span><?php echo $pro->caption; ?></div>

        	<div class="feat_prod_box_details">
           
                <div class="prod_img"  style="padding-bottom: 50px;"><img src="<?php echo $pro->image_path(); ?>"  width="130" border="0" /><br/><br/>
                <a href="<?php echo $pro->image_path(); ?>" rel="lightbox"><img src="images/zoom.png"   border="0" /></a>
                </div>
                
                <div class="prod_det_box">
                	<div class="box_top"></div>
                    <div class="box_center">
                    
                        <div class="simpleCart_shelfItem">
                    <div class="prod_title" ><p class="item_name"><?php echo $pro->caption; ?></p></div>
                    <p class="details"><?php echo substr(strip_tags($pro->description,"<a>"),0,200)." ..."; ?></p>
                    <div class="price"><strong>Price : </strong> <span class="red" style="font-size: 12px;"><b class="item_price"><?php echo $pro->price; ?> $</b></span></div>
                    <div class="price"><strong>Color : </strong> 
                    <span class="colors"><img src="images/pro_color_frame.png"  width="15px" border="0" style="background-color: #<?php echo $pro->color; ?>;" /></span>  
                    </div>
                            <input type="hidden" class="item_thumb" src="<?php echo $pro->image_path(); ?>"  />
                            <input type="hidden" class="item_shipping" value="20" />
                            <?php	
                              //if($session->is_logged_in()){
                                echo "<div class=\"price\"><strong>Quantity : </strong><input onkeypress=\"return isNumberKey(event)\" type=\"text\" class=\"item_quantity\" size=\"3\" maxlength=\"5\" value=\"1\" /></div>";
                                echo "<div class=\"item_add\" style=\"margin-right: 10px;\" ><input type=\"button\" class=\"register\" value=\"add to cart\" /></div>";
                              //}
                            ?>
                        </div>
                                
                    
                    </div>
                    <div class="clear"></div> 
                    <div class="box_bottom"></div>
                </div>  
                <div class="clear"></div> 
             <div id="demo" class="demolayout">

                <ul id="demo-nav" class="demolayout">
                <li><a class="<?php echo ($_GET['tb1'])==true ? active:null; ?>" href="more.php?pr=<?php echo $pro->id; ?>&&tb1=1">More details</a></li>
                <li><a class="<?php echo ($_GET['tb2'])==true ? active:null; ?>" href="more.php?pr=<?php echo $pro->id; ?>&&tb2=1">Related Products</a></li>
                </ul>
    
             <div class="tabs-container">
            
                    <div style="display:<?php echo (isset($_GET['tb1']) || isset($_GET['tb2']) == false) ? "block":"none"; ?>;" class="tab" id="tb1">
                            <div style="padding-right: 50px; padding-left: 20px; line-height: 1.5;" >
                            <ul class="list">
                            <li>&nbsp;</li>
                            <a><?php echo $pro->caption; ?> Details : </a>
                            <li>&nbsp;</li>
                            <li><a>Category Name : <?php echo $cate->category_name ; ?> </a></li>
                            <li><a>Family : <?php echo $pro->family; ?>  </a></li>
                            <li><a>Sub Category : <?php echo $cate->subcategory ; ?>  </a></li>  
                            <li>&nbsp;</li>
                            <a>Description : </a>                                      
                            </ul>
                            <p class="more_details"><?php echo strip_tags($pro->description,"<strong><li><ul><p><br><b><a>"); ?></p>                           
                            </div>                    
                    </div>	
                    
                    <div style="display:<?php echo (isset($_GET['tb2'])) ? "block":"none"; ?>;" class="tab" id="tb2">
                        <?php foreach($per_pag_cate_p as $list_cate): ?>
                        <div class="new_prod_box">
                        <a href="more.php?pr=<?php echo $list_cate->id; ?>&&tb1=1"><?php echo $list_cate->caption; ?></a>
                        <div class="new_prod_bg">
                        <a href="more.php?pr=<?php echo $list_cate->id;?>&&tb1=1"><img src="<?php echo $list_cate->image_path(); ?>" alt="" width="110" height="90"  title="" class="thumb" border="0" /></a>
                        </div>           
                        </div>
                        <?php endforeach;?>

                    <div class="clear"></div>
                    <div class="pagination">   
<?php
	if($pagination->total_pages() > 1) {
		
		if($pagination->has_previous_page()) { 
    	echo "<a href=\"more.php?pr={$pro->id}&&tb2=1&&page=";
      echo $pagination->previous_page();
      echo "\">&laquo; Previous</a> "; 
    }
  
		for($i=1; $i <= $pagination->total_pages(); $i++) {
			if($i == $page) {
				echo " <span class=\"current\">{$i}</span> ";
			} else {
				echo " <a href=\"more.php?pr={$pro->id}&&tb2=1&&page={$i}\">{$i}</a> "; 
			}
		}

		if($pagination->has_next_page()) { 
			echo " <a href=\"more.php?pr={$pro->id}&&tb2=1&&page=";
			echo $pagination->next_page();
			echo "\">Next &raquo;</a> "; 
    }
		
	}

?>
</div> 
                    </div>	
            
            </div>


			</div> 
            <div class="clear"></div>
                            
            </div> 
   
             
             
 
<div class="clear"></div>
</div>
<?php include_layout_template("footer.php");?>