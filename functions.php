<?php

session_start();
function login($user)
{
    $_SESSION["user"] = [
        "email" => $user["email"],
        "id" => $user["id"]
    ];
}
function logout()
{
    $_SESSION = [];
    session_destroy();
    $params = session_get_cookie_params();
    setcookie("PHPSESSID", " ", time() - 3600, $params["path"], $params["domain"], $params["secure"], $params['httponly']);
}

function input($data)
{
    return trim(htmlspecialchars($data));
}
function showError($errors)
{
    foreach ($errors as $error) {
        echo '<div class="alert alert-danger" role="alert">';
        echo htmlspecialchars($error);
        echo '</div>';
    }
}
