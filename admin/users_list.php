<?php require_once("..".DIRECTORY_SEPARATOR."includes".DIRECTORY_SEPARATOR."initialize.php");

if($session->is_logged_in()){
    if(User::access_b_end($session->user_id)){redirect_to("login.php");}
    }
elseif(!$session->is_logged_in()){
        redirect_to("login.php");
    }
$me =  User::get_username($session->user_id);

	// 1. the current page number ($current_page)
	$page = !empty($_GET['page']) ? (int)$_GET['page'] : 1;

	// 2. records per page ($per_page)
	$per_page = 10;

	// 3. total record count ($total_count)
	$total_count = User::count_all();
	

	// Find all photos
	// use pagination instead
	//$photos = Photograph::find_all();
	
	$pagination = new Pagination($page, $per_page, $total_count);
	
	// Instead of finding all records, just find the records 
	// for this page
	$sql = "SELECT * FROM users ";
    $sql .= "ORDER BY id ASC ";
	$sql .= "LIMIT {$per_page} ";
	$sql .= "OFFSET {$pagination->offset()} ";
    
	$users = User::find_by_sql($sql);
	
	// Need to add ?page=$page to all links we want to 
	// maintain the current page (or store $page in $session)
	

include_layout_template("admin_header.php");
?>
<div class="admin_left_content">   	
        <div class="title"><span class="title_icon"><img src="../images/bullet1.gif" alt="" title="" /></span>Users List</div>
        <div class="feat_prod_box"></div>
        <?php echo "<p>".output_message($message)."</p><br/>"; ?>
              <table align="center" style="font-size: 11px;" >
              <tr style="color: #6CAB52;">
              <th>&nbsp;</th>
              <th >ID</th>
              <th>Username</th>
              <th>First Name</th>
              <th>Last Name</th>
              <th>Fullname</th>
		      <th>&nbsp;</th>
              <th>&nbsp;</th>
            </tr>
        <?php
        if(User::access_level($session->user_id)){ 
            foreach($users as $use){
        	  echo "<tr align=\"center\">";
              echo "<td ><br /><img src=\"../images/com.png\"  /></td>";
              echo "<td width=\"70px\">$use->id</td>";
              echo "<td width=\"70px\">$use->username</td>";
              echo "<td width=\"70px\">$use->first_name</td>";
              echo "<td width=\"70px\">$use->last_name</td>";
              echo "<td width=\"70px\">".$use->full_name()."</a></td>";
              if($use->user_type == 'customer' || $use->id == $session->user_id){
                echo "<form action=\"update_user.php\" method=\"post\" >";
                echo "<input type=\"hidden\" id=\"up\" name=\"up\" value=\"$use->id\"/>";
                echo "<td style=\"font: xx-small;\" width=\"70px\"><input type=\"submit\" name=\"update\" id=\"update\"  value=\"Update\" class=\"register\" /></td></form>";
                echo "<form action=\"delete_user.php\" method=\"post\" >";
                echo "<input type=\"hidden\" id=\"del\" name=\"del\" value=\"$use->id\"/>";
                echo "<td style=\"font: xx-small ;\" width=\"70px\"><input type=\"submit\" name=\"delete\" id=\"delete\"  value=\"Delete\" class=\"register\" /></td></form>";
              }
            echo "</tr>";
           }
         }else{
            foreach($users as $use){
        	  echo "<tr align=\"center\">";
              echo "<td ><br /><img src=\"../images/com.png\"  /></td>";
              echo "<td width=\"70px\">$use->id</td>";
              echo "<td width=\"70px\">$use->username</td>";
              echo "<td width=\"70px\">$use->first_name</td>";
              echo "<td width=\"70px\">$use->last_name</td>";
              echo "<td width=\"70px\">".$use->full_name()."</a></td>"; 
                echo "<form action=\"update_user.php\" method=\"post\" >";
                echo "<input type=\"hidden\" id=\"up\" name=\"up\" value=\"$use->id\"/>";
                echo "<td style=\"font: xx-small;\" width=\"70px\"><input type=\"submit\" name=\"update\" id=\"update\"  value=\"Update\" class=\"register\" /></td></form>";
                echo "<form action=\"delete_user.php\" method=\"post\" >";
                echo "<input type=\"hidden\" id=\"del\" name=\"del\" value=\"$use->id\"/>";
                echo "<td style=\"font: xx-small ;\" width=\"70px\"><input type=\"submit\" name=\"delete\" id=\"delete\"  value=\"Delete\" class=\"register\" /></td></form>";
            echo "</tr>";
            }
         }
         ?>  
           </table>              	
    <div class="clear"></div>
    <div class="feat_prod_box"></div>
<div class="admin_pagination">   
<?php
	if($pagination->total_pages() > 1) {
		
		if($pagination->has_previous_page()) { 
    	echo "<a href=\"users_list.php?page=";
      echo $pagination->previous_page();
      echo "\">&laquo; Previous</a> "; 
    }
        for($i=1; $i <= $pagination->total_pages(); $i++) {
			if($i == $page) {
				echo " <span class=\"current\">{$i}</span> ";
			} else {
				echo " <a href=\"users_list.php?page={$i}\">{$i}</a> "; 
			}
		}
        
		if($pagination->has_next_page()) { 
			echo " <a href=\"users_list.php?page=";
			echo $pagination->next_page();
			echo "\">Next &raquo;</a> "; 
    }
		
	}

?>
</div>         
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
             <div class="admin_about">
             
             	<div class="title"><span class="title_icon"><img src="../images/bullet6.gif" alt="" title="" /></span>Users</div> 
                
                <ul class="list">
                <li><a href="find_user.php">Find User</a></li>
                <li><a href="insert_user.php">Insert User</a></li> 
                <li><a href="users_list.php">All Users</a></li>                                            
                </ul>
             </div> 
             
        <div class="clear"></div>
        </div><!--end of right content-->
        
<?php include_layout_template("admin_footer.php");?>

