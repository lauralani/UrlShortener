<?php
session_start();

if (!(isset($_SESSION["docroot"]))) {
    $_SESSION["docroot"] = __DIR__;
}  

require_once $_SESSION["docroot"] . "/php/sessionmanager.php";

if (!empty($_GET["uri"]))
{
    echo $_GET["uri"];
    //redirect to target
}

var_dump($_COOKIE);

if ($_SESSION["loggedin"] != true)
{
    if (empty($_COOKIE["Session"]))
    {
        $_SESSION["login_uri"] = "/";
        header("Location: login.php");
    }
    else
    {
        $isvalidsession = SessionManager::validate_session($_COOKIE["session"]);

        var_dump($isvalidsession);

        if ($isvalidsession) 
        {
            $_SESSION["loggedin"] = true;
        }
        else
        {
            $_SESSION["login_uri"] = "/";
            header("Location: login.php");
        }
    }
}



?>
