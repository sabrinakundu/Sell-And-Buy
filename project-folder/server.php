<?php
$email = "";
$pass_word = "";
$street = "";
$city = "";
$statee = "";
$zip = "";
$phone = "";
$errors = array();

$host="35.192.209.221";
$user="root";
$password="1234";
$dbname="sob";

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
    if("" == trim($_POST['password'])) {
        array_push($errors, "Password is required");
    } else if (isset($_POST['password'])) {
        $pass_word = $_POST['password'];
        
    }
    if("" == trim($_POST['street'])) {
        array_push($errors, "Street address is required");
    } else if (isset($_POST['street'])) {
        $street = $_POST['street'];
    }
    if("" == trim($_POST['city'])) {
        array_push($errors, "City is required");
    } else if (isset($_POST['city'])) {
        $city = $_POST['city'];
    }
    if("" == trim($_POST['state'])) {
        array_push($errors, "State is required");
    } else if(isset($_POST['state'])) {
        $statee = $_POST['state']; 
    }
    if("" == trim($_POST['zipcode'])) {
        array_push($errors, "Zip code is required");
    } else if (isset($_POST['zipcode'])) {
        $zip = $_POST['zipcode'];
    }
    if("" == trim($_POST['phone'])) {
        array_push($errors, "Phone number is required");
    } else if (isset($_POST['phone'])) {
        $phone = $_POST['phone']; 
    }

    $email = mysqli_real_escape_string($conn, $email);
    $pass_word = mysqli_real_escape_string($conn, $pass_word);
    $street = mysqli_real_escape_string($conn, $street);
    $city = mysqli_real_escape_string($conn, $city);
    $statee = mysqli_real_escape_string($conn, $statee);
    $zip = mysqli_real_escape_string($conn, $zip);
    $phone = mysqli_real_escape_string($conn, $phone);

    $user_check_query = "SELECT * FROM accounts a WHERE a.email = '$email' LIMIT 1";
    $result = mysqli_query($conn, $user_check_query);
    $count_rows = mysqli_num_rows($result);
    if($count_rows == 1) {
        array_push($errors, "This email address already has a registered username");
    }

    if(count($errors) == 0) {
        $sql = "INSERT INTO accounts (pass_word, email, street, city, state, zip, phone, status_type) VALUES ('$pass_word', '$email', '$street', '$city', '$statee', '$zip', '$phone', 'Active');";
        if(mysqli_query($conn, $sql)) {
            header("Location: index.php");
            exit;
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn); 
        }
        mysqli_close($conn);
    }
}