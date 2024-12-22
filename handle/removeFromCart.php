<?php

if (isset($_POST["submit"])) {

    $product_id = $_POST['product_id'];

    $cart = isset($_COOKIE['cart']) ? json_decode($_COOKIE['cart'], true) : [];

    if (isset($cart[$product_id])) {
        unset($cart[$product_id]);
    }


    setcookie('cart', json_encode($cart), time() + (86400 * 30), "/");


    header("Location: ../cart.php?message=removed");
    exit();
}
