<?php

include('dbh.inc.php');

// Initializing variables
$password = "";
$email = "";
$street = "";
$city = "";
$state = "";
$zipcode = "";
$phonenumber = "";
$accountstatus = "";
$errors = array();

if(isset($_POST['submit'])) {
    if(empty($email)) {array_push($errors, "Email address is required");}
    else $email = mysqli_real_escape_string($conn, $_POST['email']);

    if(empty($password)) {array_push($errors, "Password is required");}
    else $password = mysqli_real_escape_string($conn, $_POST['pass_word']);

    if(empty($street)) {array_push($errors, "Street name is required");}
    else $street = mysqli_real_escape_string($conn, $_POST['street']);

    if(empty($city)) {array_push($errors, "City name is required");}
    else $city = mysqli_real_escape_string($conn, $_POST['city']);

    if(empty($state)) {array_push($errors, "State abbreviation is required");}
    else $state = mysqli_real_escape_string($conn, $_POST['state']);

    if(empty($zipcode)) {array_push($errors, "Zip code is required");}
    else $zipcode = mysqli_real_escape_string($conn, $_POST['zip']);

    if(empty($phonenumber)) {array_push($errors, "Phone number is required");}
    else $phonenumber = mysqli_real_escape_string($conn, $_POST['phone']);
}

// Check database for existing user with same username
$user_check_query = "SELECT * FROM accounts a WHERE a.email = '$email' LIMIT 1";
$results = mysqli_query($conn, $user_check_query);
$user = mysqli_fetch_assoc($results);
if($user) {
    if($user['email'] === $email) {
        array_push($errors, "This email address already has a registered username");
    }
}

// Register the user
if(count($errors) == 0) {
    $query = "INSERT INTO accounts (pass_word, email, street, city, state, zip, phone, first_name, last_name, status_type) VALUES ('$password', '$email', '$street', '$city', '$state', '$zipcode', '$phonenumber', 'Active')";

    mysqli_query($conn, $query);
    $_SESSION['email'] = $email;
    $_SESSION['success'] = "You are now logged in";

    header("Location: index.php");
}

// Login user
if(isset($_POST['submit'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    if(empty($email)) {
        array_push($errors, "Email address is required");
    }
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    if(empty($password)) {
        array_push($errors, "Password is required");
    }
    if(count($errors) == 0) {
        $query = "SELECT * FROM accounts WHERE email = '$email' AND password='$password'";
        $results = mysqli_query($conn, $query);
        if(mysqli_num_rows($results)) {
            $_SESSION['email'] = $email;
            $_SESSION['success'] = "Logged in successfully";
            header("Location: index.php");
        } else {
            array_push($errors, "Wrong username/password combination. Please try again.");
        }
    }
}





