<?php
session_start();
if (!(isset($_SESSION["docroot"]))) {
    $_SESSION["docroot"] = __DIR__;
}

require_once $_SESSION["docroot"] . "/php/usermanager.php";
require_once $_SESSION["docroot"] . "/php/sessionmanager.php";


if (empty($_POST["username"]) || empty($_POST["password"]))
{
    header("HTTP/2.0 403 Forbidden");
}

if (empty($_SESSION["login_uri"]))
{
    $_SESSION["login_uri"] = "/";
}

$users = UserManager::get_users()->users;


// var_dump(array_key_exists($_POST["username"], $users));
if (array_key_exists($_POST["username"], $users)) 
{
    $passwordhash = hashPassword($_POST["password"]);

    if ($passwordhash == $users->{$_POST["username"]}->hmac)
    {
        $newsessionid = SessionManager::new_session($_POST["username"]);
        setcookie("Session", $newsessionid, time() + 2678400);
        $_SESSION["loggedin"] = true;
        header("Location: " . $_SESSION["login_uri"]);
    }
    else
    {
        $_SESSION["loggedin"] = "error:wrongpw";
        header("Location: login.php");
    }
}
else
{
    $_SESSION["loggedin"] = "error:wronguser";
    echo "Location: login.php";
}

//UserManager::validate_login($_POST["username"], $_POST["password"]);
?>
