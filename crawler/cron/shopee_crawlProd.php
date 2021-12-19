<meta name="robots" content="noindex,nofollow">
<?php
  require_once('config.php');
  require_once('selector.inc');
  
  set_time_limit(0);

	function curl($url){
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		return curl_exec($ch);
	}
	  
		$logCode = date("Y-m-d H:i:s");
			$query3 = "INSERT INTO crawler_log(log_start) VALUES ('".$logCode."')";
			tep_query($query3);

	$units = 0; 
	$no = 1;

	$qryRow = tep_query("SELECT * FROM crawler_shopee_category"); 
	
	while ($infoRow = tep_fetch_object($qryRow)){

		$v = $infoRow->catid; 
		$k = $infoRow->category; 

				$daily = curl("https://shopee.com.my/api/v4/search/search_items?by=relevancy&limit=100&match_id=".$v."&newest=0&order=desc&page_type=search&scenario=PAGE_OTHERS&version=2");
				$items = json_decode($daily, true);
				
				// echo "<pre>". print_r($items, true) ."</pre>"; 
				// echo ("https://shopee.com.my/api/v4/search/search_items?by=relevancy&limit=10&match_id=".$v). "<br><br>"; 	 

				foreach($items['items'] as $item){ 

					$itemID = $item['item_basic']['itemid']; 
					$name =  $item['item_basic']['name']; 
					$image = "https://cf.shopee.com.my/file/".$item['item_basic']['image']; 
					$category = $k; 
					$price = number_format(substr_replace($item['item_basic']['price'],".",-5,0), 2); 
					$url = addslashes("https://shopee.com.my/" . str_replace(" ", "-", $item['item_basic']['name']) . "-i." . $item['item_basic']['shopid'] . "." . $item['item_basic']['itemid']); 
					$rating = $item['item_basic']['item_rating']['rating_star']; 
					$sold = $item['item_basic']['sold'];

					// echo $no++ . "<br>"; 
					// echo "Item ID: ". $itemID . "<br>"; 
					// echo "Product Name: ". $name . "<br>"; 
					// echo "Image: ". $image . "<br>";
					// echo "Category: ". $category . "<br>";
					// echo "Price: Rm". $price . "<br>"; 
					// echo "URL: ". $url . "<br>";
					// echo "Product Rating: ". $rating. "<br>"; 
					// echo "Sold Qty: ". $sold . "<br><br>"; 

					$checkprod = tep_query("SELECT * FROM `crawler_shopee_product` WHERE `itemid` = '$itemID' AND `category` = '$category'");

					if (tep_num_rows($checkprod) == 0) {
						$query = "INSERT INTO `crawler_shopee_product` (`itemid`, `name`, `photo`, `category`, `price`, `url`, `rating`, `sold`) VALUES ('".$itemID."', '".$name."', '".$image."', '".$category."', '".$price."', '".$url."', '".$rating."', '".$sold."')";
					}
					else{
						$query = "UPDATE `crawler_shopee_product` SET `name`='$name', `photo`='$image', `price`='$price', `url`='$url', `rating`='$rating', `sold`='$sold', `modify_datetime` = NOW() WHERE `itemid` = '".$itemID."' AND category = '".$category."'"; 
					}

					if(tep_query($query)) $units++;
				}
	}

	$query3 = "UPDATE crawler_log SET log_end = NOW(), log_type = 'SHP_P', log_unit = ".$units." WHERE log_start = '".$logCode."'";
	tep_query($query3);

	echo "END OF THE CODE";	

	$rank = 0; 
	$qryProd = tep_query("SELECT * FROM crawler_shopee_product GROUP BY name ORDER BY sold DESC"); 

	while ($infoProd = tep_fetch_object($qryProd)){

		$rank++; 
		tep_query("UPDATE `crawler_shopee_product` SET `ranking`= '$rank' WHERE `id` = '".$infoProd->id. "'"); 
	}

?>    

