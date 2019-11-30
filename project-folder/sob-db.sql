CREATE TABLE acc_status(
  status_type varchar(30) not null,
  primary key (status_type)
);

insert into acc_status values('Active');
insert into acc_status values('Deactivated');

CREATE TABLE accounts(
  user_id int not null AUTO_INCREMENT,
  pass_word varchar(30) not null,
  email varchar(30) not null,
  street varchar(30) not null,
  city varchar(30) not null,
  state varchar(30) not null,
  zip double(5,0) not null,
  phone double(10,0) not null,
  status_type varchar(30) not null,
  primary key(user_id),
  foreign key (status_type) references acc_status(status_type)
);

insert into accounts (pass_word, email, street, city, state, zip, phone, first_name, last_name, status_type)values
  ('johndoe', 'john@gmail.com', '12 John Rd', 'Richmond', 'VA', 23220, 8041234567, 'Active'),
  ('sean', 'sean@gmail.com', '44 Sean Rd', 'Richmond', 'VA', 23220, 8042847593, 'Active');

CREATE TABLE seller(
  user_id int not null primary key,
  seller_name varchar(30)not null,
  email varchar(30) not null unique,
  foreign key(user_id) references accounts(user_id)
);

insert into seller(user_id, seller_name) values
  (1, 'Doe Company');


CREATE TABLE driver(
  user_id int not null primary key,
  email varchar(30) not null unique,
  first_name varchar(30) not null,
  last_name varchar(30) not null,
  license_num double(30,0) not null,
  insurance varchar(30) not null,
  deliver_zip double(5,0) not null,
  foreign key(user_id) references accounts(user_id)
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

insert into customer values
  (2, 'Sean', 'Dawn', 432543214, 'Sean Dawn', '11/21', 325);

CREATE TABLE product(
  product_id int not null AUTO_INCREMENT,
  user_id int not null,
  product_name varchar(30) not null,
  price double(30,2) not null,
  conditions varchar(30) not null,
  primary key(product_id),
  foreign key(user_id) references accounts(user_id)
);

insert into product(user_id, product_name, price, conditions) values
  (1, 'Gray Sweater', 19.99, 'Brand New'),
  (1, 'Green Blanket', 49.99, 'Used');

CREATE TABLE orders(
  order_id int not null AUTO_INCREMENT,
  user_id int not null,
  product_id int not null,
  order_date date not null,
  order_status varchar(30),
  schduled_delivery varchar(30),
  primary key(order_id, user_id, product_id),
  foreign key(user_id) references accounts(user_id),
  foreign key(product_id) references product(product_id)
);

insert into orders(user_id, product_id, order_date, order_status, schduled_delivery) values
  (2, 1, '2019-12-29', 'Preparing for shipping', '12/12');

CREATE TABLE delivers(
  order_id int not null,
  delivery_time double(4,0),
  actual_delivery_date varchar(30),
  foreign key(order_id) references orders(order_id)
);
-----------Need to be fixed, not in cloud yet---------------

create type acc_status_type as TABLE
(
    status_type varchar(30) not null,
    primary key (status_type)
);

create type user_status_type as TABLE
(
    status_type varchar(30) not null,
    foreign key (status_type) references acc_status(status_type)
);

CREATE PROCEDURE acc_status_function
(
  @status_type acc_status_type,
  @user_id user_status_type
)
AS
Begin
  update accounts
  set status_type = @status_type
  where user_id = @user_id
End;
