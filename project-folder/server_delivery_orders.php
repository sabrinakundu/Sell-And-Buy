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
    <p class="page_title">Delivery Orders</p>
    </h1>

    <table>
  <tr>
    <th>Street</th>
    <th>City</th>
    <th>State</th>
    <th>Schduled Delivery</th>
  </tr>
  <tr>
    <td>123 W Broad St</td>
    <td>Richmond</td>
    <td>VA</td>
    <td>12-13-19</td>
  </tr>
  <tr>
    <td>55 Cary St</td>
    <td>Richmond</td>
    <td>VA</td>
    <td>12-19-19</td>
  </tr>
  <tr>
    <td>647 Main St</td>
    <td>Richmond</td>
    <td>VA</td>
    <td>12-21-19</td>
  </tr>

</table>

    <?php
    $host = "35.192.209.221";
    $user = "root";
    $password = "1234";
    $dbname = "sob";

    $conn = mysqli_connect($host, $user, $password, $dbname);
    if(!$conn) {
        die ('Could not connect to the database server' . mysqli_connect_error());
    }

    //include 'server_driver.php'
    //$driver_email = $email;
    $driver_user_id = "select user_id from accounts where '$driver_email' = accounts.email";
    $query_driver_user_id = mysqli_query($conn, $driver_user_id);
    //$get_order_id = "select order_id from delivers where user_id = $driver_user_id";
    $get_deliver_info = "select a.street, a.city, a.zip, a.state, o.schduled_delivery
                        from delivers d join orders o
                        join accounts a
                        on o.user_id = a.user_id
                        where d.user_id = '$query_driver_user_id'";
    $query = mysqli_query($conn, $get_deliver_info);

    while($row = mysqli_fetch_array($query)) {
      $street = $row['street'];
      $city = $row['city'];
      $zip = $row['zip'];
      $state = $row['state'];
      $schduled_delivery = $row['schduled_delivery'];
      echo "<div class='product_box'>
          <div class='top_prod_box'>
          <div class='center_prod_box'>
            <div class='street'>$street</div>
            <div class='city'>$city</div>
            <div class='zip'>$zip</div>
            <div class='state'>$state</div>
            <div class='schduled_delivery'>$schduled_delivery</div>
          </div>
          </div>
          </div>";
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
