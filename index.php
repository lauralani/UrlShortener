<?php
session_start();

if (!(isset($_SESSION["docroot"]))) {
    $_SESSION["docroot"] = __DIR__;
}  

require $_SESSION["docroot"] . "/php/sessionmanager.php";

if (!empty($_GET["uri"]))
{
    echo $_GET["uri"];
    //redirect to target
}

if ($_SESSION["loggedin"] != true)
{
    if (empty($_COOKIE["session"]))
    {
        header("Location: login.php");
    }
    else
    {
        $isvalidsession = SessionManager::validate_session($_COOKIE["session"]);
        if ($isvalidsession) 
        {
            $_SESSION["loggedin"] = true;
        }
        else
        {
        header("Location: login.php");

        }
    }
}

echo "insert your url here";

?>
