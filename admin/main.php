<?php
require_once("..".DIRECTORY_SEPARATOR."includes".DIRECTORY_SEPARATOR."initialize.php");
if($session->is_logged_in()){
    if(User::access_b_end($session->user_id)){
        // try login again 
        $message = "".User::get_username($session->user_id)." is not allowed.";
    }else{
        redirect_to("index.php");
        
    }
}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<title>:: Flower Shop ::</title>
<link rel="shortcut icon" href="../images/fav.ico" />
<link rel="stylesheet" type="text/css" href="../css/choice.css" />
<script language="javascript" type="text/javascript" src="../js/niceforms.js"></script>
<link rel="stylesheet" type="text/css" media="all" href="../css/niceforms-default.css" />

</head>
<body>
<div id="main_container">

	<div class="header_login">
    <div class="logo"><a href="#"><img src="../images/logo.png" alt="" title="" border="0" /></a></div>
    </div>
         <div class="login_form">
         <h3>Login Panels</h3>
	   <a href="#" class="forgot_pass">Help</a> 
         
         <form action="login.php" method="post" class="niceform">
         
                <fieldset>
			  <dl class="submit">
                    		<dd><input type="submit" name="Administrator" value="Administrator" /></dd>
                    </dl>
                    
                    <dl class="submit"><dd>
                    		<input type="submit" name="Employee" value="Employee" /></dd>
                    </dl>
                    
                    <dl class="submit">
                    		<dd><input type="submit" name="Customer" value="Customer" /></dd>
                    </dl>
                    
                </fieldset>
                
         </form>
         </div>  
          
	
    
    <div class="footer_login">
    
    	<div class="left_footer_login">Flower Shop | Powered by <a href="">mfahim</a></div>
    	<div class="right_footer_login"><a href=""><img src="../images/footer_logo.png" alt="" title="" border="0" /></a></div>
    
    </div>


</body>
</html>