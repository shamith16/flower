<?php
require_once("includes".DIRECTORY_SEPARATOR."initialize.php");
if($session->is_logged_in()) {
  redirect_to("index.php");
}
$message = "Enter your information.";
	
    if(isset($_POST['submit'])) { 
        if(!empty($_POST['username']) && !empty($_POST['password'])){
            $username_exist= User::find_by_id_username($_POST['username']);
                if(!$username_exist){
                    $new_user = new User();
                    $new_user->user_type=trim($_POST['u_type']);
                    $new_user->username=trim($_POST['username']);
                    $new_user->password=User::do_it(trim($_POST['password']));
                    $new_user->email=trim($_POST['email']);
                    $new_user->first_name=trim($_POST['first_name']);
                    $new_user->last_name=trim($_POST['last_name']);
                    $new_user->address=trim($_POST['address']);
      
	               if($new_user && $new_user->save()) {
  
                        $session->message("The {$new_user->username} is successfully Register.");
	                       redirect_to("login.php");
		          } else {
	               $message = "There was an error that prevented the User from being saved.";
		          }
                }else{
                   $message = "{$_POST['username']} already exists.";
                }
        }else {
             $message="Username must be provided.";
        }
  
    }elseif(isset($_POST['submit'])) {
		$username = "";
        $password = "";
        $message = "Error : CAPTCHA & Fleids";
	} else { // Form has not been submitted.
        $username = "";
        $password = "";
    }

include_layout_template("header.php");
?>

<div class="left_content">
        	 
<div class="title"><span class="title_icon"><img src="images/bullet5.gif" alt="" title="" /></span>Register</div>
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
         <form action="register.php" method="post">
         <div>
           <table style="font-size: 12px; font-weight: bold;">
           <input type="hidden" name="u_type" maxlength="45" value="customer" />
            <tr>
                <td><a>Username:</a></td>
                <td><input type="text" name="username" maxlength="45" value="" /></td>
            </tr>
            <tr>
                <td><a>Password:</a></td>
                <td><input type="password" name="password" maxlength="35" value="" /></td>
            </tr>
            <tr>
                <td><a>Email ID:</a></td>
                <td><input type="email" name="email"  maxlength="240" value="" /></td>
            </tr>
            <tr>
                <td><a>First Name:</a></td>
                <td><input type="text" maxlength="25" size="25" name="first_name" value="" /></td>
            </tr>
            <tr>
                <td><a>Last Name:</a></td>
                <td><input type="text" maxlength="25"  size="25" name="last_name" value="" /></td>
            </tr>
            <tr>
                <td><a>Address:</a></td>
                <td><textarea name="address" cols="29" rows="8"></textarea></td>
            </tr>
          </table>
          </div>
          <div class="form_row">
                <input type="submit" name="submit" value="Register" class="register"  />
                <input style="margin-right: 5px;" type="reset" name="cancel" id="cancel" class="register" value="Cancel" />
                </div> 
        </form>
        </div>
  <div class="clear"></div>
</div>        
<div class="clear"></div>
</div>
        
<?php include_layout_template("footer.php");?>

