<?php require_once("includes".DIRECTORY_SEPARATOR."initialize.php");

    //comment submission.
	if(isset($_POST['submit'])) {
	  $author = trim($_POST['author']);
      $subject = trim("Request : ".$_POST['subject']);
      $email = trim($_POST['email']);
	  $body = trim($_POST['body']);
	
	        $new_comment = Comment::make_contact($author, $subject, $email , $body);
            if($new_comment){
                $message = "The Request is successfully submitted.";
            }
            else{
                $message = "Error : that prevented the Request to send.";
            }
	}elseif(isset($_POST['submit'])) {
		$author = "";
        $subject = "";
        $email="";
		$body = "";
        $message = "Error : CAPTCHA & Fleids";
	} else {
		$author = "";
        $subject = "";
        $email="";
		$body = "";
	}
include_layout_template("header.php");
?>

<div class="left_content">
        	 
<div class="title"><span class="title_icon"><img src="images/bullet2.gif" alt="" title="" /></span>Contact us</div>
<div class="feat_prod_box"></div>
<div id="map" class="gmap3"></div>
<div class="feat_prod_box">
  <div class="contact_form">
  <?php
         if(!output_message($message)){
                echo "<div class=\"form_subtitle\" style=\"font-size:12px;\" > Fill All Fields </div>";
            }else{
                echo "<div class=\"form_subtitle\" style=\"font-size:12px;\" >".output_message($message)."</div>";
            }
  ?>
  <form action="contact.php" method="post">
    <div>
    <table style="font-size: 12px; font-weight: bold;">
      <tr>
        <td><a>Name:</a></td>
        <td><input type="text" name="author" value="" /></td>
      </tr>
      <tr>
        <td><a>Company:</a></td>
        <td><input type="text" maxlength="30"size="30" name="subject" value="" /></td>
      </tr>
      <tr>
        <td><a>Email ID:</a></td>
        <td><input type="email" maxlength="50"  size="35" name="email" value="" /></td>
      </tr>
      <tr>
        <td><a>Message:</a></td>
        <td><textarea name="body" cols="32" rows="8"></textarea></td>
      </tr>
    </table>
    </div>
    <div style="margin: 5px;">
        <input type="submit" name="submit" value="Send" class="register"  /></td>
    </div>
  </form>
  </div>
  <div class="clear"></div>
</div>        
<div class="clear"></div>
</div>
        
<?php include_layout_template("footer.php");?>

