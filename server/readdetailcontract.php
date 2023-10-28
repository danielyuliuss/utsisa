<?php
require '../encrypt.php';

$conn = mysqli_connect("localhost", "root", "", "utsisa");

$rows = [];
if (isset($_POST['id'])) {
    $id = $_POST['id'];


    $stmt = $conn->prepare("SELECT c.name, c.status, a.name as artist_name, m.name as manager_name, c.fee, c.date_start, c.date_end FROM users a INNER JOIN contracts c ON a.username = c.user_username INNER JOIN users m ON m.username = c.manager_username WHERE c.id = ?");
    $stmt->bind_param("s", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    $dataContract = mysqli_fetch_assoc($result);

    $rows = ["msg" => "success", "data" => $dataContract];
}

echo encrypt(json_encode($rows));
$conn->close();
