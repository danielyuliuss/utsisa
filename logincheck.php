<?php
require 'encrypt.php';

$conn = mysqli_connect("localhost", "root", "", "utsisa");

if (isset($_POST['username']) && $_POST['password']) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    $row = ["msg" => "failed"];
    if (count($rows) > 0) {
        $row = ["msg" => "success", "data" => $rows];
    }

    echo encrypt(json_encode($row));
}

$conn->close();
