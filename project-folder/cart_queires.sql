# display cart
select p.product_name, c.quantity, p.price 
from cart c join product p
on c.product_id = p.product_id 
where c.user_id = user_id

#php

$conn = mysqli_connect($host, $user, $password, $dbname);
$user_check_query = "SELECT p.product_name, c.quantity FROM cart c join product p WHERE c.user_id = '$user_id'";
$result = mysqli_query($conn, $user_check_query);

#------------------------------------------------------------------
# insert into cart

insert into cart (user_id, product_id, quantity) values (a_user_id, a_product_id, a_quantity)

# php
$conn = mysqli_connect($host, $user, $password, $dbname);
$user_check_query = "insert into cart (order_id, product_id, quantity) values ('$a_user_id', '$a_product_id', '$a_quantity')'";
$result = mysqli_query($conn, $user_check_query);


#-----------------------------------------------------------------------

# delete from cart
delete from cart
where user_id = $user_id and product_id = $product_id

# php
$conn = mysqli_connect($host, $user, $password, $dbname);
$user_check_query = "delete from cart where user_id = '$user_id and product_id = '$product_id'";
$result = mysqli_query($conn, $user_check_query);


#  ---------------------------------------------------------------------------------------


# update from cart
update cart
set quantity = quantity
where user_id = user_id and product_id = product_id

# php
$conn = mysqli_connect($host, $user, $password, $dbname);
$user_check_query = "update cart set quantity = '$quantity' where user_id = '$user_id' and product_id = '$product_id'";
$result = mysqli_query($conn, $user_check_query);

