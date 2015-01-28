<?php require_once("includes".DIRECTORY_SEPARATOR."initialize.php");
if(!$session->is_logged_in()){
    redirect_to("login.php");
}else{	
    $session->logout();
    redirect_to("login.php");
}
?>
