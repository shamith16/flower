<?php require_once("..".DIRECTORY_SEPARATOR."includes".DIRECTORY_SEPARATOR."initialize.php");

if($session->is_logged_in()){
    if(User::access_b_end($session->user_id)){redirect_to("login.php");}
    }
elseif(!$session->is_logged_in()){
        redirect_to("login.php");
    }
$me =  User::get_username($session->user_id);

  if(empty($_GET['id'])) {
  	$session->message("No Product ID was provided.");
    redirect_to('products_list.php');
  }

  $up_pro = Photograph::find_by_id($_GET['id']);
  if(!$up_pro) {
    $session->message("The Product could not be found.");
    redirect_to('products_list.php');
  }



	if(isset($_POST['submit'])) {
		$pro = new Photograph();
        $pro->id = $_POST['pro_id'];
		$pro->caption = $_POST['caption'];
        $pro->price = (double)$_POST['price'];
        $pro->description = $_POST['description'];
        $pro->category_id = $_POST['category'];
        $pro->family = $_POST['family'];
        $pro->color = $_POST['color'];
        $pro->inserted = $_POST['inserted'];
        $pro->filename = $_POST['filename']; 
        $pro->type = $_POST['type']; 
        $pro->size = $_POST['size'];
		if($pro->save()) {
			// Success
         $session->message("Product Updated successfully.");
			redirect_to('products_list.php');
		} else {
			// Failure
         $session->message("{$pro->caption} remains unchanged.");
         redirect_to('products_list.php');
		}
	}
	
	

include_layout_template("admin_header.php");
?>
<div class="admin_left_content">
        	
        <div class="title"><span class="title_icon"><img src="../images/bullet1.gif" alt="" title="" /></span>Update Product</div>
        <div class="feat_prod_box"></div>
            <div class="contact_form" >
            <?php
            if(!output_message($message)){
                echo "<div class=\"form_subtitle\" style=\"font-size:12px;\" > Fill All Fields </div>";
            }else{
                echo "<div class=\"form_subtitle\" style=\"font-size:12px;\" >".output_message($message)."</div>";
            }
            ?>
            <form action="update_product.php?id=<?php echo $up_pro->id?>" method="POST" >
                <table style="font-size: 12px; font-weight: bold;">
                <input type="hidden" name="pro_id" value="<?php echo $up_pro->id; ?>" />
                <input type="hidden" name="inserted" value="<?php echo strftime("%Y-%m-%d %H:%M:%S",strtotime($up_pro->inserted)); ?>" />
                <input type="hidden" name="filename" value="<?php echo $up_pro->filename; ?>" />
                <input type="hidden" name="type" value="<?php echo $up_pro->type; ?>" />
                <input type="hidden" name="size" value="<?php echo $up_pro->size; ?>" />
                <tr>
                    <td><a>Name: <a></td>
                    <td><input type="text" maxlength="255" name="caption" value="<?php echo$up_pro->caption; ?>" /></td>
                </tr>
               <tr>
                      <td><a>Category ID: <a></td>
                      <td><select name="category">
                      <?php 
                       $list_cate=Category::find_all();
                       foreach($list_cate as $cate){
                        if($cate->id == $up_pro->category_id){
	                       echo "<option selected=\"true\" id=\"$cate->id\">{$cate->id}</option>";
                        }else{
                           echo "<option id=\"$cate->id\">{$cate->id}</option>";
                        }                     
                       }?>
                       </select>
                      </td>
                </tr>
                <tr>
                    <td><a>Family: <a></td>
                    <td><input type="text" maxlength="45" name="family" value="<?php echo$up_pro->family; ?>" /></td>
                </tr>
                <tr>
                    <td><a>Color: <a></td>
                    <script type="text/javascript" src="../js/jscolor/jscolor.js"></script>
                    <td><input type="text" maxlength="6" size="6" name="color" class="color" value="<?php echo $up_pro->color; ?>" /></td>
                </tr>
                <tr>
                    <td><a>Price: <a></td>
                    <td><input type="text" maxlength="11" name="price" value="<?php echo $up_pro->price; ?>" /></td>
                </tr>
                <tr>
                    <td><a>Description: <a></td>
                    <td><textarea cols="25" rows="6" name="description" id="description"  ><?php echo $up_pro->description; ?></textarea></td>
                </tr>
                    <td>&nbsp;</td>
                    <td><input type="submit" name="submit"  value="Update"  class="register"/></td>
                </table> 
                </form> 
            </div>           	
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
             <div class="admin_about">
             
             	<div class="title"><span class="title_icon"><img src="../images/bullet6.gif" alt="" title="" /></span>Products</div> 
                
                <ul class="list">
                <li><a href="find_product.php">Find Product</a></li>
                <li><a href="insert_product.php">Insert Product</a></li>    
                <li><a href="products_list.php">All Products</a></li>                                       
                </ul>
             </div> 
             
        <div class="clear"></div>
        </div><!--end of right content-->
        
<?php include_layout_template("admin_footer.php");?>

