<?php

if (!(isset($_SESSION["docroot"]))) {
    $_SESSION["docroot"] = __DIR__;
}

require $_SESSION["docroot"] . "/php/sessionmanager.php";

SessionManager::cleanup();

?>