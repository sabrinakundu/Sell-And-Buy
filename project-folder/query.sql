

orders query:

1.insert the order:
  $date = new DateTime($input_date);
  $dateDelivery = $date->modify('+14 day');
  echo $date->format('Y-m-d');

  $query = global user_id
  $insertOrder = insert into orders(user_id, order_date, order_status, schduled_delivery)
    values($query, $date, 'not delivered', $dateDelivery)
  $result = mysqli_query($conn, $insertOrder);


2. display all the orders
  $query = global user_id
  $displayOrders = select order_id, order_date, order_status, schduled_delivery from orders
    where user_id = $query

3. cancel order
  $query = global user_id
  $deleteOrder = delete from order where user_id = $query
