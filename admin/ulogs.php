<?php require_once("..".DIRECTORY_SEPARATOR."includes".DIRECTORY_SEPARATOR."initialize.php");

if($session->is_logged_in()){
    if(User::access_b_end($session->user_id)){redirect_to("login.php");}
    }
elseif(!$session->is_logged_in()){
        redirect_to("login.php");
    }
$me =  User::get_username($session->user_id);

  $logfile = SITE_ROOT.DS.'logs'.DS.'ulog.txt';
  
  if(isset($_POST['clear'])) {
		file_put_contents($logfile, '');
		echo $logfile;
	  // Add the first log entry
	  ulog_action('Logs Cleared', "by User ID {$session->user_id} | {$me}");
    // redirect to this same page so that the URL won't 
    // have "clear=true" anymore
    redirect_to('ulogs.php');
  } 

include_layout_template("admin_header.php");
?>
    <div class="admin_left_content">
            <div class="title"><span class="title_icon"><img src="../images/bullet1.gif" alt="" title="" /></span>Login Details</div>
        	<div class="feat_prod_box">
   	                
                    <div class="feat_prod_box"></div>
                    <div class="prod_title">Admin / Employee Logs :</div>
                    <p class="details">Following are the details about users that logged into Back-End or clear the Logs File : </p>
                    
                    <?php
                        if( file_exists($logfile) && is_readable($logfile) && $handle = fopen($logfile, 'r')) 
                        {  // read
                             echo "<ul  style=\"margin-left: 50px;\"><br/>";
		                     while(!feof($handle)) {
			                     $entry = fgets($handle);
			                     if(trim($entry) != "") {
				                    echo "<li class=\"li\"><a class=\"selected\">{$entry}</a></li><br/>";
			                         }
                        }
		               echo "</>";
                       fclose($handle);
                       } else {
                       echo "Could not read from {$logfile}.";
                       }
                    ?>
                    
            <div class="clear"></div>
            <div style="padding-top: 3em;">
            <form action="ulogs.php" method="post">
            <?php if(!User::access_level($session->user_id))
            {    
                echo "<input type=\"hidden\" id=\"clear\" name=\"clear\" value=\"true\" />";
                echo "<a style=\"font: xx-small;\" class=\"more\" ><input type=\"submit\" name=\"Clear\" id=\"Clear\"  value=\"Clear\" class=\"register\" /></a>";  
            }?>
                <a href="ulogs.php" style="font: xx-small;" class="more" ><input type="clr" name="Reload" id="Reload"  value="Reload" class="register" /></a><br />
            </form>
            </div>
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
             <div class="admin_about">
             
             	<div class="title"><span class="title_icon"><img src="../images/bullet6.gif" alt="" title="" /></span>Logs</div> 
                
                <ul class="list">
                <li><a href="ulogs.php">Admin / Employee Logs</a></li>
                <li><a href="clogs.php">Customer Logs</a></li>                                      
                </ul>
             </div> 
             
        <div class="clear"></div>
        </div><!--end of right content-->
        
<?php include_layout_template("admin_footer.php");?>

