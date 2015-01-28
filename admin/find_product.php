<?php require_once("..".DIRECTORY_SEPARATOR."includes".DIRECTORY_SEPARATOR."initialize.php");

if($session->is_logged_in()){
    if(User::access_b_end($session->user_id)){redirect_to("login.php");}
    }
elseif(!$session->is_logged_in()){
        redirect_to("login.php");
    }
$me =  User::get_username($session->user_id);

$message = "Enter Product ID or Product Name to Find Data.";
$found_pro = null;

// Remember to give your form's submit tag a name="submit" attribute!
if (isset($_POST['submit'])) { // Form has been submitted.
  $find = trim($_POST['find']);
  
  // Check database to see if username/password exist.
	$found_pro = Photograph::find_by_id_caption($find);
	
  if (!$found_pro){
    // username/password combo was not found in the database
    $message = "Product is not found in Database.";
  }
  
} else { // Form has not been submitted.
  $find = "";
}
	

include_layout_template("admin_header.php");
?>
<div class="admin_left_content">
        	
        <div class="title"><span class="title_icon"><img src="../images/bullet1.gif" alt="" title="" /></span>Find Product</div>
        <div class="feat_prod_box"></div>
        <div class="find_user_form">
        <form action="find_product.php" method="POST" >
        <input type="text" name="find" id="find" maxlength="55"/>
        <input type="submit" id="submit" name="submit" value="" class="find_user_btn"/>
        </form>
        </div>
        <?php if(!$found_pro){echo "<p>".output_message($message)."</p><br/>";} ?>
        <?php
        if($found_pro){
           echo "<table align=\"center\" style=\"font-size: 11px;\" >";
              echo "<tr style=\"color: #6CAB52;\">";
              echo "<th>ID</th>";
              echo "<th>Name</th>";
              echo "<th>Description</th>";
              echo "<th>Category</th>";
              echo "<th>Family</th>";
              echo "<th>&nbsp;</th>";
              echo "<th>Price</th>";
		      echo "<th>&nbsp;</th>";
            echo "</tr>";
        	echo "<tr align=\"center\">";
              echo "<td width=\"10px\"><a>{$found_pro->id}.</a></td>";
              echo "<td><a href=../".$found_pro->image_path()." rel=\"lightbox\">{$found_pro->caption}</a></td>";
              echo "<td width=\"300px\" align=\"left\">".strip_tags($found_pro->description,"<ul><li><p><br><b><a>")."</td>";
              echo "<td>{$found_pro->category_id}</td>";
              echo "<td width=\"15px\">{$found_pro->family}</td>";
              echo "<td width=\"15px\"><img src=\"../images/pro_color_frame.png\" width=\"16px\" height=\"15px\" style=\"background-color: #{$found_pro->color}\" /></td>";
              echo "<td>{$found_pro->price} $</td>";
              echo "<td><a href=\"delete_photo.php?id={$found_pro->id}\">Delete</a>";
              echo "<br /><br /><a href=\"update_product.php?id={$found_pro->id}\">Update</a>";
              echo "</td>";
            echo "</tr>";
            echo "</table>";
           }           
          ?>  	
    <div class="clear"></div>
    <div class="feat_prod_box"></div>         
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

