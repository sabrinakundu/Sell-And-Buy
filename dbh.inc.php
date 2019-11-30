<?php
// connect to the database
$host="35.192.209.221";
$port=3306;
$socket="";
$user="root";
$password="1234";
$dbname="sob";

$conn = mysqli_connect($host, $user, $password, $dbname, $port, $socket)
	or die ('Could not connect to the database server' . mysqli_connect_error());

//$conn->close();
