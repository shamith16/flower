
<div class="right_content">
        	<div class="languages_box">
            <span class="red">Languages:</span>
            <a href="" class="selected"><img src="images/sa.png" height="11" width="16" alt="" title="" border="0" /></a>
            <a href=""><img src="images/pk.png" height="11" width="16" alt="" title="" border="0" /></a>
            <a href=""><img src="images/ir.png" height="11" width="16" alt="" title="" border="0" /></a>
            </div>
                <div style="margin-right: 5px; float:right;" class="currency">
                <span class="red"></span>
                <?php
                global $session;
                if(!isset($session->user_id)){
                    echo "<a href=\"register.php\">Register</a>";
                    echo "<a href=\"login.php\" class=\"selected\">Login</a>";
					 
					//<!---- cart thing without registration  -----> 
					echo "</div><div class=\"cart\">";
                    echo "<div class=\"title\"><span class=\"title_icon\"><img src=\"images/cart.gif\" alt=\"\" title=\"\" /></span>My Cart</div>";
                    echo "<div class=\"home_cart_content\"><b class=\"simpleCart_quantity\"></b> x items | <span class=\"red\">TOTAL: <a class=\"simpleCart_total\"></a></span></div>";
                    echo "<a href=\"cart_info.php\" class=\"view_cart\">view cart</a>";
                    echo "</div>";
					
                    //echo "<div  class=\"about\"></div>";
                    echo "<div class=\"title\"><span class=\"title_icon\"><img src=\"images/bullet3.gif\" alt=\"\" title=\"\" /></span>About Shop</div>";
                    echo "<div class=\"about\">";
                    echo "<p style=\"text-indent: 40px;\">";
                    echo "<img src=\"images/about.png\" alt=\"\" title=\"\" class=\"right\" />Welcome to Flower Shop, here you can find the Flowers of your choice. Your choice is matter more for us.</p>";
                    echo "</div>";
                    
                }else{
                    
                    echo "<a href=\"reset_info.php?id={$session->user_id}\" class=\"selected\">".User::get_username($session->user_id)."</a>";
                    echo "<a href=\"logout.php\" >Logout</a>";
                    echo "</div>";
                    echo "<div class=\"cart\">";
                    echo "<div class=\"title\"><span class=\"title_icon\"><img src=\"images/cart.gif\" alt=\"\" title=\"\" /></span>My Cart</div>";
                    echo "<div class=\"home_cart_content\"><b class=\"simpleCart_quantity\"></b> x items | <span class=\"red\">TOTAL: <a class=\"simpleCart_total\"></a></span></div>";
                    echo "<a href=\"cart_info.php\" class=\"view_cart\">view cart</a>";
                    echo "</div>";
                    //<!---- all of cart thing  -----> 
                    echo "<div style=\"margin-top: 20px;\">";	
                    echo "<div align=\"left\" style=\"margin-top:10em;margin-left:2em;\">&nbsp;&nbsp;&nbsp;</span> <span </span> ";
                    echo "<br />";
	                echo "<a href=\"javascript:;\" class=\"simpleCart_empty\">empty cart</a>";
	                echo "<br />";
                    echo "</div>";
                    //echo "<div class=\"simpleCart_items\" >";
                    //echo "</div>";
                    echo "<br />";
                    echo "<div style=\"margin-left: 50px;\">SubTotal: <span class=\"simpleCart_total\"></span> <br />";
	                echo "Tax: <span class=\"simpleCart_taxCost\"></span> <br />";
	                echo "Shipping: <span class=\"simpleCart_shippingCost\"></span> <br />";
	                echo "-----------------------------<br />";
	                echo "Final Total: <span class=\"simpleCart_finalTotal\"></span> <br /></div><br />";

                    echo "<a href=\"javascript:;\" class=\"simpleCart_checkout\"><div style=\"margin-left:2em;\">checkout</div></a><br />";	 
    
                    echo "</div>"; 
                    echo "<div class=\"cart\"></div>";  

                    //<!----- end of cart ----->	       
                }
                
                ?>
             
             <?php
                    $sql_ran = "SELECT * FROM photographs ";
                    $sql_ran .= "ORDER BY RAND() ";
                    $sql_ran .= "LIMIT 3 ";
    
	                $rand_photos = Photograph::find_by_sql($sql_ran);
             ?>
             <div class="right_box">
             	<div class="title"><span class="title_icon"><img src="images/bullet4.gif" alt="" title="" /></span>Gallery</div> 
                    <?php foreach($rand_photos as $random):?>
                    <div class="new_prod_box">
                        <a href="more.php?pr=<?php echo $random->id ?>&&tb1=1"><?php echo $random->caption; ?></a>
                        <div class="new_prod_bg">
                        <a href="more.php?pr=<?php echo $random->id ?>&&tb1=1"><img src="<?php echo  $random->image_path(); ?>" alt="" width="110" height="90" class="thumb" border="0" /></a>
                        </div>           
                    </div>   
                    <?php endforeach;?>    
             
             </div>
             
             <div class="right_box">
             
             	<div class="title"><span class="title_icon"><img src="images/bullet5.gif" alt="" title="" /></span>Categories</div> 
                
                <ul class="list">
                <?php
                $list_cate=Category::find_all();
                    foreach($list_cate as $cate){
                       echo "<li><a href=\"categories.php?cate={$cate->id}\">{$cate->category_name}</a></li>";  
                    }
                ?>                                          
                </ul>
                
             	<div class="title"><span class="title_icon"><img src="images/bullet6.gif" alt="" title="" /></span>Catalog's</div> 
                
                <ul class="list">
                <?php
                $list_cate=Catalog::find_all();
                    foreach($list_cate as $cata){
                       echo "<li><a href=\"catalogs.php?cata={$cata->id}\">{$cata->catalog_name}</a></li>";  
                    }
                 ?>                      
                </ul>      
             
             </div>         
             
        
        </div><!--end of right content-->
       <div class="clear"></div>
       </div><!--end of center content-->
       
              
       <div class="footer">
       	<div class="left_footer"><img src="images/footer_logo.gif" alt="" title="" /><br /> <a href="http://www.mfinfo.net76.net/" title="Copyright Year"><img src="images/des.png" alt="mfahim" width="60" height="15" border="0" title="Desinger Site" /><?php echo strftime(" &copy; %Y",time()); ?></a></div>
        <div class="right_footer">
            <a href="index.php">Home</a>
            <a href="about_us.php">About us</a>
            <a href="products.php">Products</a>
            <a href="categories.php">Categories</a>
            <a href="catalogs.php">Catalog's</a>
            <a href="contact.php">Contact</a>
        </div>
        
       
       </div>
    

</div>

</body>
</html>