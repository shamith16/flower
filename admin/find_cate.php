<?php require_once("..".DIRECTORY_SEPARATOR."includes".DIRECTORY_SEPARATOR."initialize.php");

if($session->is_logged_in()){
    if(User::access_b_end($session->user_id)){redirect_to("login.php");}
    }
elseif(!$session->is_logged_in()){
        redirect_to("login.php");
    }
$me =  User::get_username($session->user_id);

$message = "Enter Category ID or Name to Find Data.";
$found_cate = null;

// Remember to give your form's submit tag a name="submit" attribute!
if (isset($_POST['submit'])) { // Form has been submitted.
  $find = trim($_POST['find']);
  
  // Check database to see if username/password exist.
	$found_cate = Category::find_by_id_name($find);
  if (!$found_cate){
    // username/password combo was not found in the database
    $message = "Category is not found in Database.";
  }
  
} else { // Form has not been submitted.
  $find = "";
}
	

include_layout_template("admin_header.php");
?>
<div class="admin_left_content">
        	
        <div class="title"><span class="title_icon"><img src="../images/bullet1.gif" alt="" title="" /></span>Find Category</div>
        <div class="feat_prod_box"></div>
        <div class="find_user_form">
        <form action="find_cate.php" method="POST" >
        <input type="text" name="find" id="find" maxlength="55"/>
        <input type="submit" id="submit" name="submit" value="" class="find_user_btn"/>
        </form>
        </div>
        <?php if(!$found_cate){echo "<p>".output_message($message)."</p><br/>";} ?>
        <?php
        if($found_cate){
           echo "<table align=\"center\" style=\"font-size: 11px;\" >";
              echo "<tr style=\"color: #6CAB52;\">";
              echo "<th>&nbsp;</th>";
              echo "<th >ID</th>";
              echo "<th>Name</th>";
              echo" <th>Subcategory</th>";
		      echo "<th>&nbsp;</th>";
              echo "<th>&nbsp;</th>";
            echo "</tr>";
        	echo "<tr align=\"center\">";
              echo" <td ><br /><img src=\"../images/category.png\" width=\"45\" height=\"50\"/></td>";
              echo "<td width=\"70px\">$found_cate->id</td>";
              echo "<td width=\"70px\">$found_cate->category_name</td>";
              echo "<td width=\"70px\">$found_cate->subcategory</td>";
              echo "<td width=\"30px\"><a href=\"delete_cate.php?id=$found_cate->id\">Delete</a></td>";
              echo "<td width=\"40px\"><a href=\"update_cate.php?id=$found_cate->id\">Update</a></td>";
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

