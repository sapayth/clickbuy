<!-- <aside id="food-cart-sidebar">
	<h3>Your cart</h3>
		<form method='post' action='#'>
		    <ul id='food-cart-items'>
		    	<li class='single-cart-item'>
			        <div class='cart-item-name'>
			        	<p id="item-name"></p>
			        </div>
			        <div class='cart-item-quantity'>
			        	<input id="item-qty" type='text' value='' />
			        </div>
			        <div class='cart-item-remove'>
			        	<input type='hidden' name='hdnCartItemId' value='' />
			        	<button name='btnRemove' class='btnRemove' type='button' data-id=''>×</button>
			        </div>
			        <div class='cart-item-price'>
			        	<p id="item-total"></p>
			        </div>
			    </li>
	    	</ul>
		    <div id='food-cart-footer' class='food-cart-footer'></div>
	  </form>
</aside> -->
<div class="cart">
  <a href="#" title="" id="label2" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
      <div class="photo photo-cart">
          <img src="img/cart.png" alt="images" class="img-reponsive">
          <span class="lbl" id="cart-count"></span>
      </div>
      <p class="inform inform-cart">
          <span class="strong">CART<br></span>
          <span class="price-cart">$00</span>
      </p>
  </a>
  <div class="dropdown-menu dropdown-cart" id="food-cart-items" aria-labelledby="label2">
      <ul></ul>
      <div class="content-1" id="food-cart-footer"></div>
      <div class="content-2" id="food-cart-links">
          <a href="cart.php" class="viewcart">View Cart</a>
          <a href="checkout.php" class="addcart">Checkout</a>
      </div>
  </div>
</div> <!-- end cart -->


<script>
  // $("#food-cart-link").click(function(){
  //   $("#food-cart-sidebar").animate({
  //     width: "toggle"
  //   });
  // });

  

  

$(document).ready(function() {

  loadCart();

  $(".single-food-btn").click(function() {
    var foodId = $(this).data("id");
    var foodName = $(this).data("name");
    var foodPrice = $(this).data("price");

    $.ajax({
      type: "POST",
      dataType: "json",
      url: "cart/add-to-cart.php",
      data: {"foodId": foodId, "foodName": foodName, "foodPrice": foodPrice},
      success: function(response){
          $cart = response.cart;
          $subtotal = 0;
          $cartLength = 0;
          $("#food-cart-items").empty();
          $("#food-cart-footer").empty();
          // $("#food-cart-links").empty();
          for(i = 0; i < $cart.length; i++) {
            $subtotal += $cart[i].total;
            $cartLength += $cart[i].qty;

            largeHtml = '<li><div class="item-order">';
            largeHtml += '<div class="item-photo"><a href="#"><img src="img/cart1.png" alt="images" class="img-responsive"></a></div>';
            largeHtml += '<div class="item-content"><h3><a href="#" title=""> ' + $cart[i].name + ' </a></h3><p class="price black">$199.69</p><p class="quantity">x1</p></div></div>';
            largeHtml += '<div class="btn-delete btndel" data-id="' + $cart[i].id + '">x</div></li>';
            $("#food-cart-items").append(largeHtml);
          }
          $cartFooter = '<span class="total">Total: <strong class="price black">$' + $subtotal + '</strong></span>';
          $("#food-cart-footer").append($cartFooter);
          $("#total-cart-item").html($cartLength);
          $("#cart-count").html($cartLength);
      }
    });
  });


  function loadCart() {
    $.ajax({
        type: "POST",
        dataType: 'json',
        url: "cart/load-cart.php",
        success: function(response){
          $cart = response.cart;
          $subtotal = 0;
          $cartLength = 0;
          $("#food-cart-items").empty();
          $("#food-cart-footer").empty();
          $(".price-cart").empty();
          $("#cart-count").empty();
          for(i = 0; i < $cart.length; i++) {
            $subtotal += $cart[i].total;
            $cartLength += $cart[i].qty;

            largeHtml = '<li><div class="item-order">';
            largeHtml += '<div class="item-photo"><a href="#"><img src="img/cart1.png" alt="images" class="img-responsive"></a></div>';
            largeHtml += '<div class="item-content"><h3><a href="#" title=""> ' + $cart[i].name + ' </a></h3><p class="price black">$' + $cart[i].total + '</p><p class="quantity">x' + $cart[i].qty + '</p></div></div>';
            largeHtml += '<div class="btn-delete btndel" data-id="' + $cart[i].id + '">x</div></li>';
            $("#food-cart-items").append(largeHtml);
          }
          $cartFooter = '<span class="total">Total: <strong class="price black">$' + $subtotal + '</strong></span>';
          $("#food-cart-footer").append($cartFooter);
          $("#total-cart-item").html($cartLength);
          $("#cart-count").html($cartLength);
          $(".price-cart").html('$' + $subtotal);
        }
    });
  }


  $('#food-cart-items').on('click','.btndel',function(e){
    $id = $(this).data("id");
    $.ajax({
      type: "POST",
        dataType: "json",
      url: "cart/delete-cart-item.php",
      data: {"foodId": $id},
      success: function(response) {          
          $cart = response.cart;
          $subtotal = 0;
          $cartLength = 0;
          $("#food-cart-items").empty();
          $("#food-cart-footer").empty();
          $(".price-cart").empty();
          $("#cart-count").empty();
          for(i = 0; i < $cart.length; i++) {
            $subtotal += $cart[i].total;
            $cartLength += $cart[i].qty;
            largeHtml = '<li><div class="item-order">';
            largeHtml += '<div class="item-photo"><a href="#"><img src="img/cart1.png" alt="images" class="img-responsive"></a></div>';
            largeHtml += '<div class="item-content"><h3><a href="#" title=""> ' + $cart[i].name + ' </a></h3><p class="price black">$' + $cart[i].total + '</p><p class="quantity">x' + $cart[i].qty + '</p></div></div>';
            largeHtml += '<div class="btn-delete btndel" data-id="' + $cart[i].id + '">x</div></li>';
            $("#food-cart-items").append(largeHtml);
          }
          $cartFooter = '<span class="total">Total: <strong class="price black">$' + $subtotal + '</strong></span>';
          $("#food-cart-footer").append($cartFooter);
          $("#total-cart-item").html($cartLength);
          $("#cart-count").html($cartLength);
          $(".price-cart").html('$' + $subtotal);
      },
      error: function (jqXHR, exception) {
              var msg = '';
              if (jqXHR.status === 0) {
                  msg = 'Not connect.\n Verify Network.';
              } else if (jqXHR.status == 404) {
                  msg = 'Requested page not found. [404]';
              } else if (jqXHR.status == 500) {
                  msg = 'Internal Server Error [500].';
              } else if (exception === 'parsererror') {
                  msg = 'Uncaught Error.\n' + jqXHR.responseText;
              } else if (exception === 'timeout') {
                  msg = 'Time out error.';
              } else if (exception === 'abort') {
                  msg = 'Ajax request aborted.';
              } else {
                  msg = 'Uncaught Error.\n' + jqXHR.responseText;
              }
              // $('#output').html(msg);
          }
    });
  });


});

  

  
</script>