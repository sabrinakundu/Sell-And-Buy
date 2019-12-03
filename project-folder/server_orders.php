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
    <li><a href="index.php">Home</a></li>
    <li><a href="selleraccount.php">Seller Account</a></li>
    <li><a href="cart.html">Cart</a></li>
    <li><a class="active" href="existing_orders.html">Orders</a></li>
    <li><a href="delivery_driver.html">Driver Account</a></li>
    <li><a href="account.html">User Account</a></li>
    </ul>
    <h1>
    <p class="page_title">Existing Orders</p>
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

    $user_id =
    $get_orders = "Select * from orders where user_id = '$user_id'";

    $query = mysqli_query($conn, $get_orders);
    //displays all orders
    while($row = mysqli_fetch_array($query)) {
      $order_id = $row['order_id'];
      $order_date = $row['order_date'];
      $order_status = $row['order_status'];
      $schduled_delivery = $row['schduled_delivery'];
      $products_of_order = "Select product.product_name, order_products.quantity
                                from product join order_products on product.product_id = product.product_id
                                where order_products.order_id = '$order_id'";
      $products_of_order_query = mysqli_query($conn,$products_of_order);
      //displays all products affilated to a given order
      while($row = mysqli_fetch_array($products_of_order_query)){
        $product_name = $row['product_name'];
        $quantity = $row['quantity'];
        echo "<div class='product_box'>
            <div class='top_prod_box'>
            <div class='center_prod_box'>
              <div class='product_name'>$product_name</div>
              <div class='quantity'>$quantity</div>
            </div>
            </div>
            </div>"
      }
      echo "<div class='product_box'>
          <div class='top_prod_box'>
          <div class='center_prod_box'>
            <div class='order_id'>$order_id</div>
            <div class='order_date'>$order_date</div>
            <div class='order_status'>$order_status</div>
            <div class='schduled_delivery'>$schduled_delivery</div>
          </div>
          </div>
          </div>"

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
