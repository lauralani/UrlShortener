<?php
  include $_SESSION["docroot"].'/config/config.php';
  
  $mysqli = new mysqli(
    $host = $CONFIG['mysql']['host'],
    $username = $CONFIG['mysql']['username'],
    $passwd = $CONFIG['mysql']['password'],
    $database = $CONFIG['mysql']['database']
  );
  $mysqli->set_charset("utf8mb4");
?>
