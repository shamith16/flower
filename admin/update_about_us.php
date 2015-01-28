<?php require_once("..".DIRECTORY_SEPARATOR."includes".DIRECTORY_SEPARATOR."initialize.php");

if($session->is_logged_in()){
    if(User::access_b_end($session->user_id)){redirect_to("login.php");}
    }
elseif(!$session->is_logged_in()){
        redirect_to("login.php");
    }
$me =  User::get_username($session->user_id);

$message = "Update Description.";

if(empty($_GET['id'])) {
  	$session->message("No ID was provided.");
    redirect_to('about_us.php');
  }

  $about = About_us::find_by_id($_GET['id']);
  if(!$about) {
    $session->message("The ID could not be found.");
    redirect_to('about_us.php');
  }

      if (isset($_POST['submit'])) { 
        if(!empty($_POST['id'])){
                    $new_about = new About_us();
                    $new_about->id=trim($_POST['id']);
                    $new_about->about_del=trim($_POST['del']);
                    $new_about->updated=strftime("%Y-%m-%d %H:%M:%S",time());
      
	               if($new_about && $new_about->save()) {
  
                        $message = "The {$new_about->id} is successfully Updated.";
	                       redirect_to("about_us.php");
		          } else {
	               $message = "There was an error that prevented the ID from being updated.";
		          }
        }else {
             $message="Error : ID must be Provided.";
        }
}else { // Form has not been submitted.
        $id="";
        $name="";
        $description="";
}
	

include_layout_template("admin_header.php");
?>
<div class="admin_left_content">
        	
        <div class="title"><span class="title_icon"><img src="../images/bullet1.gif" alt="" title="" /></span>About us</div>
        <div class="feat_prod_box"></div>
        <div class="feat_prod_box">
         <div class="contact_form" >
         <?php
         if(!output_message($message)){
                echo "<div class=\"form_subtitle\" style=\"font-size:12px;\" > Update Description. </div>";
            }else{
                echo "<div class=\"form_subtitle\" style=\"font-size:12px;\" >".output_message($message)."</div>";
            }
         ?>
         <form action="update_about_us.php?id=<?php echo $about->id;?>" method="post">
           <table style="font-size: 12px; font-weight: bold;">
            <input type="hidden" name="id" value="<?php echo $about->id; ?>" />
            <tr>
                <td><a>Description: </a></td>
                <td><textarea cols="30" rows="20" name="del" ><?php echo $about->about_del; ?></textarea></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td><input type="submit" name="submit" value="Update" class="register"  /></td>
            </tr>
          </table>
        </form>
        </div>
  <div class="clear"></div>
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
             
             	<div class="title"><span class="title_icon"><img src="../images/bullet6.gif" alt="" title="" /></span>Catalogs</div> 
                
                <ul class="list">
                <li><a href="find_cata.php">Find Catalog</a></li>
                <li><a href="insert_cata.php">Insert Catalog</a></li> 
                <li><a href="catalogs_list.php">All Catalogs</a></li>    
                <li><a href="catalogs_pro_list.php">Add Products</a></li>                                     
                </ul>
             </div> 
             
        <div class="clear"></div>
        </div><!--end of right content-->
        
<?php include_layout_template("admin_footer.php");?>

