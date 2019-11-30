<?php
$seller = "";
$errors = array();

$host = "35.192.209.221";
$user = "root";
$password = "1234";
$dbname = "sob";

$conn = mysqli_connect($host, $user, $password, $dbname);
if(!$conn) {
    die ('Could not connect to the database server' . mysqli_connect_error());
}

if(isset($_POST['send'])) {
    if("" == trim($_POST['email'])) {
        array_push($errors, "Email is required");
    } else if (isset($_POST['email'])) {
        $email = $_POST['email'];
    }
    if("" == trim($_POST['sellername'])) {
        array_push($errors, "Seller name is required");
    } else if (isset($_POST['sellername'])) {
        $seller = $_POST['sellername'];
    }
    $seller = mysqli_real_escape_string($conn, $seller);
    $email = mysqli_real_escape_string($conn, $email);

    $user_check_query = "SELECT * FROM seller s WHERE s.email = '$email' LIMIT 1";
    $result = mysqli_query($conn, $user_check_query);
    $count_rows = mysqli_num_rows($result);
    if($count_rows == 1) {
        array_push($errors, "This email address already has a seller account.");
    }

    if(count($errors) == 0) {
        $sql = "INSERT INTO seller (user_id, seller_name, email) VALUES (SELECT user_id FROM accounts WHERE email = `$email`, `$seller`, `$email`)";
        if(mysqli_query($conn, $sql)) {
            header("Location: sell.php");
            exit;
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn); 
        }
        mysqli_close($conn);
    }
}