<?php
require 'encrypt.php';

$conn = mysqli_connect("localhost", "root", "", "utsisa");

$rows = [];
if (isset($_POST['username'])) {
    $stmt = $conn->prepare("SELECT * FROM schedules WHERE user_username = ?");
    $stmt->bind_param("s", $_POST['username']);
    $stmt->execute();
    $result = $stmt->get_result();

    $dataSchedules = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $dataSchedules[] = $row;
    }
    $rows = ["msg" => "success", "data_schedules" => $dataSchedules];
}

echo encrypt(json_encode($rows));
$conn->close();
