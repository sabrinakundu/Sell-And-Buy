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

table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
</style>
<body>
    <ul>
      <li><a href="index.php">Home</a></li>
      <li><a href="selleraccount.php">Seller Account</a></li>
      <li><a href="server_cart.php">Cart</a></li>
      <li><a href="server_orders.php">Orders</a></li>
      <li><a href="server_delivery_orders.php">Driver Account</a></li>
      <li><a href="account.php">User Account</a></li>
    </ul>
    <h1>
    <p class="page_title">Shop</p>
    </h1>


    <p class="slogan">Featured Items</p>
    <div class="popup-overlay">
      <div class="popup-content">
        <h2>Pop-up</h2>
        <p>This is it.</p>
        <button class="addtocart">Add to Cart</button>
        <button class="close">Close</button>
      </div>
    </div>
    <table align='center'>

      <th>Product Name</th>
      <th>Price</th>
      <th>Condition</th>
      <th>Quantity</th>


    <?php
    $host = "35.192.209.221";
    $user = "root";
    $password = "1234";
    $dbname = "sob";

    $conn = mysqli_connect($host, $user, $password, $dbname);
    if(!$conn) {
        die ('Could not connect to the database server' . mysqli_connect_error());
    }

    $get_products = "Select * from product order by RAND() LIMIT 0,6";
    $query = mysqli_query($conn, $get_products);
    while($row = mysqli_fetch_array($query)) {
      $name = $row['product_name'];
      $price = $row['price'];
      $conditions = $row['conditions'];
      $quantity = $row['quantity'];
      $g_product_id = $row['product_id'];
      echo "

          <tr>
            <td class='product_title'>$name</td>
            <td class='product_price'>$$price</td>
            <td class='product_conditions'>$conditions</td>
            <td class='product_quantity'>$quantity</td>
            <input name='title' style='display:none;' value='<?php $name ?>' disabled/>
            <input name='price' style='display:none;' value='<?php $price ?>' disabled/>
            <input name='conditions' style='display:none;' value='<?php $conditions ?>' disabled/>
            <input name='quantity' style='display:none;' value='<?php $quantity ?>' disabled/>
            <td><button name='addToCart'>Click to add to cart</button></td>";
            if(isset($_POST['addToCart'])) {
              $get_name = mysqli_real_escape_string($conn, $_POST['title']);
              $get_price = mysqli_real_escape_string($conn, $_POST['price']);
              $get_conditions = mysqli_real_escape_string($conn, $_POST['conditions']);
              $get_quantity = mysqli_real_escape_string($conn, $_POST['quantity']);
              $sql_insert = 'insert into cart (user_id, product_id, quantity) values ($get_name, $get_price, $get_conditions, $get_quantity)';
              if(mysqli_query($conn, $sql_insert)) {
                echo 'Added to Cart';
                header('Location: server_cart.php');
              } else {
                echo 'Error: ' . $sql_insert . '<br>' . mysqli_error($conn);
              }
            }
            echo "<tr>";

    }
    ?>
  </table>
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
