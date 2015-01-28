<?php require_once("includes".DIRECTORY_SEPARATOR."initialize.php");

	$pro = null;
	$cate = null;
    if(!empty($_GET['cate'])){
	
    $pro = Photograph::find_were_cate($_GET['cate']);
    
    if(!$pro) {
    $cate = Category::find_by_id($_GET['cate']);
    $message = "No Product located in <img src=\"images/bullet2.gif\" alt=\"\" title=\"\" />{$cate->category_name} Category.";
    
    }elseif($pro){
    $cate = Category::find_by_id($_GET['cate']);
    $all_pro = $cate->all_pro_cate();
    
   	// 1. the current page number ($current_page)
	$page = !empty($_GET['page']) ? (int)$_GET['page'] : 1;

	// 2. records per page ($per_page)
	$per_page = 9;

	// 3. total record count ($total_count)
	$total_count = count($all_pro);
	

	// Find all photos
	// use pagination instead
	//$photos = Photograph::find_all();
	
	$pagination = new Pagination($page, $per_page, $total_count-1);
	
	// Instead of finding all records, just find the records 
	// for this page
	$sql = "SELECT * FROM photographs ";
    $sql .= "WHERE category_id = {$cate->id} ";
	$sql .= "LIMIT {$per_page} ";
	$sql .= "OFFSET {$pagination->offset()} ";
    
	$per_pag_cate_p = Photograph::find_by_sql($sql);
	}
    }

include_layout_template("header.php");
?>
<div class="left_content">
 <div class="crumb_nav">
            <a href="index.php">Home</a> &gt;&gt; Categories
            </div>
           <?php 
            echo "<div class=\"title\"><span class=\"title_icon\"><img src=\"images/bullet5.gif\" alt=\"\" title=\"\" /></span>Categories</div>";
            echo "<div class=\"clear\"></div>";
           if(!$pro){ echo "<ul class=\"list\"><br/><a>".output_message($message)."</a></ul>";}?>
           <?php
           if(!empty($per_pag_cate_p))
           {
            echo "<div class=\"feat_prod_box\"></div>";
            echo "<div class=\"title\"><span class=\"title_icon\"><img src=\"images/bullet1.gif\" alt=\"\" title=\"\" /></span>{$cate->category_name}</div>";
            echo "<div class=\"new_products\">"; 
                    foreach($per_pag_cate_p as $pro){
                    echo "<div class=\"new_prod_box\">";
                    echo "<a href=\"more.php?pr={$pro->id}&&tb1=1\">{$pro->caption}</a>";
                    echo "<div class=\"new_prod_bg\">";
                    $ps = strtotime($pro->inserted);
                    $previous_week = strtotime("last week"); 
                            if($previous_week <= $ps){
                              echo "<span class=\"new_icon\"><img src=\"images/new_icon.gif\"/></span>";
                              }
                    echo "<a href=\"more.php?pr={$pro->id}&&tb1=1\"><img src=".$pro->image_path()." height=\"90\" width=\"110\" class=\"thumb\" border=\"0\" /></a>";
                    echo "</div>";           
                    echo "</div>"; 
                    }
             echo "</div>";
            }
            elseif(empty($_GET['cate']))
            {
              $all_cate=Category::find_all();
              echo "<p class=\"list\" style=\"color: #7CA253; font-weight: bold\">Following is the complete Category List.</p>";
              foreach($all_cate as $all){
                
                    echo "<div class=\"feat_prod_box\"></div>";
                    echo "<div class=\"title\"><span class=\"title_icon\"><img src=\"images/bullet2.gif\" alt=\"\" title=\"\" /></span>{$all->category_name}</div>";
                    echo "<div class=\"new_products\">"; 
                    
                    $per_pag_cate_p = Photograph::find_were_cate($all->id);
                    if(empty($per_pag_cate_p)){
                        echo "<ul class=\"list\" style=\"color: #7CA253; font-weight: bold\"><br/>No Product located in {$all->category_name} Category.</ul>";
                    }else{
                        foreach($per_pag_cate_p as $all_pro){
                            echo "<div class=\"new_prod_box\">";
                            echo "<a href=\"more.php?pr={$all_pro->id}&&tb1=1\">{$all_pro->caption}</a>";
                            echo "<div class=\"new_prod_bg\">";
                            $ps = strtotime($all_pro->inserted);
                            $previous_week = strtotime("last week"); 
                            if($previous_week <= $ps){
                                    echo "<span class=\"new_icon\"><img src=\"images/new_icon.gif\"/></span>";
                              }
                        echo "<a href=\"more.php?pr={$all_pro->id}&&tb1=1\"><img src=".$all_pro->image_path()." height=\"90\" width=\"110\" class=\"thumb\" border=\"0\" /></a>";
                        echo "</div>";           
                        echo "</div>"; 
                            }
                        }
                    echo "<div class=\"clear\"></div>";
                    echo "</div>";
              }
            }
            ?>
             
             
<div class="pagination">   
<?php
	if($pro){
	   if($pagination->total_pages() > 1) {
		
		if($pagination->has_previous_page()) { 
    	echo "<a href=\"categories.php?cate={$cate->id}&&page=";
      echo $pagination->previous_page();
      echo "\">&laquo; Previous</a> "; 
    }
  
		for($i=1; $i <= $pagination->total_pages(); $i++) {
			if($i == $page) {
				echo " <span class=\"current\">{$i}</span> ";
			} else {
				echo " <a href=\"categories.php?cate={$cate->id}&&page={$i}\">{$i}</a> "; 
			}
		}

		if($pagination->has_next_page()) { 
			echo " <a href=\"categories.php?cate={$cate->id}&&page=";
			echo $pagination->next_page();
			echo "\">Next &raquo;</a> "; 
    }
		
	}
    }

?>
</div>  
<div class="clear"></div>
</div>
<?php include_layout_template("footer.php");?>
