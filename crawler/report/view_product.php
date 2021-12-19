<?php
include "header_product.php"; 
?>
<body>
  <br>
  <br>
<table id="dt_basic" class="table table-striped table-bordered table-hover" width="100%">
                  <thead>
                    <tr>
                      <th width="25px">No#</th>
                      <th width="650px" data-hide="phone,tablet" style="text-align:center"><i class="txt-color-blue hidden-md hidden-sm hidden-xs"></i>Product Title</th>  
                      <th width="125px" data-hide="phone,tablet" style="text-align:center"><i class="txt-color-blue hidden-md hidden-sm hidden-xs"></i>Category</th>
                      <th width="125px" data-hide="phone,tablet" style="text-align:center"><i class="txt-color-blue hidden-md hidden-sm hidden-xs"></i>Price (RM)</th>
                      <th width="125px" data-hide="phone,tablet" style="text-align:center"><i class="txt-color-blue hidden-md hidden-sm hidden-xs"></i>Rating</th>
                      <th width="125px" data-hide="phone,tablet" style="text-align:center"><i class="txt-color-blue hidden-md hidden-sm hidden-xs"></i>Sold Qty</th>
                    </tr>
                  </thead>
  <tbody>
    <?php

    $n = 0;

    if (isset($_GET['category'])) {

        $qryRow = tep_query("SELECT * FROM crawler_shopee_product WHERE category='" . urldecode($_GET['category']) . "' ORDER BY sold DESC LIMIT 100");

    while($infoRow = tep_fetch_object($qryRow)){

        $ranking = $infoRow->ranking; 
        $name = $infoRow->name;
        $category = $infoRow->category; 
        $price = $infoRow->price; 
        $url = $infoRow->url; 
        $rating = $infoRow->rating; 
        $sold = $infoRow->sold; 

        echo "<tr>
          <td style='text-align:left'>$ranking</td>
          <td style='text-align:left'><a href='$url' target='_blank' style='color: #663399; text-decoration: none;'>$name</a></td>
          <td style='text-align:center'>$category</td>
          <td style='text-align:right'>". number_format((float)$price, 2, '.', '') . "</td>
          <td style='text-align:center'>$rating</td>
          <td style='text-align:center'>$sold</td>
          </tr>"; 
      }
    }
    
    ?>
  </tbody>
</table>
</body>

<script>
$(document).ready( function () {
    $('#dt_basic').DataTable();
} );
</script>

