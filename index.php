<?php
session_start();

if (!(isset($_SESSION["docroot"]))) {
    $_SESSION["docroot"] = __DIR__;
}  


if (!empty($_GET["uri"]))
{
    echo $_GET["uri"];
}

echo "hi"
?>
