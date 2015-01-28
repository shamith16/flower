<?php require_once("..".DIRECTORY_SEPARATOR."includes".DIRECTORY_SEPARATOR."initialize.php") ?>
<?php if (!$session->is_logged_in()) { redirect_to("login.php"); } ?>
<?php
	// must have an ID
  if(empty($_GET['id'])) {
  	$session->message("No photograph ID was provided.");
    redirect_to('products_list.php');
  }

  $photo = Photograph::find_by_id($_GET['id']);
  if($photo && $photo->destroy()) {
    $session->message("The photo {$photo->filename} was deleted.");
    redirect_to('products_list.php');
  } else {
    $session->message("The photo could not be deleted.");
    redirect_to('products_list.php');
  }
  
?>
<?php if(isset($database)) { $database->close_connection(); } ?>
