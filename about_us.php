<?php require_once("includes".DIRECTORY_SEPARATOR."initialize.php");
$find=About_us::find_by_id(1);
$about_us=$find->about_del;
$title= "About us";
include_layout_template("header.php");
?>

<div class="left_content">
        	 
<div class="title"><span class="title_icon"><img src="images/bullet2.gif" alt="" title="" /></span>About us</div>
<div class="feat_prod_box_details" style="padding: 30px;">
<div class="feat_prod_box"></div>
<?php echo strip_tags($about_us,"<ul><li><p><br><b><a><img>"); ?>      
<div class="clear"></div>
</div>
</div>
        
<?php include_layout_template("footer.php");?>