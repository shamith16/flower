<?php require_once("..".DIRECTORY_SEPARATOR."includes".DIRECTORY_SEPARATOR."initialize.php");

if($session->is_logged_in()){
    if(User::access_b_end($session->user_id)){redirect_to("login.php");}
    }
elseif(!$session->is_logged_in()){
        redirect_to("login.php");
    }
$me =  User::get_username($session->user_id);

$message = "Enter info for updating user.";
  
  if(empty($_POST['up'])) {
  	$session->message("No User ID was provided.");
    redirect_to('users_list.php');
  }

  $user = User::find_by_id($_POST['up']);
  if(!$user) {
    $session->message("The User could not be found.");
    redirect_to('users_list.php');
  }
  
    //user updation.
    if (isset($_POST['submit'])) { 
      if(!empty($_POST['id']) && !empty($_POST['username']) && !empty($_POST['password'])){
        $username_exist= User::find_by_id_username($_POST['username']);
        $id_exists=$username_exist->id;
                if(!$username_exist && $id_exists!=$_POST['id'] && strlen($_POST['password']) >= 5 ){
                    $new_user = new User();
                    $new_user->id=trim($_POST['id']);
                    $new_user->user_type=trim($_POST['u_type']);
                    $new_user->username=trim($_POST['username']);
                    $new_user->password=User::do_it(trim($_POST['password']));
                    $new_user->first_name=trim($_POST['first_name']);
                    $new_user->last_name=trim($_POST['last_name']); 
                    $new_user->email=trim($_POST['email']);
                    $new_user->address=trim($_POST['address']); 
                    if($new_user && $new_user->save()) {
                        $session->message( "The ID $user->id is successfully Updated.");
                        redirect_to("users_list.php");	
                    } else {
	                   $session->message ("There was no change to the ".$user->username.".");
                        redirect_to("users_list.php");
                    }
                }else{
                    $session->message ("{$_POST['username']} already exists or Password (5).");
                    redirect_to("users_list.php");
                }
      }else {
          $message="Username and Password must be provided.";
      }

  }else { // Form has not been submitted.
        $id="";
        $username="";
        $password="";
        $first_name="";
        $last_name="";
}
	

include_layout_template("admin_header.php");
?>
<div class="admin_left_content">
        	
        <div class="title"><span class="title_icon"><img src="../images/bullet1.gif" alt="" title="" /></span>Update User</div>
        <div class="feat_prod_box"></div>
        <div class="feat_prod_box">
         <div class="admin_forms" >
         <?php
         if(!output_message($message)){
                echo "<div class=\"form_subtitle\" style=\"font-size:12px;\" > Fill All Fields </div>";
            }else{
                echo "<div class=\"form_subtitle\" style=\"font-size:12px;\" >".output_message($message)."</div>";
            }
         ?>
         <form action="update_user.php" method="post">
           <table style="font-size: 12px; font-weight: bold;">
           <input type="hidden" name="id" maxlength="11" value="<?php echo $user->id; ?>" />
           <input type="hidden" name="up" value="<?php echo $user->id; ?>" />
            <tr>
                <td><a>Username:</a></td>
                <td><input type="text" name="username" maxlength="45" value="<?php echo $user->username; ?>"/></td>
            </tr>
            <tr>
                <td><a>Old Password:</a></td>
                <td><input type="text" disabled="true" maxlength="35" value="<?php echo User::undo_it($user->password);?>" /></td>
            </tr>
           
            <tr>
                <td><a>New Password:</a></td>
                <td><input type="password" name="password" maxlength="16" value="<?php echo  User::undo_it($user->password);?>" /></td>
            </tr>
            <tr>
                <td><a>Email ID:</a></td>
                <td><input type="email" name="email"  maxlength="240" value="<?php echo $user->email;  ?>" /></td>
            </tr>
            <tr>
            <?php 
                if(User::access_level($session->user_id))
                {
                    echo "<input type=\"hidden\" name=\"u_type\" maxlength=\"45\" value=\"customer\" />";
                }else{
                    echo "<td><a>Type :<a></td>";
                    echo "<td><select name=\"u_type\">";
                    if($user->user_type == 'administrator'){
                        echo "<option selected=\"true\" id=\"administrator\">administrator</option>";
                        echo "<option id=\"employee\">employee</option>";
                        echo "<option id=\"customer\">customer</option>";
                    }elseif($user->user_type == 'employee'){
                        echo "<option id=\"administrator\">administrator</option>";
                        echo "<option selected=\"true\" id=\"employee\">employee</option>";
                        echo "<option id=\"customer\">customer</option>";
                    }else{
                        echo "<option id=\"administrator\">administrator</option>";
                        echo "<option id=\"employee\">employee</option>";
                        echo "<option selected=\"true\" id=\"customer\">customer</option>";
                    }
                    echo "</select>";
                    echo "</td>";
                }         
            ?>
            </tr>
            <tr>
                <td><a>First Name:</a></td>
                <td><input type="text" maxlength="25" size="25" name="first_name" value="<?php echo $user->first_name;  ?>" /></td>
            </tr>
            <tr>
                <td><a>Last Name:</a></td>
                <td><input type="text" maxlength="25"  size="25" name="last_name" value="<?php echo $user->last_name;  ?>" /></td>
            </tr>
            <tr>
                <td><a>Address:</a></td>
                <td><textarea name="address" cols="32" rows="8"><?php echo $user->address;  ?></textarea></td>
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

