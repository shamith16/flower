<?php require_once("includes".DIRECTORY_SEPARATOR."initialize.php");

	// 1. the current page number ($current_page)
	$page = !empty($_GET['page']) ? (int)$_GET['page'] : 1;

	// 2. records per page ($per_page)
	$per_page = 12;

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
            <a href="index.php">Home</a> &gt;&gt; Products
            </div>
            <div class="title"><span class="title_icon"><img src="images/bullet1.gif" alt="" title="" /></span>Our Products</div>
           
                	
        
        	<div class="new_products">
           <?php foreach($photos as $pro):?>
                    <div class="new_prod_box">
                        <a href="more.php?pr=<?php echo $pro->id; ?>&&tb1=1"><?php echo $pro->caption;?></a>
                        <div class="new_prod_bg">
                            <?php 
                            $ps = strtotime($pro->inserted);
                            $previous_week = strtotime("last week"); 
                            if($previous_week <= $ps){
                              echo "<span class=\"new_icon\"><img src=\"images/new_icon.gif\"/></span>";
                              }
                            ?>
                        <a href="more.php?pr=<?php echo $pro->id; ?>&&tb1=1"><img src="<?php echo $pro->image_path();?>" height="90" width="110" class="thumb" border="0" /></a>
                        </div>           
                    </div> 
            <?php endforeach;?>
            </div> 
             
             
<div class="pagination">   
<?php
	if($pagination->total_pages() > 1) {
		
		if($pagination->has_previous_page()) { 
    	echo "<a href=\"products.php?page=";
      echo $pagination->previous_page();
      echo "\">&laquo; Previous</a> "; 
    }
  
		for($i=1; $i <= $pagination->total_pages(); $i++) {
			if($i == $page) {
				echo " <span class=\"current\">{$i}</span> ";
			} else {
				echo " <a href=\"products.php?page={$i}\">{$i}</a> "; 
			}
		}

		if($pagination->has_next_page()) { 
			echo " <a href=\"products.php?page=";
			echo $pagination->next_page();
			echo "\">Next &raquo;</a> "; 
    }
		
	}

?>
</div>  
<div class="clear"></div>
</div>
<?php include_layout_template("footer.php");?>
