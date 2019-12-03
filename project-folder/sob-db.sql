CREATE TABLE accounts(
  user_id int not null AUTO_INCREMENT,
  pass_word varchar(225) not null,
  email varchar(225) not null,
  street varchar(225) not null,
  city varchar(225) not null,
  state varchar(225) not null,
  zip double(5,0) not null,
  phone double(10,0) not null,
  status_type varchar(225) not null,
  primary key(user_id),
  foreign key (status_type) references acc_status(status_type)
);

CREATE TABLE seller(
  user_id int not null primary key,
  email varchar(30) not null unique,
  seller_name varchar(30)not null,
  foreign key(user_id) references accounts(user_id)
);

CREATE TABLE driver(
  user_id int not null primary key,
  email varchar(30) not null unique,
  first_name varchar(30) not null,
  last_name varchar(30) not null,
  license_num double(30,0) not null,
  insurance varchar(30) not null,
  deliver_zip double(5,0) not null,
  foreign key(user_id) references person(user_id)
);

CREATE TABLE customer(
  user_id int not null primary key,
  first_name varchar(30) not null,
  last_name varchar(30) not null,
  credit_card double(9,0) not null,
  card_holder varchar(30) not null,
  expirtion varchar(30) not null,
  security_code double(5,0) not null,
  foreign key(user_id) references accounts(user_id)
);

CREATE TABLE product(
  product_id int not null AUTO_INCREMENT,
  user_id int not null,
  product_name varchar(30) not null,
  price double(30,2) not null,
  conditions varchar(30) not null,
  primary key(product_id),
  foreign key(user_id) references accounts(user_id)
);

CREATE TABLE orders(
  order_id int not null AUTO_INCREMENT,
  user_id int not null,
  order_date date not null,
  order_status varchar(30),
  schduled_delivery varchar(30),
  primary key(order_id, user_id),
  foreign key(user_id) references accounts(user_id)
);

CREATE TABLE cart(
  order_id int not null,
  product_id int not null,
  quantity int not null,
  primary key(order_id, product_id),
  foreign key(product_id) references product(product_id),
  foreign key(order_id) references orders(order_id)
)

CREATE TABLE delivers(
  order_id int not null,
  user_id int not null,
  delivery_time double(4,0),
  actual_delivery_date varchar(30),
  foreign key(order_id) references orders(order_id),
  foreign key(user_id) references driver(user_id)
);

delimiter //
CREATE TRIGGER `trig_quantity_check` BEFORE INSERT ON `product`
FOR EACH ROW
BEGIN
IF NEW.quantity < 0 THEN
SET NEW.quantity=0;
END IF;
END
//
delimiter;
