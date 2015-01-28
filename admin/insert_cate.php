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
        if( !empty($_POST['name']) && !empty($_POST['subcategory'])){
            $cate_name_exist= Category::find_by_id_name($_POST['name']);
                if(!$cate_name_exist){
                    $new_cate = new Category();
                    $new_cate->category_name=trim($_POST['name']);
                    $new_cate->subcategory=trim($_POST['subcategory']);
      
	               if($new_cate && $new_cate->save()) {
  
                        $message = "The {$new_cate->category_name} is successfully Inserted.";
	                       redirect_to("categories_list.php");
		          } else {
	               $message = "There was an error that prevented the Category from being saved.";
		          }
                }else{
                   $message = "{$_POST['name']} already exists.";
                }
        }else {
             $message="Error : Fill All Fields.";
        }
}else { // Form has not been submitted.
        $name="";
        $subcategory="";
}
	

include_layout_template("admin_header.php");
?>
<div class="admin_left_content">
        	
        <div class="title"><span class="title_icon"><img src="../images/bullet1.gif" alt="" title="" /></span>Insert Category</div>
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
         <form action="insert_cate.php" method="post">
           <table style="font-size: 12px; font-weight: bold;">
            <tr>
                <td><a>Category Name: </a></td>
                <td><input type="text" name="name" maxlength="20" value="" /></td>
            </tr>
                <td><a>Subcategory: </a></td>
                <td><input type="text" maxlength="20"  name="subcategory" value="" /></td>
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
             
             	<div class="title"><span class="title_icon"><img src="../images/bullet6.gif" alt="" title="" /></span>Categories</div> 
                
                <ul class="list">
                <li><a href="find_cate.php">Find Category</a></li>
                <li><a href="insert_cate.php">Insert Category</a></li>    
                <li><a href="categories_list.php">All Categories</a></li>                                        
                </ul>
             </div> 
             
        <div class="clear"></div>
        </div><!--end of right content-->
        
<?php include_layout_template("admin_footer.php");?>

