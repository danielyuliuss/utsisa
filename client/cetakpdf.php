<?php
require 'readapi.php';

session_start();
if (!isset($_SESSION["username"])) {
    header("location: login.php");
}

if (isset($_GET["id"])) {
    $url = "http://localhost/utsisa/server/readdetailcontract.php";
    $data = ["id" => $_GET["id"]];

    $data = send_post($url, $data)->data;
}else{
    header("location: index.php");
}

$status = "";
if ($data->status == "pending") {
    $status = "<span style ='color:blue;'>Pending</span>";
} else if ($data->status == "cancel") {
    $status = "<span style ='color:red;'>Dibatalkan</span>";
} else if ($data->status == "accept") {
    $status = "<span style ='color:green;'>Diterima</span>";
}

?>

<h1><?= $data->name; ?></h1>

<h3>Status Kontrak : <?= $status; ?></h3>

<h3>Nama Artis : <?= $data->artist_name; ?></h3>
<h3>Nama Manajer : <?= $data->manager_name; ?></h3>
<h3>Nilai Kontrak : Rp.<?= $data->fee; ?></h3>
<h3>Tanggal Mulai Kontrak : <?= date("d-m-Y", strtotime($data->date_start)); ?></h3>
<h3>Tanggal Akhir Kontrak : <?= date("d-m-Y", strtotime($data->date_end)); ?></h3>

<p>Tanggal PDF dibuat : <?= date("d-m-Y H:i:s"); ?></p>

<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>

<script>
    $(document).ready(function() {
        window.print();
    })
</script>