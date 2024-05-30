<?php

include 'db-con.php';

session_start();

$_SESSION['reg-status'] = '';

function isEmpty($name, $email, $pass, $confPass) {
    if (empty($name) || empty($email) || empty($pass) || empty($confPass))
        return true;
    else
        return false;
}

function passDontMatch($pass, $confPass) {
    if ($pass === $confPass) 
        return false;
    else
        return true;
}

function makePassHash($pass) {
    return password_hash($pass, PASSWORD_DEFAULT);
}

function invalidEmail($email) {
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) 
        return false;
    else 
        return true;
}

function startSession($email, $conn) {
    $sql = "SELECT user_id FROM users where user_email = '$email';";
    $result = mysqli_query($conn, $sql);

    $id = mysqli_fetch_assoc($result);
    $_SESSION['user_id'] = $id['user_id'];
    header("Location: ../dashboard.php");
    return $id;
}

function isMailTaken($email, $conn) {
    $sql = "SELECT * FROM users where user_email = '$email';";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        return true;
    }
}
function createNewUser($name, $email, $pass, $conn) {
    $sql = "INSERT INTO users (user_name, user_email, user_pass) VALUES ('$name', '$email', '$pass');";

    try {
        $result = mysqli_query($conn, $sql);
    } catch (Exception $e) {
        $_SESSION['reg-status'] = 'Failed to create user';
        header("Location: ../register.php");
    }
}


if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $pass = htmlspecialchars($_POST['pass']);
    $confPass = htmlspecialchars($_POST['confPass']);

    // Check if any field id empty
    if (isEmpty($name, $email, $pass, $confPass)) {
        $_SESSION['reg-status'] = 'Fill out all the Field';
        header("Location: ../register.php");
    }

    if (invalidEmail($email)){
        $_SESSION['reg-status'] = 'Invalid Email';
        header("Location: ../register.php");
    }

    // Check if email taken
    if (isMailTaken($email, $conn)) {
        $_SESSION['reg-status'] = 'Email Taken';
        header("Location: ../register.php");
    }

    // Check if password Mismatched
    if (passDontMatch($pass, $confPass)) {
        $_SESSION['reg-status'] = 'Password Mismatched';
        header("Location: ../register.php");
    }


    $pass = makePassHash($pass);

    createNewUser($name, $email, $pass, $conn);
    startSession($email, $conn);



    // echo $name . "<br>";
    // echo $email . "<br>";
    // echo $pass . "<br>";
    // echo $confPass . "<br>";
}