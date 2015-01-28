<?php require_once("..".DIRECTORY_SEPARATOR."includes".DIRECTORY_SEPARATOR."initialize.php") ?>
<?php if (!$session->is_logged_in()) { redirect_to("login.php"); } ?>
<?php
	// must have an ID
  if(empty($_POST['del'])) {
  	$session->message("No User ID was provided.");
    redirect_to('users_list.php');
  }

  $user = User::find_by_id($_POST['del']);
  if($session->user_id == $user->id && $user->delete()) {
    redirect_to("logout.php?id={$_POST['del']}");
  } elseif($session->user_id != $user->id && $user->delete()) {
    $session->message("The User is deleted Successfully.");
    redirect_to('users_list.php');
  } else {
    $session->message("The User could not be deleted.");
    redirect_to('users_list.php');
  }
  
?>
<?php if(isset($database)) { $database->close_connection(); } ?>
