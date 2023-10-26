<?php 
require 'readapi.php';

session_start();
if(!isset($_SESSION["username"])){
    header("location: login.php");
}

if(isset($_GET['id'])){
    $url = 'http://localhost/utsisa/changecontract.php';

    // ambil username dari session lalu post data
    $data = ['id' => $_GET['id'], 'res' => $_GET['res']];
    $data = send_post($url, $data);

    header("Location: http://localhost/utsisa/index.php");
}

?>