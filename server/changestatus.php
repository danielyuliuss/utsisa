<?php
require '../encrypt.php';

$conn = mysqli_connect("localhost", "root", "", "utsisa");

$rows = [];
if (isset($_POST['username'])) {

    $username = $_POST['username'];
    $status = $_POST['status'];

    $current = 1;
    if($status == "active"){
        $current = 0;
    }

    $stmt = $conn->prepare("UPDATE users SET is_active = ? WHERE username = ?");
    $stmt->bind_param("ss", $current, $username);
    $stmt->execute();

    $rows = ["msg" => "success"];
}

echo encrypt(json_encode($rows));
$conn->close();
