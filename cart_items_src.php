<?php 
	require_once('admin/private/init.php');

	$eventCategoryId = $cartItemsStr = "";
	$cartItemsArray = $allSubCategory = $respArray = array();
	if((isset($_POST['cartItemsArray'])) && (!empty($_POST['cartItemsArray']))){
		$cartItemsArray = $_POST['cartItemsArray'];
	}

	if((isset($_POST["eventCategory"])) && (!empty($_POST["eventCategory"]))) {
		$eventCategoryId = explode(",",$_POST["eventCategory"]);
	}

	if(!empty($cartItemsArray)){
		$cartItemsStr = implode(",",$cartItemsArray);
	}

	$eventSubCategory = new Event_SubCategory();

	if(Helper::is_post()) {
		if(!empty($cartItemsStr)) {
			$allSubCategory = (array) $eventSubCategory->whereIn(["id" => $cartItemsStr])->all();
		}        
	}

	$price = 0;
	$subTotal = 0;
	$quantity = 0;
	$respArray = array();
	if(!empty($allSubCategory)) {
		foreach($allSubCategory as $allSubCategoryVal) {
			$price = $allSubCategoryVal->price;
			$quantity = 1;
			$subTotal += $price * $quantity;
		}
	}

	$respArray['subTotal'] = $subTotal; 

	/*$respArray['productId'] = $allSubCategoryVal->id;
	$respArray['productName'] = $allSubCategoryVal->title;
	$respArray['productPrice'] = $allSubCategoryVal->price;
	$respArray['productImage'] = $allSubCategoryVal->image_name;*/

	//$respStr = '<span>₹ '.$subTotal.'</span>';
	//$respStr .= '<input type="text" id="subtotal" value="'.$subTotal.'" />';

	echo json_encode($respArray);
	exit;
?>