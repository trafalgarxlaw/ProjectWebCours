<?php
require  'Database.php';
//starting the session
session_start();


//select Tables membres
$data_membres = $database->select("membres", "*");

//encode member array in json format
$membres_JSON = json_encode($data_membres);

echo $membres_JSON;
?>






