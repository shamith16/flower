<?php require_once("includes".DIRECTORY_SEPARATOR."initialize.php");
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
include_layout_template("header.php");

?>

<div class="left_content">
    
    <div class="slider-wrapper theme-default">
            <div class="ribbon"></div>
            <div id="slider" class="nivoSlider">
                <img src="images/slide1.jpg" alt="" />
                <a href="http://dev7studios.com"><img src="images/slide2.jpg" alt="" title="Earth laughs in flowers. ~ Henry David Thoreau" /></a>
                <img src="images/slide3.jpg" alt="" data-transition="slideInLeft" />
                <img src="images/slide4.jpg" alt="" title="#htmlcaption" />
            </div>
            
            <div id="htmlcaption" class="nivo-html-caption">
                <strong>Flowers</strong> are our greatest silent <em>friends. </em> ~ <a href="#"> Jim Brown</a>.
            </div>
    </div> 
    
    <div class="title"><span class="title_icon"><img src="images/bullet1.gif" alt="" title="" /></span>Featured Products</div>        
        <?php foreach($photos as $pro):?>
        	<div class="feat_prod_box">
            	<div class="prod_img"><a href="more.php?pr=<?php echo $pro->id; ?>&&tb1=1"><img src="<?php echo $pro->image_path(); ?>" width="80" border="0" /></a></div>
                <div class="prod_det_box">
                	<div class="box_top"></div>
                    <div class="box_center">
                    <div class="prod_title"><?php echo $pro->caption ?></div>
                    <p class="details"><?php echo substr(strip_tags($pro->description,"<a>"),0,200)." ..."; ?></p>
                    <a href="more.php?pr=<?php echo $pro->id; ?>&&tb1=1" class="more">- more details -</a>
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
<div class="title"><span class="title_icon"><img src="images/bullet2.gif" alt="" title="" /></span>New Products</div> 
           
           <div class="new_products">
           <?php foreach($photos as $pro):
                            $ps = strtotime($pro->inserted);
                            $previous_week = strtotime("last week"); 
                            if($previous_week <= $ps){
                              echo "<div class=\"new_prod_box\">";
                                echo "<a href=\"more.php?pr={$pro->id}&&tb1=1\">$pro->caption</a>";
                                echo "<div class=\"new_prod_bg\">";
                                echo "<span class=\"new_icon\"><img src=\"images/new_icon.gif\" /></span>";
                                $img_pa=$pro->image_path();
                                echo "<a href=\"more.php?pr={$pro->id}&&tb1=1\"><img src=\"$img_pa\" width=\"110\" height=\"90\" class=\"thumb\" border=\"0\" /></a>";
                                echo "</div>";
                              echo "</div>";
                              }
                            
            endforeach;?>
            </div>
<div class="clear"></div>
</div>

<?php include_layout_template("footer.php");?>
