<?php require_once("..".DIRECTORY_SEPARATOR."includes".DIRECTORY_SEPARATOR."initialize.php");

if($session->is_logged_in()){
    if(User::access_b_end($session->user_id)){redirect_to("login.php");}
    }
elseif(!$session->is_logged_in()){
        redirect_to("login.php");
    }
$me =  User::get_username($session->user_id);	
    
    //comments area
	if(empty($_GET['id'])) {
	  $session->message("No photograph ID was provided.");
	  redirect_to('products_list.php');
	}
	
    $photo = Photograph::find_by_id($_GET['id']);
    if(!$photo) {
    $session->message("The photo could not be located.");
    redirect_to('products_list.php');
    }

	$all_comments = $photo->comments();
    
   	// 1. the current page number ($current_page)
	$page = !empty($_GET['page']) ? (int)$_GET['page'] : 1;

	// 2. records per page ($per_page)
	$per_page = 15;

	// 3. total record count ($total_count)
	$total_count = count($all_comments);
	

	// Find all photos
	// use pagination instead
	//$photos = Photograph::find_all();
	
	$pagination = new Pagination($page, $per_page, $total_count);
	
	// Instead of finding all records, just find the records 
	// for this page
	$sql = "SELECT * FROM comments ";
    $sql .= "WHERE photograph_id = {$_GET['id']} ";
	$sql .= "LIMIT {$per_page} ";
	$sql .= "OFFSET {$pagination->offset()} ";
    
	$comments = comment::find_by_sql($sql);
	
	// Need to add ?page=$page to all links we want to 
	// maintain the current page (or store $page in $session)
	

include_layout_template("admin_header.php");
?>

<div class="admin_left_content">
        	
        <div class="title"><span class="title_icon"><img src="../images/bullet1.gif" alt="" title="" /></span>Comments List</div>
        <div class="feat_prod_box"></div>
        
        <a href="products_list.php">Back</a><br /><br />
        
        <br />
        <div style="padding-left: 30px;">
        <?php foreach($comments as $comment): ?>
            <div align="left" style="padding-bottom: 15px; "><img src="../images/com.png" width="50" height="50" align="left" /></div>
            <div style="margin-bottom: 5em;" >
            <div style="padding-left: 55px;">
            <?php echo "<b><a>".htmlentities($comment->author); ?></a></b> wrote:
	        </div>
	        <div style="font-size: 0.8em; padding-left: 55px;">
	        <?php echo datetime_to_text($comment->created); ?>
	        </div>
            <div style="margin-top: 1em;">
            <?php echo strip_tags($comment->body, '<strong><em><p>'); ?>
			</div>
			<div style="font-size: 0.8em; ">
			<a href="delete_comment.php?id=<?php echo $comment->id; ?>">Delete Comment</a>
			</div>
            </div>
            <?php endforeach; ?>
            <?php if(empty($comments)) { echo "No Comments."; } ?>
       </div>
            	
    <div class="clear"></div>
    <div class="feat_prod_box"></div>
<div class="admin_pagination">   
<?php
	if($pagination->total_pages() > 1) {
		
		if($pagination->has_previous_page()) { 
    	echo "<a href=\"comments.php?page=";
      echo $pagination->previous_page();
      echo "{$_GET['id']}\">&laquo; Previous</a> "; 
    }
        for($i=1; $i <= $pagination->total_pages(); $i++) {
			if($i == $page) {
				echo " <span class=\"current\">{$i}</span> ";
			} else {
				echo " <a href=\"comments.php?page={$i}&&id={$_GET['id']}\">{$i}</a> "; 
			}
		}
        
		if($pagination->has_next_page()) { 
			echo " <a href=\"comments.php?page=";
			echo $pagination->next_page();
			echo "{$_GET['id']}\">Next &raquo;</a> "; 
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
             
        <div class="clear"></div>
        </div><!--end of right content-->
        
<?php include_layout_template("admin_footer.php");?>

