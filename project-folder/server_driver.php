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
    if("" == trim($_POST['firstname'])) {
        array_push($errors, "First name is required");
    } else if (isset($_POST['firstname'])) {
        $firstname = $_POST['firstname'];
    }
    if("" == trim($_POST['lastname'])) {
        array_push($errors, "Last name is required");
    } else if (isset($_POST['lastname'])) {
        $lastname = $_POST['lastname'];
    }
    if("" == trim($_POST['licensenumber'])) {
        array_push($errors, "License number is required");
    } else if (isset($_POST['licensenumber'])) {
        $license = $_POST['licensenumber'];
    }
    if("" == trim($_POST['insurancenum'])) {
        array_push($errors, "Insurance number is required");
    } else if (isset($_POST['insurancenum'])) {
        $insurance = $_POST['insurancenum'];
    }
    if("" == trim($_POST['deliverzip'])) {
        array_push($errors, "Deliver zip is required");
    } else if (isset($_POST['deliverzip'])) {
        $deliverzip = $_POST['deliverzip'];
    }
    $email = mysqli_real_escape_string($conn, $email);
    $license = mysqli_real_escape_string($conn, $license);
    $insurance = mysqli_real_escape_string($conn, $insurance);
    $deliverzip = mysqli_real_escape_string($conn, $deliverzip);
    $firstname = mysqli_real_escape_string($conn, $firstname);
    $lastname = mysqli_real_escape_string($conn, $lastname);


    $user_check_query = "SELECT * FROM driver WHERE driver.email = '$email' LIMIT 1";
    $result = mysqli_query($conn, $user_check_query);
    $count_rows = mysqli_num_rows($result);
    if($count_rows == 1) {
        array_push($errors, "This email address already has a delivery driver account.");
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
            $sql = "INSERT INTO driver (user_id, email, first_name, last_name, license_num, insurance, deliver_zip) VALUES ('$user_id', '$email', '$firstname', '$lastname','$license','$insurance', '$deliverzip')";
            if(mysqli_query($conn, $sql)) {
              $driver_user_id = "select user_id from driver where driver.email = '$email'";
              $result = mysqli_query($conn, $driver_user_id);
              $valid_zip = "Select a.user_id as 'user_id', o.zip as 'zip', o.order_id as 'order_id' from accounts a, orders o where o.user_id = a.user_id";
              $valid_zip_query = mysqli_query($conn, $valid_zip);
              while($rows = mysqli_fetch_array($valid_zip)){
                if($rows['zip'] == $deliverzip){
                  $matching_order_id = "select order_id from delivers where order_id = '$row['order_id']'";
                  $query_matching_order_id = mysqli_query($conn, $matching_order_id);
                  $count_matching_order_id = mysqli_num_rows($query_matching_order_id);
                  if($count_matching_order_id == 0){
                    $insert = "insert into delivers (order_id, user_id) values ('$rows['order_id']', '$rows['user_id']')";
                  }
                }
              }
                header("Location: deliver.php");
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
