<?php 
require 'readapi.php';

session_start();
if(!isset($_SESSION["username"])){
    header("location: login.php");
}

if(isset($_GET['id'])){
    $url = "http://localhost/utsisa/server/deleteschedule.php";
    $id = $_GET['id'];
    
    $data = send_post($url, ["id"=>$id]);

    header("location: ubahjadwal.php?username=".$_GET['username']);
}
