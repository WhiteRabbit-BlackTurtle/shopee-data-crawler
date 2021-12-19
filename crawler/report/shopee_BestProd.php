<?php
include "header_product.php"; 
?>

<body>

<div class="card-body">
<form action="" method="GET">
    <div class="row">
        <div class="col-md-4">
            <label for="">Min Price</label>
            <input type="text" name="start_price" value="<?php if(isset($_GET['start_price'])){echo $_GET['start_price']; }else{echo "10";} ?>" class="form-control">
        </div>
        <div class="col-md-4">
            <label for="">Max Price</label>
            <input type="text" name="end_price" value="<?php if(isset($_GET['end_price'])){echo $_GET['end_price']; }else{echo "900";} ?>" class="form-control">
        </div>
        <div class="col-md-4">
            <button type="submit" class="btn btn-primary px-4" style="margin-top: 33px;">Filter</button>
        </div>
    </div>
</form>
</div>

  <table id="dt_basic" class="table table-striped table-bordered table-hover" width="100%">
                  <thead>
                    <tr>
                      <th width="25px">Ranking#</th>
                      <th width="650px" data-hide="phone,tablet" style="text-align:center"><i class="txt-color-blue hidden-md hidden-sm hidden-xs"></i>Product Title</th>  
                      <th width="125px" data-hide="phone,tablet" style="text-align:center"><i class="txt-color-blue hidden-md hidden-sm hidden-xs"></i>Category</th>
                      <th width="125px" data-hide="phone,tablet" style="text-align:center"><i class="txt-color-blue hidden-md hidden-sm hidden-xs"></i>Price (RM)</th>
                      <th width="125px" data-hide="phone,tablet" style="text-align:center"><i class="txt-color-blue hidden-md hidden-sm hidden-xs"></i>Rating</th>
                      <th width="125px" data-hide="phone,tablet" style="text-align:center"><i class="txt-color-blue hidden-md hidden-sm hidden-xs"></i>Sold Qty</th>
                    </tr>
                  </thead>
  <tbody>
    <?php
    if(isset($_GET['start_price']) && isset($_GET['end_price']))
    {
        // $n = 0;
        $startprice = $_GET['start_price'];
        $endprice = $_GET['end_price'];
        
        $query = tep_query("SELECT * FROM crawler_shopee_product WHERE price BETWEEN '$startprice' AND '$endprice'");

        while($infoRow2 = tep_fetch_object($query)){

          $ranking = $infoRow2->ranking; 
          $name = $infoRow2->name;
          $category = $infoRow2->category; 
          $price = $infoRow2->price; 
          $url = $infoRow2->url; 
          $rating = $infoRow2->rating; 
          $sold = $infoRow2->sold; 

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
    else{
      // $n = 0;
      $qryRow = tep_query("SELECT *, MAX(sold) AS SoldQty FROM crawler_shopee_product GROUP BY name ORDER BY SoldQty DESC LIMIT 100"); 

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
