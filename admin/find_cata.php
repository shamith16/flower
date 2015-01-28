<?php require_once("..".DIRECTORY_SEPARATOR."includes".DIRECTORY_SEPARATOR."initialize.php");

if($session->is_logged_in()){
    if(User::access_b_end($session->user_id)){redirect_to("login.php");}
    }
elseif(!$session->is_logged_in()){
        redirect_to("login.php");
    }
$me =  User::get_username($session->user_id);

$message = "Enter Catalog ID or Name to Find Data.";
$found_cata = null;

// Remember to give your form's submit tag a name="submit" attribute!
if (isset($_POST['submit'])) { // Form has been submitted.
  $find = trim($_POST['find']);
  
  // Check database to see if username/password exist.
	$found_cata = Catalog::find_by_id_name($find);
  if (!$found_cata){
    // username/password combo was not found in the database
    $message = "Catalog is not found in Database.";
  }
  
} else { // Form has not been submitted.
  $find = "";
}
	

include_layout_template("admin_header.php");
?>
<div class="admin_left_content">
        	
        <div class="title"><span class="title_icon"><img src="../images/bullet1.gif" alt="" title="" /></span>Find Catalog</div>
        <div class="feat_prod_box"></div>
        <div class="find_user_form">
        <form action="find_cata.php" method="POST" >
        <input type="text" name="find" id="find" maxlength="55"/>
        <input type="submit" id="submit" name="submit" value="" class="find_user_btn"/>
        </form>
        </div>
        <?php if(!$found_cata){echo "<p>".output_message($message)."</p><br/>";} ?>
        <?php
        if($found_cata){
           echo "<table align=\"center\" style=\"font-size: 11px;\" >";
              echo "<tr style=\"color: #6CAB52;\">";
              echo "<th>&nbsp;</th>";
              echo "<th >ID</th>";
              echo "<th>Name</th>";
              echo "<th>Description</th>";
		      echo "<th>&nbsp;</th>";
              echo "<th>&nbsp;</th>";
            echo "</tr>";
        	echo "<tr align=\"center\">";
              echo" <td ><br /><img src=\"../images/catalog.png\" width=\"45\" height=\"50\"/></td>";
              echo "<td width=\"70px\">$found_cata->id</td>";
              echo "<td width=\"70px\">$found_cata->catalog_name</td>";
              echo "<td width=\"200px\">$found_cata->catalog_des</td>";
              echo "<td width=\"30px\"><a href=\"delete_cata.php?id=$found_cata->id\">Delete</a></td>";
              echo "<td width=\"40px\"><a href=\"update_cata.php?id=$found_cata->id\">Update</a></td>";
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

