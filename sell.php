<!DOCTYPE html>
<html>
    <head>
        <title>Sell a Product</title>
    </head>
    <body>
    <ul>
    <li><a href="index.php">Home</a></li>
    <li><a href="cart.html">Cart</a></li>
    <li><a href="existing_orders.html">Orders</a></li>
    <li><a href="delivery_driver.html">Driver Account</a></li>
    <li><a href="account.html">User Account</a></li>
    </ul>
    <div class="makemoney">
        <div class="form">
            <h1>Post a Product</h1>
            <form class="register-form" action="addproducts.php" method="POST">
                <?php include('errors.php'); ?>
                
            </form>
        </div>
    </div>
    </body>
</html>