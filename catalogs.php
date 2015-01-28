<?php require_once("includes".DIRECTORY_SEPARATOR."initialize.php");
	$pro = null;
    if(isset($_GET['cata'])){
	
    $pro = catalog::find_by_id($_GET['cata']);
    
        if(!empty($pro)) {
            $cata = catalog::find_by_id($_GET['cata']);
			if(!empty($cata)){
				$pro_in_cata=ProCatalog::cata_qry_database($_GET['cata']);
			}else{
				$message = "No Product located in <img src=\"images/bullet2.gif\" alt=\"\" title=\"\" />{$cata->catalog_name} Catalog."; 
			}
        }
    }
    elseif(!isset($_GET['cata'])){
        $all_pro_in_cata = ProCatalog::all_cata_qry_database();
    }
include_layout_template("header.php");
?>
<div class="left_content">
 <div class="crumb_nav">
            <a href="index.php">Home</a> &gt;&gt; Catalog's
            </div>
           <?php 
            echo "<div class=\"title\"><span class=\"title_icon\"><img src=\"images/bullet6.gif\" alt=\"\" title=\"\" /></span>Catalog's</div>";
            echo "<div class=\"clear\"></div>";
           if(!$pro){ echo "<ul class=\"list\"><br/><a>".output_message($message)."</a></ul>";}?>
           <?php
           if(!empty($pro_in_cata))
           {
            echo "<div class=\"feat_prod_box\"></div>";
            echo "<div class=\"title\"><span class=\"title_icon\"><img src=\"images/bullet2.gif\" alt=\"\" title=\"\" /></span>{$cata->catalog_name}</div>";
                        echo "<ul class=\"list\" style=\"color: #788C8F; font-weight: bold\"><img src=\"images/bullet4.gif\" width =\"11px\"> Description : <br/>";
                        echo "<p style=\"text-indent: 20px;\">{$pro->catalog_des}</p>";
                        echo "</ul>";
            echo "<div class=\"new_products\">"; 
                    while($pro_in = mysql_fetch_array($pro_in_cata)){
                    echo "<div class=\"new_prod_box\">";
                    echo "<a href=\"more.php?pr={$pro_in['pro_id']}&&tb1=1\">{$pro_in['caption']}</a>";
                    echo "<div class=\"new_prod_bg\">";
                    $ps = strtotime($pro_in['inserted']);
                    $previous_week = strtotime("last week"); 
                            if($previous_week <= $ps){
                              echo "<span class=\"new_icon\"><img src=\"images/new_icon.gif\"/></span>";
                              }
                    echo "<a href=\"more.php?pr={$pro_in['pro_id']}&&tb1=1\"><img src=".image_loc($pro_in['filename'])." height=\"90\" width=\"110\" class=\"thumb\" border=\"0\" /></a>";
                    echo "</div>";           
                    echo "</div>"; 
                    }
             echo "</div>";
            }
            elseif($all_pro_in_cata)
            {
              $current;
              $get_all_cata = Catalog::find_all();
              echo "<p class=\"list\" style=\"color: #7CA253; font-weight: bold\">Following is the complete Catalog List.</p>";
              echo "<div class=\"feat_prod_box\"></div>";
              echo "<div class=\"new_products\">";
              while($all=mysql_fetch_array($all_pro_in_cata)){
                    if(isset($current) && $current!=$all['catalog_name']){
                        $current = $all['catalog_name'];
                        echo "<div class=\"feat_prod_box\"></div>";
                        echo "<div class=\"clear\"></div>"; 
                        echo "<div class=\"title\"><span class=\"title_icon\"><img src=\"images/bullet2.gif\" alt=\"\" title=\"\" /></span>{$current}</div>";
                        echo "<ul class=\"list\" style=\"color: #788C8F; font-weight: bold\"><img src=\"images/bullet4.gif\" width =\"11px\"> Description : <br/>";
                        echo "<p style=\"text-indent: 20px;\">{$all['catalog_des']}</p>";
                        echo "</ul>";
                    }
                    elseif(!isset($current)){
                        $current = $all['catalog_name'];
                        echo "<div class=\"clear\"></div>";
                        echo "<div class=\"title\"><span class=\"title_icon\"><img src=\"images/bullet2.gif\" alt=\"\" title=\"\" /></span>{$current}</div>";
                        echo "<ul class=\"list\" style=\"color: #788C8F; font-weight: bold\"><img src=\"images/bullet4.gif\" width =\"11px\"> Description : <br/>";
                        echo "<p style=\"text-indent: 20px;\">{$all['catalog_des']}</p>";
                        echo "</ul>";                    
                    } 
                    if(empty($all)){
                        echo "<ul class=\"list\" style=\"color: #7CA253; font-weight: bold\"><br/>No Product located in {$all['catalog_name']} Catalog.</ul>";
                    }else{
                            echo "<div class=\"new_prod_box\">";
                            echo "<a href=\"more.php?pr={$all['pro_id']}&&tb1=1\">{$all['caption']}</a>";
                            echo "<div class=\"new_prod_bg\">";
                            $ps = strtotime($all['inserted']);
                            $previous_week = strtotime("last week"); 
                            if($previous_week <= $ps){
                                    echo "<span class=\"new_icon\"><img src=\"images/new_icon.gif\"/></span>";
                              }
                        echo "<a href=\"more.php?pr={$all['pro_id']}&&tb1=1\"><img src=".image_loc($all['filename'])." height=\"90\" width=\"110\" class=\"thumb\" border=\"0\" /></a>";
                        echo "</div>";       
                        echo "</div>"; 
                        }
              }
              echo "<div class=\"clear\"></div>";
              echo "</div>"; 
            }
            elseif(!$pro_in_cata){
                        echo "<ul class=\"list\" style=\"font-weight: bold ;\"><br/><a> No Product located in <img src=\"images/bullet2.gif\"/>{$cata->catalog_name} Catalog.</a></ul>";
               }
            ?> 
<div class="clear"></div>
</div>
<?php include_layout_template("footer.php");?>
