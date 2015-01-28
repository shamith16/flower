<?php require_once("..".DIRECTORY_SEPARATOR."includes".DIRECTORY_SEPARATOR."initialize.php");

if($session->is_logged_in()){
    if(User::access_b_end($session->user_id)){redirect_to("login.php");}
    }
elseif(!$session->is_logged_in()){
        redirect_to("login.php");
    }
$me =  User::get_username($session->user_id);

$about = About_us::find_by_id(1);

include_layout_template("admin_header.php");
?>
<div class="admin_left_content">
        	
        <div class="title"><span class="title_icon"><img src="../images/bullet1.gif" alt="" title="" /></span>About us</div>
        <div class="feat_prod_box"></div>
        <?php echo "<p>".output_message($message)."</p><br/>"; ?>
              <table align="center" style="font-size: 11px;" >
              <tr style="color: #6CAB52;">
              <th>&nbsp;</th>
              <th >ID</th>
              <th>Description</th>
              <th>Updated</th>
		      <th>&nbsp;</th>
              <th>&nbsp;</th>
            </tr>
        	<tr align="center">
              <td ><br /><img src="../images/about_us.png" width="50" height="60" /></td>
              <td width="50px"><?php echo $about->id; ?> </td>
              <td width="550px"><?php echo  strip_tags($about->about_del,"<ul><li><p><br><b><a><img>"); ?></td>
              <td width="150px"><?php echo datetime_to_text($about->updated); ?></td>
              <td width="70px"><a href="update_about_us.php?id=<?php echo $about->id; ?>">Update</a></td>
            </tr>
           </table>            
            	
    <div class="clear"></div>
    <div class="feat_prod_box"></div>        
<div class="clear"></div>
</div>

        <div class="admin_right_content">

             <div class="title" style="font-size: small;"><span class="title_icon"><img src="../images/bullet3.gif" alt="" title="" /></span><?php echo output_message($me);?></div> 
            
             <div class="admin_about">
             <p>
             <img src="../images/about.png" alt="" title="" class="right" />
              Welcome to the Administrative area of Flower Shop.
              <br /><br />
              You can logout by pressing this link .<br /><a href="logout.php" style="font-size: 10px;">Logout</a>
              </p>
             </div> 
             
        <div class="clear"></div>
        </div><!--end of right content-->
        
<?php include_layout_template("admin_footer.php");?>

