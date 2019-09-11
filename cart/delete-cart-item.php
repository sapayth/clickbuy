<?php session_start();
	if(isset($_POST["foodId"])) {
		$id = $_POST["foodId"];
		unset($_SESSION["food_cart"][$id]);

		$cart = array();
		$subtotal = 0;
		foreach ($_SESSION["food_cart"] as $single_item) {
			$total = $single_item["qty"] * $single_item["price"];
			$subtotal += $total;
			$food = array( "id" => $single_item["id"], "name" => $single_item["name"], "qty" => $single_item["qty"], "total" => $total );

		    array_push($cart, $food);
		}
		// echo "<pre>";
		// print_r($cart);
		// echo "</pre>";
		echo json_encode(
			array(
				'cart' => $cart,
				'subtotal' => $subtotal
			)
		);
	}
?>