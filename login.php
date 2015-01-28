<?php
require_once("includes".DIRECTORY_SEPARATOR."initialize.php");
if($session->is_logged_in()) {
  redirect_to("index.php");
}

// Remember to give your form's submit tag a name="submit" attribute!
if (isset($_POST['submit'])) { // Form has been submitted.
  $username = trim($_POST['username']);
  $password = User::do_it(trim($_POST['password']));
  
  // Check database to see if username/password exist.
	$found_user = User::authenticate($username, $password);
	
  if ($found_user && $found_user->user_type == 'customer') {
    $session->login($found_user);
		clog_action('Login', "{$found_user->username} logged in.");
    redirect_to("index.php");
  } elseif ($found_user && $found_user->user_type != 'customer') {
    $session->login($found_user);
		ulog_action('Login', "{$found_user->username} logged in.");
    redirect_to("index.php");
  } else {
    // username/password combo was not found in the database
    $message = "Name / Password combination incorrect.";
  }
  
} else { // Form has not been submitted.
  $username = "";
  $password = "";
}

include_layout_template("header.php");
?>

<div class="left_content">
        	 
<div class="title"><span class="title_icon"><img src="images/bullet5.gif" alt="" title="" /></span>Login</div>
<div class="feat_prod_box"></div>
<div class="feat_prod_box">
  <div class="contact_form">
  <?php
         if(!output_message($message)){
                echo "<div class=\"form_subtitle\" style=\"font-size:12px;\" > Fill Fields to Login </div>";
            }else{
                echo "<div class=\"form_subtitle\" style=\"font-size:12px;\" >".output_message($message)."</div>";
            }
  ?>
              <form action="login.php" method="post" >          
                    <div class="form_row">
                    <label class="contact"><strong>Username:</strong></label>
                    <input type="text"  id="username" name="username" class="contact_input" />
                    </div>  

                    <div class="form_row">
                    <label class="contact"><strong>Password:</strong></label>
                    <input type="password" id="password" name="password" class="contact_input" />
                    </div>                     
                    
                    <div class="form_row">
                    <input type="submit" name="submit" id="submit" class="register" value="Login" />
                    <input style="margin-right: 5px;" type="reset" name="cancel" id="cancel" class="register" value="Cancel" />
                    </div>   
                    
              </form>   

  </div>
  <div class="clear"></div>
</div>        
<div class="clear"></div>
</div>
        
<?php include_layout_template("footer.php");?>

