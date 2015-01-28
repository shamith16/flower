<?php require_once("..".DIRECTORY_SEPARATOR."includes".DIRECTORY_SEPARATOR."initialize.php");
if($session->is_logged_in()){
    if(User::access_b_end($session->user_id)){redirect_to("login.php");}
    }
elseif(!$session->is_logged_in()){
        redirect_to("login.php");
    }
$me =  User::get_username($session->user_id);

	// 1. the current page number ($current_page)
	$page = !empty($_GET['page']) ? (int)$_GET['page'] : 1;

	// 2. records per page ($per_page)
	$per_page = 3;

	// 3. total record count ($total_count)
	$total_count = Photograph::count_all();
	

	// Find all photos
	// use pagination instead
	//$photos = Photograph::find_all();
	
	$pagination = new Pagination($page, $per_page, $total_count);
	
	// Instead of finding all records, just find the records 
	// for this page
	$sql = "SELECT * FROM photographs ";
    //$sql .= "ORDER BY RAND( ) ";
	$sql .= "LIMIT {$per_page} ";
	$sql .= "OFFSET {$pagination->offset()} ";
    
	$photos = Photograph::find_by_sql($sql);
	
	// Need to add ?page=$page to all links we want to 
	// maintain the current page (or store $page in $session)
	

include_layout_template("admin_header.php");
?>
<div class="admin_left_content">  	
            <div class="title"><span class="title_icon"><img src="../images/bullet1.gif" alt="" title="" /></span>Featured Products</div>
        <?php foreach($photos as $pro):?>
        	<div class="feat_prod_box">
            	<div class="prod_img"><img src="<?php echo "../".$pro->image_path(); ?>" width="80" border="0" /></div>
                <div class="prod_det_box">
                	<div class="box_top"></div>
                    <div class="box_center">
                    <div class="prod_title"><?php echo $pro->caption ?></div>
                    <p class="details"><?php echo substr(strip_tags($pro->description,"<a>"),0,200)." ..."; ?></p>
                    <a class="more">- more details -</a>
                    <div class="clear"></div>
                    </div>
                    <div class="box_bottom"></div>
                </div>  
                
            <div class="clear"></div>
            </div>
            <?php endforeach;?>  
            
            	
    <div class="clear"></div>
    
<div class="pagination">   
<?php
	if($pagination->total_pages() > 1) {
		
		if($pagination->has_previous_page()) { 
    	echo "<a href=\"index.php?page=";
      echo $pagination->previous_page();
      echo "\">&laquo; </a> "; 
    }
		if($pagination->has_next_page()) { 
			echo " <a href=\"index.php?page=";
			echo $pagination->next_page();
			echo "\"> &raquo;</a> "; 
    }
		
	}

?>
</div> 
<div class="clear"></div>
<div class="title"><span class="title_icon"><img src="../images/bullet2.gif" alt="" title="" /></span>New Products</div> 
           
           <div class="new_products">
           <?php foreach($photos as $pro):
                            $ps = strtotime($pro->inserted);
                            $previous_week = strtotime("last week"); 
                            if($previous_week <= $ps){
                              echo "<div class=\"new_prod_box\">";
                                echo "<a>$pro->caption</a>";
                                echo "<div class=\"new_prod_bg\">";
                                echo "<span class=\"new_icon\"><img src=\"../images/new_icon.gif\" /></span>";
                                $img_pa="../".$pro->image_path();
                                echo "<a><img src=\"$img_pa\" height=\"90\" width=\"110\" class=\"thumb\" border=\"0\" /></a>";
                                echo "</div>";
                              echo "</div>";
                              }
                            
            endforeach;?>
            </div>
<div class="clear"></div>
</div>

        <div class="admin_right_content">

             <div class="title" style="font-size: small;"><span class="title_icon"><img src="../images/bullet3.gif" alt="" title="" /></span><?php echo output_message($me);?></div> 
            
             <div class="admin_about">
             <p>
             <img src="../images/about.png" alt="" title="" class="right" />
              Welcome to the Administrative area of Flower Shop.
              <br /><br />
              You can logout by pressing this link .<br /><a href="logout.php" style="font-size: 10px;">Logout</a>
              </p>
             </div>
             
        <div class="clear"></div>
        </div><!--end of right content-->
<?php include_layout_template("admin_footer.php");?>

