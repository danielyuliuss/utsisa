<?php
require '../encrypt.php';

$conn = mysqli_connect("localhost", "root", "", "utsisa");

if (isset($_POST['user_username'])) {

    $user_username = $_POST['user_username'];
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $user_username);
    $stmt->execute();
    $result = $stmt->get_result();

    $dataUser = $result->fetch_assoc();
    $rows = [];

    if (isset($dataUser['role'])) {
        if ($dataUser['role'] == 'artis') {
            $stmtSchedules = $conn->prepare("SELECT * FROM schedules WHERE user_username = ?");
            $stmtSchedules->bind_param("s", $user_username);
            $stmtSchedules->execute();
            $resultSchedules = $stmtSchedules->get_result();

            $dataSchedules = [];
            while ($row = mysqli_fetch_assoc($resultSchedules)) {
                $dataSchedules[] = $row;
            }

            $stmtContracts = $conn->prepare("SELECT * FROM contracts WHERE user_username = ?");
            $stmtContracts->bind_param("s", $user_username);
            $stmtContracts->execute();
            $resultContracts = $stmtContracts->get_result();

            $dataContracts = [];
            while ($row = mysqli_fetch_assoc($resultContracts)) {
                $dataContracts[] = $row;
            }

            $rows = ["msg" => "success", "data_schedules" => $dataSchedules, "data_contracts" => $dataContracts, "role" => $dataUser['role']];
        } else if ($dataUser['role'] == 'manager') {
            $stmtContracts = $conn->prepare("SELECT * FROM contracts WHERE manager_username = ?");
            $stmtContracts->bind_param("s", $user_username);
            $stmtContracts->execute();
            $resultContracts = $stmtContracts->get_result();

            $dataContracts = [];
            while ($row = mysqli_fetch_assoc($resultContracts)) {
                $dataContracts[] = $row;
            }

            $stmtUsers = $conn->prepare("SELECT * FROM users WHERE role = 'artis'");
            $stmtUsers->execute();
            $resultUsers = $stmtUsers->get_result();

            $dataUsers = [];
            while ($row = mysqli_fetch_assoc($resultUsers)) {
                $dataUsers[] = $row;
            }

            $rows = ["msg" => "success", "data_users" => $dataUsers, "data_contracts" => $dataContracts, "role" => $dataUser['role']];
        } else if ($dataUser['role'] == 'admin') {
            $stmtUsers = $conn->prepare("SELECT * FROM users");
            $stmtUsers->execute();
            $resultUsers = $stmtUsers->get_result();

            $dataUsers = [];
            while ($row = mysqli_fetch_assoc($resultUsers)) {
                $dataUsers[] = $row;
            }

            $rows = ["msg" => "success", "data_users" => $dataUsers, "role" => $dataUser['role']];
        }
    }else{
        $rows = ["msg" => "failed", "error" => "user not found"];
    }

} else {
    $rows = ["msg" => "failed", "error" => "noparam"];
    
}

echo encrypt(json_encode($rows));
$conn->close();
