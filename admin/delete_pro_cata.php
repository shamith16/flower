<?php require_once("..".DIRECTORY_SEPARATOR."includes".DIRECTORY_SEPARATOR."initialize.php") ?>
<?php if (!$session->is_logged_in()) { redirect_to("login.php"); } ?>
<?php
	// must have an ID
  if(empty($_GET['pro_id']) && empty($_GET['pro_id'])) {
  	$session->message("No Catalog or Product ID was provided.");
    redirect_to('catalogs_pro_list.php');
  }

  $pro_catalog_de = ProCatalog::find_by_pro_cata($_GET['pro_id'],$_GET['cata_id']);
  if($pro_catalog_de && $pro_catalog_de->delete()) {
    $session->message("The Product Catalog deleted successfully.");
    redirect_to("catalogs_pro_list.php");
  } else {
    $session->message("The Product Catalog could not be deleted.");
    redirect_to('catalogs_pro_list.php');
  }
  
?>
<?php if(isset($database)) { $database->close_connection(); } ?>
