CREATE SEQUENCE user_id_squence
start with 1
maxvalue 10000
increment by 1
nocycle;

CREATE SEQUENCE order_id_squence
start with 1
maxvalue 10000
increment by 1
nocycle;

CREATE SEQUENCE product_id_squence
start with 1
maxvalue 10000
increment by 1
nocycle;

CREATE TABLE acc_status(
  status_type varchar2(30)
);

insert into acc_status values('Active');
insert into acc_status values('Deactivated');

CREATE TABLE account(
    user_id number(5,0) not null primary key,
    password varchar(30) not null,
    email varchar(30) not null,
    street varchar(30) not null,
    city varchar(30) not null,
    state varchar(30) not null,
    zip number(5,0) not null,
    phone number(10,0) not null,
    first_name varchar(30) not null,
    last_name varchar(30) not null,
    status_type varchar(30) not null,
    foreign key (status_type) references acc_status(status_type)
);

CREATE TABLE seller(
  user_id number(5,0) not null primary key,
  seller_name varchar(30)not null,
  foreign key(user_id) references account(user_id)
);

CREATE TABLE person(
  user_id number(5,0) not null primary key,
  first_name varchar(30) not null,
  last_name varchar(30) not null,
  foreign key(user_id) references account(user_id)
);

CREATE TABLE driver(
  user_id number(5,0) not null primary key,
  license_num number(30,0) not null,
  insurance varchar(30) not null,
  deliver_zip number(5,0) not null,
  foreign key(user_id) references account(user_id)
);

CREATE TABLE customer(
  user_id number(5,0) not null primary key,
  credit_card number(9,0) not null,
  card_holder varchar(30) not null,
  expirtion varchar(30) not null,
  security_code number(5,0) not null,
  foreign key(user_id) references account(user_id)
);

CREATE TABLE product(
  product_id number(5,0) not null primary key,
  product_name varchar(30) not null,
  price number(30,2) not null,
  condition varchar(30) not null
);

CREATE TABLE order(
  order_id number(5,0) not null primary key,
  user_id number(5,0) not null primary key,
  product_id number(5,0) not null primary key,
  order_date date not null,
  order_status varchar(30),
  schduled_delivery varchar(30)
  foreign key(user_id) references account(user_id),
  foreign key(product_id) references product(product_id)
);

CREATE TABLE delivers(
  delivery_time number(4,0),
  actual_delivery_date varchar(30)
);

create or replace procedure acc_status_function(p_status_type IN acc_status.status_type%type, p_user_id IN account.user_id%type)
IS
Begin
  update account
  set status_type = p_status_type
  where user_id = p_user_id
End;
