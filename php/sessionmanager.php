<?php

require $_SESSION["docroot"] . "/php/string.php";

class SessionManager
{
    static function validate_session ( $current_session ) {
        SessionManager::cleanup();
        $sessions = SessionManager::get_sessions();

        if (in_array($current_session, $sessions)){
            return true;
        }
        else
        {
            return false;
        }
    }

    static function new_session ( $user ) {
        $month = 60 * 60 * 24 * 31;
        $expire = time() + $month;

        $cookie = createSessionID($user);

        $sessions = SessionManager::get_sessions();

        $new_session = array( 
            "id" => $cookie, 
            "username" => $user, 
            "expire" => $expire
        );

        array_push($sessions, $new_session);
        file_put_contents($_SESSION["docroot"] . "/storage/sessions.tmp.json", json_encode(array('sessions' => $sessions)));
        unlink($_SESSION["docroot"] . "/storage/sessions.json");
        rename( $_SESSION["docroot"] . "/storage/sessions.tmp.json",$_SESSION["docroot"] . "/storage/sessions.json");
        
        return $cookie;
    }

    private static function get_sessions () {
        if (file_exists($_SESSION["docroot"] . "/storage/sessions.json"))
        {
            $session_data = file_get_contents($_SESSION["docroot"] . "/storage/sessions.json");
            try {
                $sessions = json_decode($session_data);
            } catch (\Throwable $th) {
                throw $th;
            }
        }
        else
        {

            throw new \Throwable();
        }
        return $sessions->sessions;
    }

    static function cleanup () {

        $active_sessions = false;

        $sessionarray = SessionManager::get_sessions();

        echo json_encode($sessionarray);

        echo "<br><br>";

        $i = 0;

        foreach ( $sessionarray as $session )
        {
            
            // echo $session->username . "<br><br>";
            if ($session->expire > time())
            {
                // echo( $session->username . " is not expired! <br/>");
                // array_merge($active_sessions, $session);

                // echo json_encode($session) . "<br><br>";

                if (!$active_sessions)
                {
                    echo "<br>adding first array thing: Iteration" . $i . ", ID: " . $session->username . "<br>";
                    $active_sessions = array($session);
                }
                else
                {
                    echo "<br>adding array thing: Iteration" . $i . ", ID: " . $session->username . "<br>";

                    array_push($active_sessions, $session);
                }

            }
            else 
            {
                // echo( $session->username . " is expired! <br/>");
                echo "<br>doing nothing: Iteration" . $i  . ", ID: " . $session->username . "<br>";
                
            }
            $i = $i +1;
        }
        $cleanedsessions = json_encode(array('sessions' => $active_sessions));
        file_put_contents($_SESSION["docroot"] . "/storage/sessions.tmp.json", $cleanedsessions);

        unlink($_SESSION["docroot"] . "/storage/sessions.json");
        rename( $_SESSION["docroot"] . "/storage/sessions.tmp.json",$_SESSION["docroot"] . "/storage/sessions.json");
    }
}

?>
