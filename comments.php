<?php require_once("includes".DIRECTORY_SEPARATOR."initialize.php");
 
    //id for comments
	if(empty($_GET['id'])) {
	  $session->message("No photograph ID was provided.");
	  redirect_to('details.php');
	}
	
    $photo = Photograph::find_by_id($_GET['id']);
    if(!$photo) {
    $session->message("The photo could not be located.");
    redirect_to('details.php');
    }

	$all_comments = $photo->comments();
    
   	// 1. the current page number ($current_page)
	$page = !empty($_GET['page']) ? (int)$_GET['page'] : 1;

	// 2. records per page ($per_page)
	$per_page = 2;

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
	
    //comment submission.
	if(isset($_POST['submit'])) {
	  $author = trim($_POST['author']);
      $subject = trim("Comment : ".$_POST['subject']);
      $email = trim($_POST['email']);
	  $body = trim($_POST['body']);
	
	  $new_comment = Comment::make($photo->id, $author, $subject, $email , $body);
	  if($new_comment && $new_comment->save()) {
			// comment saved
			// No message needed; seeing the comment is proof enough.
			
			// Send email
			if($new_comment->try_to_send_notification() && $new_comment->make_thanks()){
                $session->message("The comment is successfully submitted.");
            }
            else{
                $session->message("{Error : that prevented the comment from being saved.");
            }
			
	    // Important!  You could just let the page render from here. 
	    // But then if the page is reloaded, the form will try 
			// to resubmit the comment. So redirect instead:
	    redirect_to("comments.php?id={$photo->id}");
	
		} else {
			// Failed
	        $message = "Error : Fill All Fields";
		}
	} elseif(isset($_POST['submit'])) {
		$author = "";
        $subject = "";
        $email="";
		$body = "";
        $message = "Error : CAPTCHA & Fleids";
	}else{
	    $author = "";
        $subject = "";
        $email="";
		$body = "";
	}
include_layout_template("header.php");
?>

<div class="left_content">
        	
        <div class="title"><span class="title_icon"><img src="images/bullet1.gif" alt="" title="" /></span>Comments List</div>
        <div class="feat_prod_box"></div>
        
		<?php if(isset($_GET['bk'])){ ?>
        <a href="details.php?page=<?php echo $_GET['bk']?>">Back</a><br /><br />
		<?php } ?>
        
        <br />
        <div style="padding-left: 30px; ">
        <img src="<?php echo $photo->image_path(); ?>" class="pics_boarder" width="50" style="margin-bottom: 20px;"/>
        
        <?php foreach($comments as $comment): ?>
            <div align="left" style="margin-top: 3em;"><img src="images/com.png" width="50" height="50" align="left" /></div>
            <div style="margin-top: 4em; margin-bottom: 2em;" >
            <div style="padding-left: 55px;">
            <?php echo "<b><a>".htmlentities($comment->author); ?></a></b> wrote:
	        </div>
	        <div style="font-size: 0.8em; padding-left: 55px;">
	        <?php echo datetime_to_text($comment->created); ?>
	        </div>
            <div style="margin-top: 1em;">
            <?php echo strip_tags($comment->body, '<strong><em><p>'); ?>
			</div>
			
            </div>
            <?php endforeach; ?>
            <?php if(empty($comments)) { echo "<div style=\"margin-top: 3em; margin-left: 3em;\">No Comments...</div>"; } ?>
       </div>
            	
    <div class="clear"></div>
    
<div class="pagination">   
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
<div class="feat_prod_box"></div>
<div class="title"><span class="title_icon"><img src="images/bullet2.gif" alt="" title="" /></span>New Comment</div>
<div class="feat_prod_box">
  <div class="contact_form">
  <?php
         if(!output_message($message) ){
                echo "<div class=\"form_subtitle\" style=\"font-size:12px;\" > Fill All Fields </div>";
            }else{
                echo "<div class=\"form_subtitle\" style=\"font-size:12px;\" >".output_message($message)."</div>";
            }
  ?>
  <form action="comments.php?id=<?php echo $photo->id; ?>" method="post">
    <div>
    <table style="font-size: 12px; font-weight: bold;">
      <tr>
        <td><a>Name:</a></td>
        <td><input type="text" name="author" value="" /></td>
      </tr>
      <tr>
        <td><a>Subject:</a></td>
        <td><input type="text" maxlength="30"size="30" name="subject" value="" /></td>
      </tr>
      <tr>
        <td><a>Email ID:</a></td>
        <td><input type="email" maxlength="50"  size="35" name="email" value="" /></td>
      </tr>
      <tr>
        <td><a>Comment:</a></td>
        <td><textarea name="body" cols="32" rows="8"></textarea></td>
      </tr>
    </table>
    </div>
    <div class="form_row">
        <input type="submit" name="submit" id="submit" class="register" value="Post" />
        <input style="margin-right: 5px;" type="reset" name="cancel" id="cancel" class="register" value="Cancel" />
    </div>   
  </form>
  </div>
  <div class="clear"></div>
</div>        
<div class="clear"></div>
</div>
        
<?php include_layout_template("footer.php");?>

