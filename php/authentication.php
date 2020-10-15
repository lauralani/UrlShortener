<?php

$users = "";

if (file_exists($_SESSION["docroot"] . "/users/db.json"))
{
    $db_content = file_get_contents($_SESSION["docroot"] . "/users/db.json");
}
else
{
    echo "ERROR FILE DOESNT EXIST";
}

try {
    $users = json_decode($db_content);
} catch (\Throwable $th) {
    throw $th;
}



 

?>
