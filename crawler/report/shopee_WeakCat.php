<?php
include "header_category.php"; 
?>
<body>
  <table id="dt_basic" class="table table-striped table-bordered table-hover" width="100%">
                  <thead>
                    <tr>
                      <th width="25px">No#</th> 
                      <th width="*" data-hide="phone,tablet" style="text-align:left"><i class="txt-color-blue hidden-md hidden-sm hidden-xs"></i>Category</th>
                      <th width="200px" data-hide="phone,tablet" style="text-align:center"><i class="txt-color-blue hidden-md hidden-sm hidden-xs"></i>Total Sold</th>        
                      <th width="200px" data-hide="phone,tablet" style="text-align:center"><i class="txt-color-blue hidden-md hidden-sm hidden-xs"></i>Total Products</th>
                    </tr>
                  </thead>
  <tbody>
    <?php
      $n = 0;
      $qryRow = tep_query("SELECT SUM(sold) AS total, COUNT(name) AS totalprod, category FROM crawler_shopee_product GROUP BY category ORDER BY total ASC LIMIT 50"); 

      while($infoRow = tep_fetch_object($qryRow)){

          $category = $infoRow->category; 
          $sold = $infoRow->total; 
          $total_product = $infoRow->totalprod; 

          echo "<tr>
          <td>" . (++$n) . "</td>
          <td style='text-align:left'><a href=\"view_product.php?category=".urlencode($category). "\" target='_blank' style='color: #663399; text-decoration: none;'>$category</a></td>
          <td style='text-align:center'>$sold</td>
          <td style='text-align:center'>$total_product</td>
          </tr>"; 

      }
    
    ?>
  </tbody>
</table>
</body>

