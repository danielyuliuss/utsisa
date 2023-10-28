<?php 
require '../encrypt.php';

$conn = mysqli_connect("localhost", "root", "", "utsisa");

if(isset($_POST['id']) && isset($_POST['res'])){
    $id = $_POST['id'];
    $res = $_POST['res'];

    $stmt = $conn->prepare("UPDATE contracts SET status = ? WHERE id = ?");

    if ($res == "terima"){
        $res = "accept";
    }elseif ($res == "tolak"){
        $res = "cancel";
    }

    $stmt->bind_param("ss", $res, $id);
    $stmt->execute();
}



?>