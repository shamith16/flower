<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<title>:: Flower Shop ::</title>
<link rel="shortcut icon" href="images/fav.ico" />
<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="stylesheet" href="css/lightbox.css" type="text/css" media="screen" />
<link rel="stylesheet" href="css/qunit.css" type="text/css" media="screen"/>
<link rel="stylesheet" href="css/bg.css"  type="text/css" />

<link rel="stylesheet" href="css/themes/default/default.css" type="text/css" media="screen" />
<link rel="stylesheet" href="css/nivo-slider.css" type="text/css" media="screen" />
<link rel="stylesheet" href="css/img_slider.css" type="text/css" media="screen" />
	
    <script src="js/prototype-1.7.js" type="text/javascript"></script>
    <script src="js/scriptaculous.js?load=effects" type="text/javascript"></script>
    <script src="js/lightbox.js" type="text/javascript"></script>
    <script type="text/javascript" src="js/java.js"></script>
    
    <!-- Cart System -->  
    <script type="text/javascript" src="https://raw.github.com/jquery/qunit/master/qunit/qunit.js"></script>  
    <!-- Your project file goes here -->  
    <script type="text/javascript" src="js/simpleCart.js"></script>  
    <!-- Your tests file goes here -->  

	<script type="text/javascript">
		simpleCart.email = "mail@flowers-shop.com";
		simpleCart.checkoutTo = PayPal;
	//	simpleCart.merchantId = "118575326044237";
	//	simpleCart.checkoutTo = GoogleCheckout;
		simpleCart.currency = USD;
	//	simpleCart.currency = GBP;
	//  simpleCart.currency = EUR;
		simpleCart.taxRate  = 0.08;
	//	simpleCart.shippingFlatRate = 5.25;
		simpleCart.shippingQuantityRate = 1.00;
	/*	CartItem.prototype.shipping = function(){
			if( this.size ){
				switch( this.size.toLowerCase() ){
					case 'small':
						return this.quantity * 10.00;
					case 'medium':
						return this.quantity * 12.00;
					case 'large':
						return this.quantity * 15.00;
					case 'bull':
						return 45.00;
					default:
						return this.quantity * 5.00;
				}
			}
		};
	*/

		simpleCart.cartHeaders = ["Thumb_image_noHeader", "Name" , "Size_input_div_div", "Price" , "decrement_noHeader" , "Quantity", "increment_noHeader", "remove_noHeader", "Total" ];
	</script>
	
	<style >

	 	.itemContainer{
			width:100%;
			float:left;
		}

		.itemContainer div{
			float:left;
			margin: 5px 20px 5px 20px ;
		}

		.itemContainer a{
			text-decoration:none;
		}

		.cartHeaders{
			width:100%;
			float:left;
		}

		.cartHeaders div{
			float:left;
			margin: 5px 20px 5px 20px ;
		}


	</style>
    
    <!-- Image Slider --> 
    <script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
	<script>jQuery.noConflict();</script>
    <script type="text/javascript" src="js/jquery.nivo.slider.js"></script>
    <script type="text/javascript">
    jQuery(window).load(function() {
        jQuery('#slider').nivoSlider();
    });
    </script>
		
	<!-- Gmap3 Google --> 
      <script src="http://maps.google.com/maps/api/js?sensor=false" type="text/javascript"></script>
      <script type="text/javascript" src="js/gmap3.js"></script> 
      <script type="text/javascript">
      jQuery(function(){
  
        jQuery('#map').gmap3(
          {
            action: 'addInfoWindow',
            address: "kalma Chownk Lahore,pakistan ",
            map:{
              center: true,
              zoom: 16
            },
            infowindow:{
              options:{
                size: new google.maps.Size(50,50),
                content: 'Hello World !'
              },
              events:{
                closeclick: function(infowindow){
                  alert('closing : ' + jQuery(this).attr('id') + ' : ' + infowindow.getContent());
                }
              },
              apply:[
                {action:'setContent', args:['Flowers Shop - Mian Branch ']}
              ]
            }
          },
          {action: 'setOptions', args:[{scrollwheel:true}]}
        );
          
      });
     </script> 

     <style>
      .gmap3{
        margin: 1px 10px 5px 10px;
        border: 1px dashed #C0C0C0;
        width: 450px;
        height: 250px;
      }
    </style>

    <!-- number --> 
    <script type="text/javascript">
      <!--
      function isNumberKey(evt)
      {
         var charCode = (evt.which) ? evt.which : event.keyCode
         if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;

         return true;
      }
      //-->
   </script>

</head>
<body>
<div id="wrap" >

       <div class="header">
       		<div class="logo"><a href="index.php"><img src="images/logo.png" alt="" title="" border="0" /></a></div>            
        <div id="menu">
            <ul>                                                           
            <li><a href="index.php">Home</a></li>
            <li><a href="about_us.php">About us</a></li>
            <li><a href="products.php">Products</a></li>
            <li><a href="categories.php">Categories</a></li>
            <li><a href="catalogs.php">Catalog's</a></li>
            <li><a href="details.php">Prices</a></li>
            <li><a href="contact.php">Contact</a></li>
            </ul>
        </div>     
            
            
       </div> 
        
       <div class="center_content"> 