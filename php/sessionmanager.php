<?php

class SessionManager
{
    public $sessions; //array(Session)

    function validate_session ( $current_session ) {
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

    function new_session ( $user ) {
        
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
        SessionManager::get_sessions();

        $active_sessions = array('sessions' => array() );

        foreach ( SessionManager::get_sessions() as $session )
        {
            if ($session->expire > time())
            {
                // echo( $session->username . " is not expired! <br/>");
                array_push($active_sessions["sessions"], $session);
            }
            else 
            {
                // echo( $session->username . " is expired! <br/>");
            }

            $json = json_encode($active_sessions);

            // somehow the arrays dont get added correctly, TODO

            var_dump($json);
        }
    }
}

$sessionmanager = new SessionManager();

?>
