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
	$per_page = 10;

	// 3. total record count ($total_count)
	$total_count = Photograph::count_all();
	

	// Find all photos
	// use pagination instead
	//$photos = Photograph::find_all();
	
	$pagination = new Pagination($page, $per_page, $total_count);
	
	// Instead of finding all records, just find the records 
	// for this page
	$sql = "SELECT * FROM photographs ";
    $sql .= "ORDER BY id ASC ";
	$sql .= "LIMIT {$per_page} ";
	$sql .= "OFFSET {$pagination->offset()} ";
    
	$photos = Photograph::find_by_sql($sql);
	
	// Need to add ?page=$page to all links we want to 
	// maintain the current page (or store $page in $session)
	

include_layout_template("admin_header.php");
?>
<div class="admin_left_content">
        	
        <div class="title"><span class="title_icon"><img src="../images/bullet1.gif" alt="" title="" /></span>Products List</div>
        <div class="feat_prod_box"></div>
        <?php echo "<p>".output_message($message)."</p><br/>"; ?>
              <table align="center" style="font-size: 11px;" >
              <tr style="color: #6CAB52;">
              <th>ID</th>
              <th>Image</th>
              <th>Filename</th>
              <th>Name</th>
              <th>Size</th>
              <th>Type</th>
		      <th>Comments</th>
		      <th>&nbsp;</th>
            </tr>
        <?php foreach($photos as $pro):?>
        	<tr align="center">
              <td width="10px"><a><?php echo "{$pro->id}."; ?></a></td>
              <td><br /><a href="../<?php echo $pro->image_path(); ?>" rel="lightbox"><img src="../<?php echo $pro->image_path(); ?>" width="80" /></a></td>
              <td><?php echo $pro->filename; ?> </td>
              <td><?php echo $pro->caption; ?></td>
              <td><?php echo $pro->size_as_text(); ?></td>
              <td><?php echo $pro->type; ?></td>
              <td><a href="comments.php?id=<?php echo $pro->id; ?>"><?php echo count($pro->comments()); ?></a></td>
              <td><a href="delete_photo.php?id=<?php echo $pro->id; ?>">Delete</a>
              <br /><br /><a href="update_product.php?id=<?php echo $pro->id; ?>">Update</a>
              </td>
            </tr>
            <?php endforeach;?>  
           </table>            
            	
    <div class="clear"></div>
    
    <div class="feat_prod_box"></div>
<div class="admin_pagination">   
<?php
	if($pagination->total_pages() > 1) {
		
		if($pagination->has_previous_page()) { 
    	echo "<a href=\"products_list.php?page=";
      echo $pagination->previous_page();
      echo "\">&laquo; Previous</a> "; 
    }
        for($i=1; $i <= $pagination->total_pages(); $i++) {
			if($i == $page) {
				echo " <span class=\"current\">{$i}</span> ";
			} else {
				echo " <a href=\"products_list.php?page={$i}\">{$i}</a> "; 
			}
		}
        
		if($pagination->has_next_page()) { 
			echo " <a href=\"products_list.php?page=";
			echo $pagination->next_page();
			echo "\">Next &raquo;</a> "; 
    }
		
	}

?>
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
             <div class="admin_about">
             
             	<div class="title"><span class="title_icon"><img src="../images/bullet6.gif" alt="" title="" /></span>Products</div> 
                
                <ul class="list">
                <li><a href="find_product.php">Find Product</a></li>
                <li><a href="insert_product.php">Insert Product</a></li>    
                <li><a href="products_list.php">All Products</a></li>                                       
                </ul>
             </div> 
             
        <div class="clear"></div>
        </div><!--end of right content-->
        
<?php include_layout_template("admin_footer.php");?>

