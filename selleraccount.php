<?php include('server_seller_account.php'); ?>
<!DOCTYPE html>
<html>
    <head>
        <title>Create Seller Account</title>
        <link rel="stylesheet" type="text/css" href="loginstyle.css">
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
    <li><a href="sell.php">Seller Account</a></li>
    <li><a href="cart.html">Cart</a></li>
    <li><a href="existing_orders.html">Orders</a></li>
    <li><a href="delivery_driver.html">Driver Account</a></li>
    <li><a href="account.html">User Account</a></li>
    </ul>
    <div class="login-page">
      <div class="form">
        <h1>Start a Selling Account</h1>
        <form class="register-form" action="selleraccount.php" method="POST">
          <?php include('errors.php'); ?>
          <input type="text" name="email" placeholder="email"/>
          <input type="text" name="sellername" placeholder="user name or company name"/>
          <button type="submit" name="send">Create Account</button>
        </form>
      </div>
    </div>
    <script src='https://code.jquery.com/jquery-3.4.1.min.js'></script>
    <script>
      $('.message a').click(function(){
        $('form').animate({height: "toggle", opacity: "toggle"});
      });
	  </script>
</body>
</html>