<?php
require '../encrypt.php';

$conn = mysqli_connect("localhost", "root", "", "utsisa");

if (isset($_POST['username']) && $_POST['password'] && $_POST['name'] && $_POST['role']) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $name = $_POST['name'];
    $role = $_POST['role'];

    $stmt = $conn->prepare("INSERT INTO users (username, password, name, role) VALUES (?,?,?,?)");
    $stmt->bind_param("ssss", $username, $password, $name, $role);
    $stmt->execute();

    $row = [];

    if($stmt->affected_rows == 1){
        $row = ["msg" => "success"];
    }
    else{
        $row = ["msg" => "failed"];
    }

    echo encrypt(json_encode($row));
}

$conn->close();
