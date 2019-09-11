<?php session_start();
	$subtotal = 0;
	$cart = array();

	foreach ($_SESSION["food_cart"] as $single_item) {
		$total = $single_item["qty"] * $single_item["price"];
		$subtotal += $total;
		$food = array( "id" => $single_item["id"], "name" => $single_item["name"], "qty" => $single_item["qty"], "total" => $total );

	    array_push($cart, $food);
	}
	echo json_encode(
		array(
			'cart' => $cart,
			'subtotal' => $subtotal
		)
	);
?>