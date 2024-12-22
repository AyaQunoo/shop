<?php
include "../functions.php";

if (isset($_POST["logout"])) {
    logout();
    header("location:/");
}
