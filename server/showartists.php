<?php
require '../encrypt.php';

$conn = mysqli_connect("localhost", "root", "", "utsisa");

$rows = [];

$stmtUsers = $conn->prepare("SELECT * FROM users WHERE role = 'artis'");
$stmtUsers->execute();
$resultUsers = $stmtUsers->get_result();

$dataUsers = [];
while ($row = mysqli_fetch_assoc($resultUsers)) {
    $dataUsers[] = $row;
}

$rows = ["msg" => "success", "data_users" => $dataUsers];


echo encrypt(json_encode($rows));
$conn->close();
