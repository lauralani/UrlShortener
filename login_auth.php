<?php
session_start();
if (!(isset($_SESSION["docroot"]))) {
    $_SESSION["docroot"] = __DIR__;
}

require $_SESSION["docroot"] . "/php/usermanager.php";


if (empty($_POST["username"]) || empty($_POST["password"]))
{
    header("HTTP/2.0 403 Forbidden");
}

$users = UserManager::get_users();

foreach ($users as $user)
{
    echo $user;
}

//UserManager::validate_login($_POST["username"], $_POST["password"]);
