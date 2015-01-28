<?php require_once("..".DIRECTORY_SEPARATOR."includes".DIRECTORY_SEPARATOR."initialize.php");

if($session->is_logged_in()){
    if(User::access_b_end($session->user_id)){redirect_to("login.php");}
    }
elseif(!$session->is_logged_in()){
        redirect_to("login.php");
    }
$me =  User::get_username($session->user_id);
$found_cata = null;
$pagination = null;

if (isset($_POST['submit'])) { 
        if( !empty($_POST['catalog']) && !empty($_POST['product'])){
            $pro_cata_name_exist= ProCatalog::find_by_pro_cata((int)$_POST['product'],(int)$_POST['catalog']);
                if(!$pro_cata_name_exist){
                    $new_pro_cata = new ProCatalog();
                    $new_pro_cata->pro_id=trim($_POST['product']);
                    $new_pro_cata->catalog_id=trim($_POST['catalog']);
                    $new_pro_cata->add_on=trim($_POST['add_on']);
	               if($new_pro_cata && $new_pro_cata->save()) {
  
                        $message = "The {$new_pro_cata->category_name} is successfully Inserted.";
	                       redirect_to("catalogs_pro_list.php");
		          } else {
	               $message = "There was an error that prevented the Catalog from being saved.";
		          }
                }else{
                   $message = "Product in Catalog already exists.";
                }
        }else {
             $message="Error : All Field are must.";
        }
}
elseif (isset($_POST['submit_find'])) {
  $decision = trim($_POST['decision']);
  $find = trim($_POST['find']);
  
  // Check database to see if username/password exist.
	$found_cata = ProCatalog::find_by_pro_cata_id($decision,$find);
  if (!$found_cata){
    unset($found_cata);
    // username/password combo was not found in the database
    $message = "Catalog is not found in Database.";
  }
  
}
if(!isset($found_cata)){
	// 1. the current page number ($current_page)
	$page = !empty($_GET['page']) ? (int)$_GET['page'] : 1;

	// 2. records per page ($per_page)
	$per_page = 15;

	// 3. total record count ($total_count)
	$total_count = ProCatalog::count_all();
	

	// Find all photos
	// use pagination instead
	//$photos = Photograph::find_all();
	
	$pagination = new Pagination($page, $per_page, $total_count);
	
	// Instead of finding all records, just find the records 
	// for this page
	$sql = "SELECT * FROM add_pro_cata ";
    $sql .= "ORDER BY add_on ASC ";
	$sql .= "LIMIT {$per_page} ";
	$sql .= "OFFSET {$pagination->offset()} ";
    
	$found_cata = ProCatalog::find_by_sql($sql);
}	
	// Need to add ?page=$page to all links we want to 
	// maintain the current page (or store $page in $session)
	

include_layout_template("admin_header.php");
?>
<div class="admin_left_content">
        	
        <div class="title"><span class="title_icon"><img src="../images/bullet1.gif" alt="" title="" /></span>Catalogs Product</div>
        <div class="feat_prod_box"></div>
        <div class="find_user_form2">
        <form action="catalogs_pro_list.php" method="POST" >
        <input type="text" name="find" id="find" maxlength="55"/>
        <td>&nbsp;</td>
        <select name="decision">
           <option id="1">Pro_ID</option>"
           <option id="2">Catalog_ID</option>"
        </select>
        <input type="submit" id="submit_find" name="submit_find" value="" class="find_user_btn"/>
        </form>
        </div>
        <?php
        if(isset($_POST['submit'])){
            //Display Error: to insertion area.
        } elseif($found_cata){ 
            echo "<p><b>".output_message($message)."</b></p><br/>";
        } ?>
        <table align="center" style="font-size: 11px;" >
              <tr style="color: #6CAB52;">
              <th>&nbsp;</th>
              <th >Product ID</th>
              <th>Catalog ID</th>
              <th>Added on</th>
		      <th>&nbsp;</th>
              <th>&nbsp;</th>
            </tr>
        <?php foreach($found_cata as $pro_cata):?>
        	<tr align="center">
              <td ><br /><img src="../images/pro_to_cata.gif" width="45" height="50" /></td>
              <td width="70px"><?php echo $pro_cata->pro_id; ?> </td>
              <td width="70px"><?php echo $pro_cata->catalog_id; ?></td>
              <td width="200px"><?php echo datetime_to_text($pro_cata->add_on); ?></td>
              <td width="70px"><a href="delete_pro_cata.php?pro_id=<?php echo "{$pro_cata->pro_id}&&cata_id={$pro_cata->catalog_id}"; ?>">Delete</a></td>
            </tr>
         <?php endforeach;?>
           </table>
           
           <?php
                if($pagination){
                    echo "<div class=\"admin_pagination\">";   
	               if($pagination->total_pages() > 1) {
		
                   if($pagination->has_previous_page()) { 
    	                echo "<a href=\"catalogs_pro_list.php?page=";
                        echo $pagination->previous_page();
                        echo "\">&laquo; Previous</a> "; 
                     }
                   for($i=1; $i <= $pagination->total_pages(); $i++) {
		              if($i == $page) {
                        echo " <span class=\"current\">{$i}</span> ";
                      } else {
				        echo " <a href=\"catalogs_pro_list.php?page={$i}\">{$i}</a> "; 
			          }
                   }
        
		          if($pagination->has_next_page()) { 
			         echo " <a href=\"catalogs_pro_list.php?page=";
			         echo $pagination->next_page();
                     echo "\">Next &raquo;</a> "; 
                    }
		
                 }
                    echo "</div>"; 
                 }
            ?>        
           <div  class="add_pro_cata">
             <?php
              if(!isset($_POST['submit'])){
                echo "<div class=\"form_subtitle\" style=\"font-size:12px;\" ><b>Add Product to Desire Catalog</b></div>";
               }else{
                echo "<div class=\"form_subtitle\" style=\"font-size:12px;\" ><b>".output_message($message)."</b></div>";
               }
             ?>
           <form action="catalogs_pro_list.php" method="POST" >
                <table align="center" style="font-size: 11px;">
                <input type="hidden" name="add_on" value="<?php echo strftime("%Y-%m-%d %H:%M:%S",time());?>" />
                <tr>
                <td ><img src="../images/pro_to_cata.gif" width="45" height="50" /></td>
                <td><a>Product ID :<a></td>
                   <td><select name="product">
                      <?php 
                       $list_pro=photograph::find_all();
                       foreach($list_pro as $pro){
		               echo "<option id=\"$$pro->id\">{$pro->id}</option>";
                       }?>
                       </select>
                    </td>
                    <td><a>Catalog ID :<a></td>
                      <td><select name="catalog">
                      <?php 
                       $list_cata=Catalog::find_all();
                       foreach($list_cata as $cata){
		               echo "<option id=\"$cata->id\">{$cata->id}</option>";
                       }?>
                       </select>
                      </td>
                    <td>&nbsp;</td>
                    <td><input type="submit" name="submit" value="Insert" class="register"/></td>
                </tr>            
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

