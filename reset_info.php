<?php
require_once("includes".DIRECTORY_SEPARATOR."initialize.php");
if(!$session->is_logged_in()) {
  redirect_to("login.php");
}

$message = "Reset your information.";

if(empty($_GET['id'])) {
  	$session->message("No User ID was provided.");
    redirect_to('index.php');
  }

  $user = User::find_by_id($_GET['id']);
  if(!$user) {
    $session->message("The User could not be found.");
    redirect_to('index.php');
  }
  
    //user updation.
	
    if(isset($_POST['submit'])) { 
      if(!empty($_POST['id']) && !empty($_POST['username']) && !empty($_POST['password'])){
        $username_exist= User::find_by_id_username($_POST['username']);
        $id_exists=$username_exist->id;
                if(!$username_exist && $id_exists!=$_POST['id'] && strlen($_POST['password']) >= 5 ){
                    $new_user = new User();
                    $new_user->id=trim($_POST['id']);
                    $new_user->user_type=trim($_POST['u_type']);
                    $new_user->username=trim($_POST['username']);
                    $new_user->password=User::do_it(trim($_POST['password']));
                    $new_user->email=trim($_POST['email']);
                    $new_user->first_name=trim($_POST['first_name']);
                    $new_user->last_name=trim($_POST['last_name']); 
                    $new_user->address=trim($_POST['address']);
                    if($new_user && $new_user->save()) {
                        $session->message( "The ID {$user->id} is successfully Updated.");
                        redirect_to("reset_info.php?id={$user->id}");	
                    } else {
	                   $session->message ("There was no change to the ".$user->username.".");
                        redirect_to("reset_info.php?id={$user->id}");
                    }
                }else{
                    $session->message ("{$_POST['username']} already exists or Password (5).");
                    redirect_to("reset_info.php?id={$user->id}");
                }
      }else {
          $message="Username and Password must be provided.";
      }

  }elseif(isset($_POST['submit'])) {
		$id="";
        $username="";
        $password="";
        $first_name="";
        $last_name="";
        $message = "Error : CAPTCHA & Fleids";
  }else { // Form has not been submitted.
        $id="";
        $username="";
        $password="";
        $first_name="";
        $last_name="";
  }

include_layout_template("header.php");
?>

<div class="left_content">
        	 
<div class="title"><span class="title_icon"><img src="images/bullet5.gif" alt="" title="" /></span><?php echo User::get_username($session->user_id)?></div>
<div class="feat_prod_box"></div>
<div class="feat_prod_box">
  <div class="contact_form" >
         <?php
         if(!output_message($message)){
                echo "<div class=\"form_subtitle\" style=\"font-size:12px;\" > Fill All Fields </div>";
            }else{
                echo "<div class=\"form_subtitle\" style=\"font-size:12px;\" >".output_message($message)."</div>";
            }
         ?>
         <form action="reset_info.php?id=<?php echo $user->id; ?>" method="post">
          <div> 
           <table style="font-size: 12px; font-weight: bold;">
           <input type="hidden" name="id" maxlength="11" value="<?php echo $user->id; ?>" />
           <input type="hidden" name="u_type" maxlength="45" value="<?php echo $user->user_type; ?>" />
            <tr>
                <td><a>Username:</a></td>
                <td><input type="text" name="username" readonly="true" maxlength="45" value="<?php echo $user->username; ?>"/></td>
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
                <td><input type="email" name="email"  maxlength="240" value="<?php echo $user->email; ?>" /></td>
            </tr>
            <tr>
                <td><a>First Name:</a></td>
                <td><input type="text" maxlength="25" size="25" name="first_name" value="<?php echo $user->first_name; ?>" /></td>
            </tr>
            <tr>
                <td><a>Last Name:</a></td>
                <td><input type="text" maxlength="25"  size="25" name="last_name" value="<?php echo $user->last_name; ?>" /></td>
            </tr>
            <tr>
                <td><a>Address:</a></td>
                <td><textarea name="address" cols="32" rows="8"><?php echo $user->address; ?></textarea></td>
            </tr>
            
          </table>
        </div>
        <div>
                <td>&nbsp;</td>
                <td><input type="submit" name="submit" value="Update" class="register"  /></td>
        </div>
        </form>
        </div>
  <div class="clear"></div>
</div>        
<div class="clear"></div>
</div>
        
<?php include_layout_template("footer.php");?>

