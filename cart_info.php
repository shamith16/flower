<?php
require_once("includes".DIRECTORY_SEPARATOR."initialize.php");
if(!$session->is_logged_in()) {
  redirect_to("login.php");
}
include_layout_template("header.php");
?>

<div class="center_cart">
        	 
<div class="title" align="left"><span class="title_icon"><img src="images/cart.gif" alt="" title="" /></span><?php echo "Cart Details"?></div>
<div class="feat_prod_box"></div>
<div class="feat_prod_box">
  <div  >
    <!---- all of cart thing  -----> 
<div>	
	<p><b>Cart : <span class="simpleCart_total"></span> (<span class="simpleCart_quantity"></span> items)
	<br /></b>
	<a href="javascript:;" class="simpleCart_empty">empty cart</a>
	<br />
	</p>
	<table width="800" align="center"  cellpadding="10" cellspacing="10" border="0" style="font-size: xx-small;" width="900" class="simpleCart_items" >
	</table>


	<br />
	<b>SubTotal : </b><span class="simpleCart_total"></span> <br />
	<b>Tax : </b><span class="simpleCart_taxCost"></span> <br />
	<b>Shipping : </b><span class="simpleCart_shippingCost"></span> <br />
	-----------------------------<br />
	<b>Final Total : </b><a style="font-weight: bold;" class="simpleCart_finalTotal"></a> <br />
    <a href="javascript:;" class="simpleCart_checkout"><div style="margin-top:1em;">checkout</div></a><br /> 
    
 </div> 

<!----- end of cart ----->	
  </div>
  <div class="clear"></div>
</div>        
<div class="clear"></div>
</div>
        
<?php //include_layout_template("footer.php");?>

