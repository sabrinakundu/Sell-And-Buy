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

    $check_account_table = "SELECT * FROM accounts WHERE email = '$email'";
    $res = mysqli_query($conn, $check_account_table);
    $count_data = mysqli_num_rows($res);
    if($count_data == 1) {
        if(count($errors) == 0) {
            $query = "SELECT user_id FROM accounts WHERE email = '$email'";
            $results = mysqli_query($conn, $query);
            $row = mysqli_fetch_row($results);
            $user_id = $row[0];
            $sql = "INSERT INTO seller (user_id, seller_name, email) VALUES ('$user_id', '$seller', '$email')";
            if(mysqli_query($conn, $sql)) {
                header("Location: sell.php?user_id=".$user_id);
                exit;
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn); 
            }
            mysqli_close($conn);
        }       
    } else {
        array_push($errors, "This email address does not belong to any registered user account. Please use your account's email address.");
    }
}