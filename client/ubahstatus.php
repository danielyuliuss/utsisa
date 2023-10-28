<?php 
require 'readapi.php';

session_start();
if(!isset($_SESSION["username"])){
    header("location: login.php");
}

if(isset($_GET['status'])){
    $status = $_GET['status'];
    $username = $_GET['username'];

    $url = "http://localhost/utsisa/server/changestatus.php";
    $data = ["status"=>$status, "username"=>$username];

    $result = send_post($url, $data);

    header("location: index.php");
}

?>