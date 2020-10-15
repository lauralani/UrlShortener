<?php

class DataManager {
    private $users, $sessions, $links;

    function get_users () {
        if (file_exists($_SESSION["docroot"] . "/storage/users.json"))
        {
            $users_file = file_get_contents($_SESSION["docroot"] . "/storage/users.json");
            try {
                $users = json_decode($users_file);
            } catch (\Throwable $th) {
                throw $th;
            }
            return $users;
        }
        else
        {

            return false;
        }

    }
    function get_link ( $link ) {
        //return Link or false
    }

    function cleanup () {
        //cleanup expired sessions and links
    }

    //function __construct() {
    //}
}

?>
