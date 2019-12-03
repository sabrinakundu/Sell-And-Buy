<?php
  include('account_page.php');
  if(isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];
  }
?>
<!DOCTYPE html>
<html>
<body>
  <!-- Nav Bar -->
  <ul>
    <li><b>Sell-Or-Buy</b></li>
    <li><a href="index.php">Home</a></li>
    <li><a href="selleraccount.php">Seller Account</a></li>
    <li><a href="server_cart.php">Cart</a></li>
    <li><a href="server_orders.php">Orders</a></li>
    <li><a href="server_delivery_orders.php">Driver Account</a></li>
    <li><a href="account.php">User Account</a></li>
  </ul>
  <!-- Nav Bar -->

<h2><p class="page_title">Your Accounts</p></h2>
<form class="register-form" action="account.php" method="POST">
  <?php include('errors.php'); ?>
  <input type="text" name="first_name" placeholder="First Name" />
  <input type="text" name="last_name" placeholder="Last Name" />
  <input type="text" name="email" placeholder="Email"/>
  <input type="text" name="password" placeholder="Password" />
  <input type="text" name="street" placeholder="Street"/>
  <input type="text" name="city" placeholder="City"/>
  <input type="text" name="state" placeholder="State" />
  <input type="text" name="zip" placeholder="Zip code"/>
  <input type="text" name="phone" placeholder="Phone number"/>
  <input type="text" name="credit_card" placeholder="Credit Card number" />
  <input type="text" name="expiration_date" placeholder="Expiration Date (MM/YY)" />
  <input type="text" name="security_code" placeholder="Security Code" />
  <button type="button" name="status_type">Deactivate</button>
  <?php
    $host = "35.192.209.221";
    $user = "root";
    $password = "1234";
    $dbname = "sob";

    $conn = mysqli_connect($host, $user, $password, $dbname);
    if(!$conn) {
        die ('Could not connect to the database server' . mysqli_connect_error());
    }
    if(isset($_POST['status_type'])) {
      $sql1 = "DELETE FROM delivers WHERE user_id = '$user_id'";
      mysqli_query($conn, $sql1);
      $sql2 = "DELETE FROM cart WHERE user_id='$user_id'";
      mysqli_query($conn, $sql2);
      $sql3 = "SELECT order_id FROM orders where user_id='$user_id'";
      mysqli_query($conn, $sql3);
      while($row = mysqli_fetch_array($sql3)) {
        $curr_order_id = $row['order_id'];
        $query = "DELETE FROM order_products WHERE order_id = '$curr_order_id'";
        mysqli_query($conn, $query);
      }
      $sql4 = "DELETE FROM orders where user_id='$user_id'";
      mysqli_query($conn, $sql4);
      $sql5 = "DELETE FROM product where user_id='$user_id'";
      mysqli_query($conn, $sql5);
      $sql6 = "DELETE FROM customer where user_id='$user_id'";
      mysqli_query($conn, $sql6);
      $sql7 = "DELETE FROM driver where user_id='$user_id'";
      mysqli_query($conn, $sql7);
      $sql8 = "DELETE FROM seller where user_id='$user_id'";
      mysqli_query($conn, $sql8);

    }
  ?>
  <button type="submit" name="save">Save</button>
</form>
<script src='https://code.jquery.com/jquery-3.4.1.min.js'></script>
</body>
</html>

<style>
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
