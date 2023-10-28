<?php
require '../encrypt.php';

$conn = mysqli_connect("localhost", "root", "", "utsisa");

$rows = [];
if (isset($_POST['username'])) {

    $username = $_POST['username'];
    $name = $_POST['name'];
    $datetime = $_POST['datetime'];


    $stmt = $conn->prepare("INSERT INTO schedules (name, date, user_username) VALUES (?,?,?)");
    $stmt->bind_param("sss", $name, $datetime, $username);
    $stmt->execute();

    $rows = ["msg" => "success"];
}

echo encrypt(json_encode($rows));
$conn->close();
