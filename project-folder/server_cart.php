<!DOCTYPE html>
<html>
<head>
    <title>Sell or Buy</title>
</head>
<style>
.page_title, .slogan {
    font-size: 7;
}
p {
 text-align:center
}
ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
  overflow: hidden;
  background-color: #333;
}
li {
  float: left;
}
li a {
  display: block;
  color: white;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
}
li b{
  display: block;
  color: white;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
}
li a:hover {
  background-color: #111;
}
</style>
<body>
    <ul>
    <li><a class="active" href="index.php">Home</a></li>
    <li><a href="selleraccount.php">Seller Account</a></li>
    <li><a href="cart.html">Cart</a></li>
    <li><a href="existing_orders.html">Orders</a></li>
    <li><a href="delivery_driver.html">Driver Account</a></li>
    <li><a href="account.html">User Account</a></li>
    </ul>
    <h1>
    <p class="page_title">Cart</p>
    </h1>
    <?php
    $host = "35.192.209.221";
    $user = "root";
    $password = "1234";
    $dbname = "sob";
    $conn = mysqli_connect($host, $user, $password, $dbname);
    if(!$conn) {
        die ('Could not connect to the database server' . mysqli_connect_error());
    }
    include 'serverlogin.php'
    $cart_user_id = $user_id;
    $get_cart = "select p.product_name, c.quantity, p.price, c.cart
                from cart c join product p on c.product_id = p.product_id
                where c.user_id = '$cart_user_id '";
    $query = mysqli_query($conn, $get_cart);
    while($row = mysqli_fetch_array($query)) {
      $product_name = $row['product_name'];
      $quantity = $row['quantity'];
      $price = $row['price'];
      $product_id = $row['product_id']
      echo "<div class='product_box'>
          <div class='top_prod_box'>
          <div class='center_prod_box'>
            <div class='product_name'>$product_name</div>
            <div class='quantity'>$quantity</div>
            <div class='price'>$price</div>
            <form class='register-form' action='server_cart.php' method='POST'>
            <button type='submit' name='product_id' value = '<?php '$product_id' ?>'>Delete Product</button>
            </form>
          </div>
          </div>
          </div>";
          //delete button query
          $delete = "delete from cart where user_id = $cart_user_id  and product_id = '$product_id'";
          if(isset($_POST['product_id'])) {
            $delete_query = mysqli_query($conn, $delete);
          }
    }
    //order button
    echo "<form class='register-form' action=server_orders.php' method='POST'>
    <button type='submit' name='order_button' value = '<?php '$product_id' ?>'>Delete Product</button>
    </form>"
    $date = new DateTime($input_date);
    $dateDelivery = $date->modify('+14 day');
    $order = "insert into orders(user_id, order_date, order_status, schduled_delivery)
              values('$cart_user_id ', '$date', 'not delivered', '$dateDelivery')"
    //Order button inserts products into order_products and deletes all products in the cart
    if(isset($_POST['order_button'])) {
      $order_query = mysqli_query($conn, $order);
      $display_cart_products = "select * from cart";
      while($rows = mysqli_fetch_array($display_cart_products)) {
        $order_products_user_id = $rows['user_id'];
        $order_products_product_id $rows['product_id'];
        $order_products_quantity = $rows['quantity'];
        $insert_order_products = "insert into order_products(user_id, product_id, quantity)
                                  values ('$order_products_user_id', '$order_products_product_id', '$order_products_quantity')";
        $insert_order_products_query = mysqli_query($conn,$insert_order_products);
      }
      $delete_cart = "delete from cart where user_id = '$cart_user_id '";
      $delete_cart_query = mysqli_query($conn,$delete_cart_query);
    }
    ?>
</body>
<script src='https://code.jquery.com/jquery-3.4.1.min.js'></script>
<script>
  $(.product_box).on("click", function() {
    $(".pop-overlay, .popup-content").addClass("active");
  });
  $(".close, .pop-overlay").on("click", function() {
    $(.popup-overlay, .popup-content).removeClass("active");
  })
</script>
<style>
  .popup-overlay {
    visibility: hidden;
    position: absolute;
    background: #ffffff;
    border: 3px solid #666666;
    width: 50%;
    height: 50%;
    left: 25%;
  }
  .popup-content {
    visibility: hidden;
  }
  .popup-content.active {
    visibility: visible;
  }
  button {
    display: inline-block;
    vertical-align: middle;
    border-radius: 30px;
    margin: 0.20rem;
    font-size: 1rem;
    color: #666666;
    background: #ffffff;
    border: 1px solid #666666;
  }
  button:hover {
    border: 1px solid #666666;
    background: #666666;
    color: #ffffff;
  }
</style>
</html>