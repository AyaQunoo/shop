<?php
include "../dbConnection.php";
include "../functions.php";
if (isset($_POST["signup"])) {
    $errors = [];
    input(extract($_POST));

    if (empty($UserName) || empty($email) || empty($password) || empty($address) || empty($phone)) {
        $errors["empty_field"] = "cant leave this field empty";
    }
    if (strlen($UserName) < 3 && strlen($UserName) > 50) {
        $errors["username"] = "username must be between 3 to 50 char long ";
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors["email"] = "pls enter a valid email";
    }
    if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/', $password)) {
        $errors["password"] = "Password must be at least 8 characters long ,one uppercase letter, one special character,one lowercase.";
    }

    if (strlen($phone) > 15) {
        $errors["phone"] = "pls enter a valid phone number";
    } elseif (!is_numeric($phone)) {
        $errors["phone"] = "pls enter a valid phone number";
    }

    $query = "SELECT email FROM users WHERE email ='$email'";
    $result = mysqli_query($conn, $query);
    $userExist = mysqli_fetch_assoc($result);
    if ($userExist) {
        $errors["email"] = "email is already registerd ";
    }
    if (!empty($errors)) {
        $_SESSION["errors"] = $errors;
        $_SESSION["data"] = [
            "username" => $UserName,
            "email" => $email,
            "password" => $password,
            "phone" => $phone,
            "address" => $address
        ];
        header("location:/signup.php");
        die();
    }
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
    $addUser = "INSERT INTO users (username, email, password, phone, address) VALUES ('$UserName', '$email', '$hashedPassword', '$phone', '$address')";
    $result = mysqli_query($conn, $addUser);
    login([
        "email" => $email
    ]);
    header("location:../shop.php");
    die();
}
