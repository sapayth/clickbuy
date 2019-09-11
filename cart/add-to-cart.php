<?php session_start();
	if(isset($_POST["foodId"])) {
		$id = $_POST["foodId"];
		$name = $_POST["foodName"];
		$price = $_POST["foodPrice"];

		$qty = 1;
		$subtotal = 0;

		// unset($_SESSION["food_cart"]);
		if(!isset($_SESSION["food_cart"])) {
			$_SESSION["food_cart"] = array();
		}
		
		if(array_key_exists($id, $_SESSION['food_cart'])) {
			$_SESSION["food_cart"][$id]["qty"] += $qty;
		} else {
			$_SESSION["food_cart"][$id]["id"] = $id;
			$_SESSION["food_cart"][$id]["name"] = $name;
			$_SESSION["food_cart"][$id]["price"] = $price;
			$_SESSION["food_cart"][$id]["qty"] = $qty;
		}

		// echo "<pre>";
		// print_r($_SESSION["food_cart"]);
		// echo "</pre>";

		$htmls = "<h3>Your cart</h3>
				<form method='post' action='#'>
				    <ul id='food-cart-items'>";

		// echo "<h3>Your cart</h3>
		// 		<form method='post' action='#'>
		// 		    <ul id='food-cart-items'>";

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
		// echo "<li class='single-cart-item'>
	 //        <div class='cart-item-name'>
	 //        	<p>$name</p>
	 //        </div>
	 //        <div class='cart-item-quantity'>
	 //        	<input type='text' value='1' />
	 //        </div>
	 //        <div class='cart-item-remove'>
	 //        	<button type='button'>×</button>
	 //        </div>
	 //        <div class='cart-item-price'>
	 //        	<p>$$price</p>
	 //        </div>
	 //    </li>";
	}
?>