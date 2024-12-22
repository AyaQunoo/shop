<?php
include "../functions.php";
include "../dbConnection.php";

if (isset($_POST["addProduct"])) {
    $errors = [];
    $image = $_FILES["img"];
    $img_name = $image["name"];
    $temp = $image["tmp_name"];
    $img_error = $image["error"];
    $ext = pathinfo($img_name, PATHINFO_EXTENSION);
    $maxFileSize = 3 * 1024 * 1024;
    $img_type = ['jpg', 'png'];
    $new_img_name = uniqid() . time() . "$ext";
    input(extract($_POST));


    if (empty($title)) {
        $errors["title"] = "this field is required";
    }
    if (empty($price)) {
        $errors["price"] = "this field is required";
    } elseif ($price < 0) {
        $errors["price"] = "price cant be less than 0";
    }
    if (!isset($category)) {
        $errors["category"] = "pls choose a category";
    }
    if ($img_error != 0) {
        $errors["img"] = "sth went wrong try again";
    } elseif (!in_array(strtolower($ext), $img_type)) {
        $errors["img"] = "file is not valid";
    } elseif ($image['size'] > $maxFileSize) {
        $errors["img"] = "File size exceeds the maximum limit of 2MB.";
    }

    if (empty($errors)) {
        $query = "INSERT INTO products (name,description,price,stock_quantity,category_id,image) VALUES ('$title','$desc','$price','$quantity','$category','$new_img_name')";
        $result = mysqli_query($conn, $query);
        if ($result) {
            $_SESSION["success"] = "product insered successfully";
            move_uploaded_file($temp, "../admin/upload/$new_img_name");
        } else {
            $_SESSION["error"] = "sth went wrong";
        }
        header("location:addProduct.php");
    } else {
        $_SESSION["errors"] = $errors;
        header("location:addProduct.php");
    }
} else {
    header("location:../admin/view/addProduct.php");
    die();
}
