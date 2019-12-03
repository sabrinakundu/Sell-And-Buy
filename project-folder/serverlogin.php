<?php
$host="35.192.209.221";
$user="root";
$password="1234";
$dbname="sob";

$conn = mysqli_connect($host, $user, $password, $dbname);
if(!$conn) {
    die ('Could not connect to the database server' . mysqli_connect_error());
}

$email = "";
$pass_word = "";
$user_id = "";
$errors = array();

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
    $email = mysqli_real_escape_string($conn, $email);
    $pass_word = mysqli_real_escape_string($conn, $pass_word);
    if(count($errors) == 0) {
        $query = "SELECT * FROM accounts WHERE email = '$email' AND pass_word='$pass_word'";
        $results = mysqli_query($conn, $query);
        if(mysqli_num_rows($results)) {
            $user_id_query = "select user_id from accounts where email = '$email'";
            $_SESSION['email'] = $email;
            $_SESSION['success'] = "Logged in successfully";
            header("Location: index.php");
        } else {
            array_push($errors, "Wrong username/password combination. Please try again.");
        }
    }
}