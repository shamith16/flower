<?php require_once("..".DIRECTORY_SEPARATOR."includes".DIRECTORY_SEPARATOR."initialize.php");

if($session->is_logged_in()){
    if(User::access_b_end($session->user_id)){redirect_to("login.php");}
    }
elseif(!$session->is_logged_in()){
        redirect_to("login.php");
    }
$me =  User::get_username($session->user_id);

$message = "Fill All Fields.";

      if (isset($_POST['submit'])) { 
        if( !empty($_POST['name']) ){
            $cata_name_exist= Catalog::find_by_id_name($_POST['name']);
                if(!$cata_name_exist){
                    $new_cata = new Catalog();
                    $new_cata->catalog_name=trim($_POST['name']);
                    $new_cata->catalog_des=trim($_POST['description']);
      
	               if($new_cata && $new_cata->save()) {
                        $message = "The {$new_cata->catalog_name} is successfully Inserted.";
	                       redirect_to("catalogs_list.php");
		          } else {
	               $message = "There was an error that prevented the Catalog from being saved.";
		          }
                }else{
                   $message = "{$_POST['name']} already exists.";
                }
        }else {
             $message="Error : Name Field is must.";
        }
}else { // Form has not been submitted.
        $name="";
        $family="";
        $subcategory="";
}
	

include_layout_template("admin_header.php");
?>
<div class="admin_left_content">
        	
        <div class="title"><span class="title_icon"><img src="../images/bullet1.gif" alt="" title="" /></span>Insert Catalog</div>
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
         <form action="insert_cata.php" method="post">
           <table style="font-size: 12px; font-weight: bold;">
            <tr>
                <td><a>Catalog Name: </a></td>
                <td><input type="text" name="name" maxlength="20" value="" /></td>
            </tr>
            <tr>
                <td><a>Description: </a></td>
                <td><textarea cols="25" rows="5" name="description" ></textarea></td>
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
             
             	<div class="title"><span class="title_icon"><img src="../images/bullet6.gif" alt="" title="" /></span>Catalogs</div> 
                
                <ul class="list">
                <li><a href="find_cata.php">Find Catalog</a></li>
                <li><a href="insert_cata.php">Insert Catalog</a></li> 
                <li><a href="catalogs_list.php">All Catalogs</a></li>
                <li><a href="catalogs_pro_list.php">Add Products</a></li>                                              
                </ul>
             </div> 
             
        <div class="clear"></div>
        </div><!--end of right content-->
        
<?php include_layout_template("admin_footer.php");?>

