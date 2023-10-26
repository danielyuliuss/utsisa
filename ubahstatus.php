<?php 
require 'readapi.php';

if(isset($_GET['status'])){
    $status = $_GET['status'];
    $username = $_GET['username'];

    $url = "http://localhost/utsisa/changestatus.php";
    $data = ["status"=>$status, "username"=>$username];

    $result = send_post($url, $data);

    header("location: index.php");
}

?>