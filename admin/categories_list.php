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
	$total_count = Category::count_all();
	

	// Find all photos
	// use pagination instead
	//$photos = Photograph::find_all();
	
	$pagination = new Pagination($page, $per_page, $total_count);
	
	// Instead of finding all records, just find the records 
	// for this page
	$sql = "SELECT * FROM category ";
    $sql .= "ORDER BY id ASC ";
	$sql .= "LIMIT {$per_page} ";
	$sql .= "OFFSET {$pagination->offset()} ";
    
	$categories = Category::find_by_sql($sql);
	
	// Need to add ?page=$page to all links we want to 
	// maintain the current page (or store $page in $session)
	

include_layout_template("admin_header.php");
?>
<div class="admin_left_content">
        	
        <div class="title"><span class="title_icon"><img src="../images/bullet1.gif" alt="" title="" /></span>Categories List</div>
        <div class="feat_prod_box"></div>
        <?php echo "<p>".output_message($message)."</p><br/>"; ?>
              <table align="center" style="font-size: 11px;" >
              <tr style="color: #6CAB52;">
              <th>&nbsp;</th>
              <th >ID</th>
              <th>Name</th>
              <th>Subcategory</th>
		      <th>&nbsp;</th>
              <th>&nbsp;</th>
            </tr>
        <?php foreach($categories as $cate):?>
        	<tr align="center">
              <td ><br /><img src="../images/category.png" width="45" height="50" /></td>
              <td width="70px"><?php echo $cate->id; ?> </td>
              <td width="70px"><?php echo $cate->category_name; ?></td>
              <td width="70px"><?php echo $cate->subcategory; ?></td>
              <td width="70px"><a href="delete_cate.php?id=<?php echo $cate->id; ?>">Delete</a></td>
              <td width="70px"><a href="update_cate.php?id=<?php echo $cate->id; ?>">Update</a></td>
            </tr>
         <?php endforeach;?>  
           </table>            
            	
    <div class="clear"></div>
    <div class="feat_prod_box"></div>
<div class="admin_pagination">   
<?php
	if($pagination->total_pages() > 1) {
		
		if($pagination->has_previous_page()) { 
    	echo "<a href=\"categories_list.php?page=";
      echo $pagination->previous_page();
      echo "\">&laquo; Previous</a> "; 
    }
        for($i=1; $i <= $pagination->total_pages(); $i++) {
			if($i == $page) {
				echo " <span class=\"current\">{$i}</span> ";
			} else {
				echo " <a href=\"categories_list.php?page={$i}\">{$i}</a> "; 
			}
		}
        
		if($pagination->has_next_page()) { 
			echo " <a href=\"categories_list.php?page=";
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
             
             	<div class="title"><span class="title_icon"><img src="../images/bullet6.gif" alt="" title="" /></span>Categories</div> 
                
                <ul class="list">
                <li><a href="find_cate.php">Find Category</a></li>
                <li><a href="insert_cate.php">Insert Category</a></li> 
                <li><a href="categories_list.php">All Categories</a></li>                                            
                </ul>
             </div> 
             
        <div class="clear"></div>
        </div><!--end of right content-->
        
<?php include_layout_template("admin_footer.php");?>

