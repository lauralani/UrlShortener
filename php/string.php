<?php

function createRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function createSessionID ( $username ) {
    $hashstring = createRandomString() . $username . time() . createRandomString();
    
    return hash("sha256", "$hashstring");
}

function hashPassword ($pass)
{
    return hash("sha256", "$pass");
}


?>
