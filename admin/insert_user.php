<?php require_once("..".DIRECTORY_SEPARATOR."includes".DIRECTORY_SEPARATOR."initialize.php");

if($session->is_logged_in()){
    if(User::access_b_end($session->user_id)){redirect_to("login.php");}
    }
elseif(!$session->is_logged_in()){
        redirect_to("login.php");
    }
$me =  User::get_username($session->user_id);

$message = "Enter info for new user.";

      if (isset($_POST['submit'])) { 
        if(!empty($_POST['username']) && !empty($_POST['password'])){
            $username_exist= User::find_by_id_username($_POST['username']);
                if(!$username_exist){
                    $new_user = new User();
                    $new_user->user_type=trim($_POST['u_type']);
                    $new_user->username=trim($_POST['username']);
                    $new_user->password=User::do_it(trim($_POST['password']));
                    $new_user->email=trim($_POST['email']);
                    $new_user->first_name=trim($_POST['first_name']);
                    $new_user->last_name=trim($_POST['last_name']);
                    $new_user->address=trim($_POST['address']);
      
	               if($new_user && $new_user->save()) {
  
                        $message = "The {$new_user->username} is successfully Inserted.";
	                       redirect_to("users_list.php");
		          } else {
	               $message = "There was an error that prevented the User from being saved.";
		          }
                }else{
                   $message = "{$_POST['username']} already exists.";
                }
        }else {
             $message="Username must be provided.";
        }
}else { // Form has not been submitted.
        $username="";
        $password="";
        $first_name="";
        $last_name="";
}
	

include_layout_template("admin_header.php");
?>
<div class="admin_left_content">
        	
        <div class="title"><span class="title_icon"><img src="../images/bullet1.gif" alt="" title="" /></span>New User</div>
        <div class="feat_prod_box"></div>
        <div class="feat_prod_box">
         <div class="contact_form" >
         <?php
         if(!output_message($message)){
                echo "<div class=\"form_subtitle\" style=\"font-size:12px;\" > Fill All Fields </div>";
            }else{
                echo "<div class=\"form_subtitle\" style=\"font-size:12px;\" >".output_message($message)."</div>";
            }
         ?>
         <form action="insert_user.php?id=<?php echo $user->id; ?>" method="post">
           <table style="font-size: 12px; font-weight: bold;">
           <input type="hidden" name="u_type" maxlength="45" value="customer" />
            <tr>
                <td><a>Username:</a></td>
                <td><input type="text" name="username" maxlength="45" value="" /></td>
            </tr>
            <tr>
                <td><a>Password:</a></td>
                <td><input type="password" name="password" readonly="true" maxlength="35" value="flower_shop" /></td>
            </tr>
            <tr>
                <td><a>Email ID:</a></td>
                <td><input type="email" name="email"  maxlength="240" value="" /></td>
            </tr>
            <tr>
                <td><a>First Name:</a></td>
                <td><input type="text" maxlength="25" size="25" name="first_name" value="" /></td>
            </tr>
            <tr>
                <td><a>Last Name:</a></td>
                <td><input type="text" maxlength="25"  size="25" name="last_name" value="" /></td>
            </tr>
            <tr>
                <td><a>Address:</a></td>
                <td><textarea name="address" cols="32" rows="8"></textarea></td>
            </tr>
           
            <tr>
                <td>&nbsp;</td>
                <td><input type="submit" name="submit" value="Insert" class="register"  /></td>
            </tr>
          </table>
        </form>
        </div>
  <div class="clear"></div>
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

