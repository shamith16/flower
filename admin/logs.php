<?php require_once("..".DIRECTORY_SEPARATOR."includes".DIRECTORY_SEPARATOR."initialize.php");

if($session->is_logged_in()){
    if(User::access_b_end($session->user_id)){redirect_to("login.php");}
    }
elseif(!$session->is_logged_in()){
        redirect_to("login.php");
    }
$me =  User::get_username($session->user_id);

include_layout_template("admin_header.php");
?>
    <div class="admin_left_content">
            <div class="title"><span class="title_icon"><img src="../images/bullet1.gif" alt="" title="" /></span>Login Details</div>
        	<div class="feat_prod_box">
   	                
                    <div class="feat_prod_box"></div>
                    <div class="title"><span class="title_icon"><img src="../images/bullet6.gif" alt="" title="" /></span>Logs</div> 
                    <ul style="margin-bottom: 150px;" class="list">
                    <p class="details">Select form the following Logs : </p><br/>
                    <li style="margin-left: 16px;"><a href="ulogs.php">Admin / Employee Logs</a></li>
                    <li style="margin-left: 16px;"><a href="clogs.php">Customer Logs</a></li>                                      
                    </ul>
                    
                    <div class="clear"></div>
            </div>	
            
        <div class="clear"></div>
        </div><!--end of left content-->
        
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

