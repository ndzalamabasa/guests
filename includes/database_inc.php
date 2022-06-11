<?php
define('HOST','localhost');
define('DB_USER','mabasan1_guests');
define('DB_PASSWORD','Gue&Braverym1@202');
define('DB_NAME','mabasan1_guests');

$con = new mysqli(HOST,DB_USER,DB_PASSWORD,DB_NAME);

if($con -> connect_errno){
  echo "Failed to connect to the Database";
  exit();
}

?>