<?php require_once("..".DIRECTORY_SEPARATOR."includes".DIRECTORY_SEPARATOR."initialize.php");

if($session->is_logged_in()){
    if(User::access_b_end($session->user_id)){redirect_to("login.php");}
    }
elseif(!$session->is_logged_in()){
        redirect_to("login.php");
    }
$me =  User::get_username($session->user_id);

	$max_file_size = 1048576;   // expressed in bytes
	                            //     10240 =  10 KB
	                            //    102400 = 100 KB
	                            //   1048576 =   1 MB
	                            //  10485760 =  10 MB

	if(isset($_POST['submit'])) {
		$pro = new Photograph();
		$pro->caption = $_POST['caption'];
        $pro->price = (double)$_POST['price'];
        $pro->description = $_POST['description'];
        $pro->category_id = (int)$_POST['category'];
        $pro->family = $_POST['family'];
        $pro->color = $_POST['color'];
        $pro->inserted = $_POST['inserted'];
		$pro->attach_file($_FILES['file_upload']);
		if($pro->save()) {
			// Success
         $session->message("Product saved successfully.");
			redirect_to('products_list.php');
		} else {
			// Failure
         $message = join("<br />", $pro->errors);
		}
	}
	
	

include_layout_template("admin_header.php");
?>
<div class="admin_left_content">
        	
        <div class="title"><span class="title_icon"><img src="../images/bullet1.gif" alt="" title="" /></span>Insert Product</div>
        <div class="feat_prod_box"></div>
            <div class="contact_form" >
            <?php
            if(!output_message($message)){
                echo "<div class=\"form_subtitle\" style=\"font-size:12px;\" > Fill All Fields </div>";
            }else{
                echo "<div class=\"form_subtitle\" style=\"font-size:12px;\" >".output_message($message)."</div>";
            }
            ?>
            <form action="insert_product.php" enctype="multipart/form-data" method="POST" >
                <table style="font-size: 12px; font-weight: bold;">
                <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo $max_file_size; ?>" />
                <input type="hidden" name="inserted" value="<?php echo strftime("%Y-%m-%d %H:%M:%S",time()); ?>" />
                <tr>
                    <td><a>File Path: </a></td>
                    <td><input type="file" name="file_upload" /></td>
                </tr>
                <tr>
                    <td><a>Name: <a></td>
                    <td><input type="text" maxlength="60" name="caption" value="" /></td>
                </tr>
               
                <tr>
                    <td><a>Price: <a></td>
                    <td><input type="text" maxlength="11" name="price" value="" /></td>
                </tr>
                 <tr>
                      <td><a>Category ID: <a></td>
                      <td><select name="category">
                      <?php 
                       $list_cate=Category::find_all();
                       foreach($list_cate as $cate){
		               echo "<option id=\"$cate->id\">{$cate->id}</option>";
                       }?>
                      </select>
                      </td>
                </tr>
                <tr>
                       <td><a>Family: <a></td>
                    <td><input type="text" maxlength="45" name="family" value="" /></td>
                </tr>
                <tr>
                    <td><a>Color: <a></td>
                        <script type="text/javascript" src="../js/jscolor/jscolor.js"></script>
                    <td><input type="text" maxlength="6" size="6" name="color" class="color" value="" /></td>
                </tr>
                <tr>
                    <td><a>Description: <a></td>
                    <td><textarea cols="25" rows="6" name="description" id="description"  ></textarea></td>
                </tr>
                    <td>&nbsp;</td>
                    <td><input type="submit" name="submit" value="Insert"  class="register"/></td>
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

