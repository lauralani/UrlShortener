<?php

require_once $_SESSION["docroot"] . "/php/string.php";

class UserManager
{
    static function validate_login ( $username, $password ) {
        
        $users = UserManager::get_users();

        if (in_array($username, $users)){
            echo "user exists";
        }
        else
        {
            echo "user doesnt exist";
        }
    }

    static function get_users () {
        if (file_exists($_SESSION["docroot"] . "/storage/users.json"))
        {
            $user_data = file_get_contents($_SESSION["docroot"] . "/storage/users.json");
            try {
                $users = json_decode($user_data);
            } catch (\Throwable $th) {
                throw $th;
            }
        }
        else
        {

            throw new \Throwable();
        }
        return $users;
    }
}

?>
