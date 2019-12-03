<?php include('addproducts.php');
if(isset($_GET['user_id'])) {
    $user_account = $_GET['user_id'];
}
?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Sell a Product</title>
    </head>
    <style>
    .page_title, .slogan {
    font-size: 7;
    }
    .register-form {
    width: 100%;
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
      <li><a href="server_cart.php">Cart</a></li>
      <li><a href="server_orders.php">Orders</a></li>
      <li><a href="server_delivery_orders.php">Driver Account</a></li>
      <li><a href="account.php">User Account</a></li>
    </ul>
    <div class="makemoney">
        <div class="form">
            <h1>Post a Product</h1>
            <form class="register-form" action="sell.php" method="POST">
                <input type="text" name="product_name" placeholder="item name"/>
                <input type="text" name="price" placeholder="item price"/>
                <input type="text" name="condition" placeholder="new or used?"/>
                <input type="text" name="quantity" placeholder="how many?"/>
                <input type="text" name="user_id" value="<?php $user_account ?>"/>
                <button type="submit" name="send">Post Item</button>
            </form>
        </div>
        <?php
            $host = "35.192.209.221";
            $user = "root";
            $password = "1234";
            $dbname = "sob";
            $conn = mysqli_connect($host, $user, $password, $dbname);
            if(!$conn) {
                die ('Could not connect to the database server' . mysqli_connect_error());
            }
            if($_GET) {
            $userr = $_GET['user_id'];
            $result = mysqli_query($conn, "SELECT * FROM product WHERE user_id='$userr'");
            echo "<table border='1'><tr><th>Item</th><th>Price</th><th>Condition</th><th>Quantity</th><th colspan='2'>Changes</th></tr>";
            while($row = mysqli_fetch_array($result)) {
                echo "<tr>";
                echo "<td>" . $row['product_name'] . "</td>";
                echo "<td>" . $row['price'] . "</td>";
                echo "<td>" . $row['conditions'] . "</td>";
                echo "<td>" . $row['quantity'] . "</td>";
                echo "<td><button type='submit' name='update'>Update</button></td>";
                echo "<td><button type='submit' name='delete'>Delete</button></td>";
                echo "</tr>";
            }
            echo "</table>";
            mysqli_close($conn);
        }
        ?>
    </div>
    </body>
</html>
