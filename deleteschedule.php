<?php
require 'encrypt.php';

$conn = mysqli_connect("localhost", "root", "", "utsisa");

$rows = [];
if (isset($_POST['id'])) {

    $id = $_POST['id'];

    $stmt = $conn->prepare("DELETE FROM schedules WHERE id=?");
    $stmt->bind_param("s", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    $rows = ["msg" => "success"];
}

echo encrypt(json_encode($rows));
$conn->close();
