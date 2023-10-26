<?php
require 'encrypt.php';

$conn = mysqli_connect("localhost", "root", "", "utsisa");

$rows = [];
if (isset($_POST['name'])) {
    $name = $_POST['name'];
    $username_artist = $_POST['artist_username'];
    $dateStart = $_POST['date_start'];
    $dateEnd = $_POST['date_end'];
    $fee = $_POST['fee'];
    $manager_username = $_POST['manager_username'];
    $status = "pending";


    $stmt = $conn->prepare("INSERT INTO contracts (name,status, user_username, date_start, date_end, fee, manager_username) VALUES (?,?,?,?,?,?,?)");
    $stmt->bind_param("sssssss", $name, $status, $username_artist, $dateStart, $dateEnd, $fee, $manager_username);
    $stmt->execute();

    $rows = ["msg" => "success"];
}

echo encrypt(json_encode($rows));
$conn->close();
