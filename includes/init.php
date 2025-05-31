<?php

$host = "localhost";
$name = "root";
$pass = "";
$db = "practice";

$conn = new PDO("mysql:host=$host;dbname=$db",$name,$pass);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

define("BASE_DIR" , $_SERVER['DOCUMENT_ROOT'] . "/Basic_crud/Basic_crud");
define("BASE_URL", "/Basic_crud/Basic_crud");

function pathof($path){
    return BASE_DIR .  "/" . $path;
    
}
function urlof($path){
    return BASE_URL . "/" . $path;

}

session_start();