<?php
include "../dbConnection.php";
include "../functions.php";
if (isset($_POST["addCategory"])) {
    $errors = [];
    $title = input($_POST["title"]);
    if (empty($title)) {
        $errors["title"] = "field is required";
    }
    $query = "SELECT name FROM category where name = '$title'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        $errors["category"] = "category is alraedy exist ";
    }
    if (empty($errors)) {
        $query = "INSERT INTO category (name) VALUES ('$title')";
        $result = mysqli_query($conn, $query);
        if ($result) {
            $_SESSION["success"] = "data created sucsessfully";
            header("location:../admin/view/addCategory.php");
        } else {
            $_SESSION["errors"] = "sth went wrong";
            header("location:../admin/view/addCategory.php");
        }
    } else {
        $_SESSION["errors"] = $errors;
        header("location:../admin/view/addCategory.php");
    }
}
