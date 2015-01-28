<?php require_once("..".DIRECTORY_SEPARATOR."includes".DIRECTORY_SEPARATOR."initialize.php") ?>
<?php if (!$session->is_logged_in()) { redirect_to("login.php"); } ?>
<?php
	// must have an ID
  if(empty($_GET['id'])) {
  	$session->message("No Catalog ID was provided.");
    redirect_to('catalogs_list.php');
  }

  $catalog_de = Catalog::find_by_id($_GET['id']);
  if($catalog_de && $catalog_de->delete()) {
    $session->message("The Catalog deleted successfully.");
    redirect_to("catalogs_list.php");
  } else {
    $session->message("The Catalog could not be deleted.");
    redirect_to('catalogs_list.php');
  }
  
?>
<?php if(isset($database)) { $database->close_connection(); } ?>
