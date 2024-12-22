<?php
include "../functions.php";
include "../dbConnection.php";

if (!$_SESSION["user"] ?? false) {
    header("location:/");
    die();
}

if (isset($_POST["submit"])) {
    $product = json_decode($_POST['product'], true);;
    $quantity = $_POST["quantity"];
    $subtotal = (int)$quantity * (int)$product["price"];
    $product_id = $product["id"];
    $errors = [];
    if (empty($quantity)) {
        $errors["quantity"] = "pls add at least 1 product";
    } elseif (!is_numeric($quantity)) {
        $errors["quantity"] = "pls enter a number";
    }
    $subtotal = (int)$quantity * (int)$product["price"];
    $product_id = $product["id"];
    $cart = isset($_COOKIE["cart"]) ? json_decode($_COOKIE["cart"], true) : [];
    if (empty($errors)) {
        if (isset($cart["product_id"])) {
            $cart[$product_id]['quantity'] += $quantity;
        } else {
            $cart["$product_id"] = [
                'id' => $product_id,
                'image' =>  $product["image"],
                'product_name' => $product["name"],
                'Desc' => $product["description"],
                'quantity' => $quantity,
                'price' =>  $product["price"],
                'Subtotal' => $subtotal
            ];
        }
        setcookie('cart', json_encode($cart), time() + (86400 * 30), "/");
        $_SESSION["success"] = "product  added to cart successfully ";

        header("Location: ../shop.php");
        exit();
    } else {
        $_SESSION["errors"] = $errors;
        header("Location: ../shop.php");
    }
}
