<?php
include "../dbConnection.php";
include "../functions.php";
if (isset($_POST["login"])) {
    $errors = [];
    input(extract($_POST));
    if (empty($email) || empty($password)) {
        $errors["empty_input"] = "cant leave this field empty";
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors["email"] = "pls enter a valid email";
    }
    if (empty($errors)) {
        $query = "SELECT  id,email ,password ,username,role from users Where email ='$email'";
        $result = mysqli_query($conn, $query);
        $user = mysqli_fetch_assoc($result);
        if ($user) {
            if (!password_verify($password, $user["password"])) {
                $errors["user"] = "password doesnt match!!";
            }
        } else {
            $errors["user"] = "email does not exist!!";
        }
    }

    if (!empty($errors)) {
        $_SESSION["errors"] = $errors;
        $_SESSION["data"] = [
            "email" => $email,
        ];
        header("location:/login.php");
        die();
    }
    login($user);
    if ($user["role"] === "customer") {
        header("location: /shop.php");
    } elseif ($user["role"] === "admin") {
        header("location:/admin/view/layout.php");
    }
}
