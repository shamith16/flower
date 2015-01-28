<?php
require_once("..".DIRECTORY_SEPARATOR."includes".DIRECTORY_SEPARATOR."initialize.php");
if($session->is_logged_in()){
    if(User::access_b_end($session->user_id)){
        // try login again 
        $message = "".User::get_username($session->user_id)." is not allowed.";
    }else{
        redirect_to("index.php");
        
    }
}else{
    if(isset($_POST['Administrator']) || isset($_POST['Employee']) || isset($_POST['cancel']) || isset($_POST['login']) ){
       if(isset($_POST['Administrator'])){
            $accountType=$_POST['Administrator'];
       }elseif(isset($_POST['Employee'])){
            $accountType=$_POST['Employee'];
       }elseif(isset($_POST['login'])){
            $accountType=$_POST['accType'];
       }
    }elseif(isset($_POST['Customer'])){
        redirect_to("../login.php");
    }else{
        redirect_to("main.php");  
    }
}

// Remember to give your form's submit tag a name="submit" attribute!
if (isset($_POST['login'])) { // Form has been submitted.
  $username = trim($_POST['username']);
  $password = User::do_it(trim($_POST['password']));
  
  // Check database to see if username/password exist.
	$found_user = User::authenticate($username, $password);
    
  if ($found_user) {
    $session->login($found_user);
		ulog_action('Login', "{$found_user->username} logged in.");
    redirect_to("index.php");
  } else {
    // username/password combo was not found in the database
    $message = "Username / Password combination incorrect.";
  }
  
} else { // Form has not been submitted.
  $username = "";
  $password = "";
}

?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<title>:: Flower Shop ::</title>
<link rel="stylesheet" type="text/css" href="../css/style.css" />
<link rel="shortcut icon" href="../images/fav.ico" />
<link rel="stylesheet" href="../css/bg.css"  type="text/css" />
</head>
<body>
<div id="wrap">

       <div class="header" >
       		<div class="logo"><a href="index.html"><img src="../images/logo.png" alt="" title="" border="0" /></a></div>     
       </div> 
       <div class="center_login">
       	<div class="left_content">
            <div class="title"><span class="title_icon"><img src="../images/bullet1.gif" alt="" title="" /></span><?php echo "{$accountType} Account"; ?></div>
        
        	<div class="feat_prod_box_details">
            <p class="details">
             Please enter your Username and Password in order to login to administrative area .Where you can manage Users , Products , Catalogs ,Categories and Logs of users.</p>
            <p class="details">If you have some Problem related to Login please inform us through the given contact on the lower side of this page as a link. </p>
            <div class="contact_form" >
                <?php if(!output_message($message)){
                            echo "<div class=\"form_subtitle\" style=\"font-size:11px;\" >Login into your Account</div>";
                        }else{
                            echo "<div class=\"form_subtitle\" style=\"font-size:11px;\" >".output_message($message)."</div>";
                        }?>
                 <form action="login.php" method="post" >  
                    <input type="hidden" name="accType" value="<?php echo $accountType; ?>" />
                            
                    <div class="form_row">
                    <label class="contact"><strong>Username:</strong></label>
                    <input type="text"  id="username" name="username" class="contact_input" />
                    </div>  

                    <div class="form_row">
                    <label class="contact"><strong>Password:</strong></label>
                    <input type="password" id="password" name="password" class="contact_input" />
                    </div>                     

                    
                    <div class="form_row">
                    <input type="submit" name="login" id="login" class="register" value="Login" />
                    <input style="margin-right: 5px;" type="reset" name="cancel" id="cancel" class="register" value="Cancel" />
                    </div>   
                    
              </form>     
                    
              </div>  
            
            </div>	

            
        <div  class="clear"></div>
        </div><!--end of left content-->
        
        

       <div class="clear"></div>
       </div><!--end of center content-->
       
              
       <div class="footer">
       	<div class="left_footer"><img src="../images/footer_logo.gif" alt="" title="" /><br /> <a href="http://www.mfinfo.net76.net/" title="Copyright Year"><img src="../images/des.png" alt="mfahim" width="60" height="15" border="0" title="Desinger Site" /><?php echo strftime(" © %Y",time()); ?></a></div>
       </div>
    

</div>

</body>
</html>