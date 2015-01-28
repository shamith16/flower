<?php require_once("..".DIRECTORY_SEPARATOR."includes".DIRECTORY_SEPARATOR."initialize.php");

if($session->is_logged_in()){
    if(User::access_b_end($session->user_id)){redirect_to("login.php");}
    }
elseif(!$session->is_logged_in()){
        redirect_to("login.php");
    }
$me =  User::get_username($session->user_id);

$message = "Enter User ID or User Name to Find Data.";
$found_user = null;

// Remember to give your form's submit tag a name="submit" attribute!
if (isset($_POST['submit'])) { // Form has been submitted.
  $find = trim($_POST['find']);
  
  // Check database to see if username/password exist.
	$found_user = User::find_by_id_username($find);
	
  if (!$found_user){
    // username/password combo was not found in the database
    $message = "User is not found in Database.";
  }
  
} else { // Form has not been submitted.
  $find = "";
}
	

include_layout_template("admin_header.php");
?>
<div class="admin_left_content">
        	
        <div class="title"><span class="title_icon"><img src="../images/bullet1.gif" alt="" title="" /></span>Find User</div>
        <div class="feat_prod_box"></div>
        <div class="find_user_form">
        <form action="find_user.php" method="POST" >
        <input type="text" name="find" id="find" maxlength="55"/>
        <input type="submit" id="submit" name="submit" value="" class="find_user_btn"/>
        </form>
        </div>
        <?php if(!$found_user){echo "<p>".output_message($message)."</p><br/>";} ?>
        <?php
        if($found_user){
          if(User::access_level($session->user_id)){ 
           echo "<table align=\"center\" style=\"font-size: 11px;\" >";
              echo "<tr style=\"color: #6CAB52;\">";
              echo "<th>&nbsp;</th>";
              echo "<th >ID</th>";
              echo "<th>Username</th>";
              echo "<th>First Name</th>";
              echo" <th>Last Name</th>";
              echo "<th>Fullname</th>";
		      echo "<th>&nbsp;</th>";
              echo "<th>&nbsp;</th>";
            echo "</tr>";
        	echo "<tr align=\"center\">";
              echo" <td ><br /><img src=\"../images/com.png\"  /></td>";
              echo "<td width=\"70px\">$found_user->id</td>";
              echo "<td width=\"70px\">$found_user->username</td>";
              echo "<td width=\"70px\">$found_user->first_name</td>";
              echo "<td width=\"70px\">$found_user->last_name</td>";
              echo "<td width=\"70px\">".$found_user->full_name()."</td>";
              if($found_user->user_type == 'customer' || $found_user->id == $session->user_id){
                echo "<form action=\"update_user.php\" method=\"post\" >";
                echo "<input type=\"hidden\" id=\"up\" name=\"up\" value=\"$found_user->id\"/>";
                echo "<td style=\"font: xx-small;\" width=\"30px\"><input type=\"submit\" name=\"update\" id=\"update\"  value=\"Update\" class=\"register\" /></td></form>";
                echo "<form action=\"delete_user.php\" method=\"post\" >";
                echo "<input type=\"hidden\" id=\"del\" name=\"del\" value=\"$found_user->id\"/>";
                echo "<td style=\"font: xx-small ;\" width=\"40px\"><input type=\"submit\" name=\"delete\" id=\"delete\"  value=\"Delete\" class=\"register\" /></td></form>";
              }
              echo "</td>";
            echo "</tr>";
           echo "</table>";
           }else{
            echo "<table align=\"center\" style=\"font-size: 11px;\" >";
              echo "<tr style=\"color: #6CAB52;\">";
              echo "<th>&nbsp;</th>";
              echo "<th >ID</th>";
              echo "<th>Username</th>";
              echo "<th>First Name</th>";
              echo" <th>Last Name</th>";
              echo "<th>Fullname</th>";
		      echo "<th>&nbsp;</th>";
              echo "<th>&nbsp;</th>";
            echo "</tr>";
        	echo "<tr align=\"center\">";
              echo" <td ><br /><img src=\"../images/com.png\"  /></td>";
              echo "<td width=\"70px\">$found_user->id</td>";
              echo "<td width=\"70px\">$found_user->username</td>";
              echo "<td width=\"70px\">$found_user->first_name</td>";
              echo "<td width=\"70px\">$found_user->last_name</td>";
              echo "<td width=\"70px\">".$found_user->full_name()."</td>";
              
                echo "<form action=\"update_user.php\" method=\"post\" >";
                echo "<input type=\"hidden\" id=\"up\" name=\"up\" value=\"$found_user->id\"/>";
                echo "<td style=\"font: xx-small;\" width=\"30px\"><input type=\"submit\" name=\"update\" id=\"update\"  value=\"Update\" class=\"register\" /></td></form>";
                echo "<form action=\"delete_user.php\" method=\"post\" >";
                echo "<input type=\"hidden\" id=\"del\" name=\"del\" value=\"$found_user->id\"/>";
                echo "<td style=\"font: xx-small ;\" width=\"40px\"><input type=\"submit\" name=\"delete\" id=\"delete\"  value=\"Delete\" class=\"register\" /></td></form>";
              echo "</td>";
            echo "</tr>";
           echo "</table>";
           }
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
             
             	<div class="title"><span class="title_icon"><img src="../images/bullet6.gif" alt="" title="" /></span>Users</div> 
                
                <ul class="list">
                <li><a href="find_user.php">Find User</a></li>
                <li><a href="insert_user.php">Insert User</a></li>    
                <li><a href="users_list.php">All Users</a></li>                                       
                </ul>
             </div> 
             
        <div class="clear"></div>
        </div><!--end of right content-->
        
<?php include_layout_template("admin_footer.php");?>

