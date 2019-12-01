<?php
$product_name = "";
$price = "";
$condition = "";
$quantity = "";
$account = "";
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
    if("" == trim($_POST['product_name'])) {
        array_push($errors, "Product name is required");
    } else if (isset($_POST['product_name'])) {
        $product_name = $_POST['product_name'];
    }

    if("" == trim($_POST['price'])) {
        array_push($errors, "Price is required");
    } else if (isset($_POST['price'])) {
        $price = $_POST['price'];
    }

    if("" == trim($_POST['condition'])) {
        array_push($errors, "You must type new or used");
    } else if (isset($_POST['condition'])) {
        $condition = $_POST['condition'];
    }

    if("" == trim($_POST['quantity'])) {
        array_push($errors, "Quantity of product is required");
    } else if (isset($_POST['quantity'])) {
        $quantity = $_POST['quantity'];
    }
    if("" == trim[$_POST['user_id']]) {
        array_push($errors, "No user id here");
    } else if (isset($_POST['user_id'])) {
        $account = $_POST['user_id'];
    }
    $product_name = mysqli_real_escape_string($conn, $product_name);
    $price = mysqli_real_escape_string($conn, $price);
    $condition = mysqli_real_escape_string($conn, $condition);
    $quantity = mysqli_real_escape_string($conn, $quantity);
    $account = mysqli_real_escape_string($conn, $account);
    if(count($errors) == 0) {
        $sql = "INSERT INTO product(user_id, product_name, price, conditions, quantity) VALUES ('$account', '$product_name', '$price', '$condition', '$quantity')";
        if(mysqli_query($conn, $sql)) {
            header('Location: sell.php?user_id='.$query);
            exit;
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
        mysqli_close($conn);
    }

}
