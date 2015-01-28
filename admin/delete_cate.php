<?php require_once("..".DIRECTORY_SEPARATOR."includes".DIRECTORY_SEPARATOR."initialize.php") ?>
<?php if (!$session->is_logged_in()) { redirect_to("login.php"); } ?>
<?php
	// must have an ID
  if(empty($_GET['id'])) {
  	$session->message("No Category ID was provided.");
    redirect_to('categories_list.php');
  }

  $del_category  = Category::find_by_id($_GET['id']);
  if($del_category && $del_category->delete()) {
    redirect_to("categories_list.php?id={$_GET['id']}");
  } else {
    $session->message("The Category could not be deleted.");
    redirect_to('categories_list.php');
  }
  
?>
<?php if(isset($database)) { $database->close_connection(); } ?>
