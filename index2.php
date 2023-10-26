<?php
require 'readapi.php';
session_start();

//TESTING ONLY
$_SESSION['username'] = "artis";

// cek session apakah ada user login dengan key username
if (isset($_SESSION['username'])) {
    $url = 'http://localhost/utsisa/show_data.php';

    // ambil username dari session lalu post data
    $data = ['user_username' => $_SESSION['username']];
    $data = send_post($url, $data);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Artis</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
</head>

<body>
    <p class="fs-1 ms-3">Sistem Manajemen Artis Sederhana</p>
    <?php
    var_dump($data);
    if ($data->msg === "failed") {
        echo "<h1> Failed Get Data</h1>";
        exit;
    }
    // ambil role user untuk menentukan tampilan
    $roleUser =  $data->role;

    if ($roleUser === "artis") {

    } else if ($roleUser === "admin") {

        echo "<div class='row'>";

        $dataUsers = $data->data_users;
        $i = 1;
        foreach ($dataUsers as $user) {
            if ($i % 5 == 0) {
                echo "</div><div class='row'>";
            }

            $status = "";
            if ($user->is_active) {
                $status = '<p class="card-text" style="color:green;">Status: Akun Aktif </p>';
            } else {
                $status = '<p class="card-text" style="color:red;">Status: Akun Nonaktif </p>';
            }

            if ($_SESSION['username'] != $user->username) {
                echo '<div class="mt-3 ms-3 col">
                    <div class="card mb-3" style="width: 20rem">
                    <div class="card-body">
                        <h5 class="card-title"> Nama : ' . $user->name . '</h5>
                        <p class="card-text"> Username : ' . $user->username . '</p>
                        <p class="card-text"> Role : ' . ucwords($user->role) . '</p>
                        ' . $status . '
                        <a href="ubahstatus.php?username=' . $user->username . '" class="btn btn-primary"> Ubah Status</a>
                    </div>
                    </div>
                </div>';
                $i++;
            }
        }
        if ($i % 5 != 0) {
            echo "</div>";
        }
    } else if ($roleUser === "manager") {
        $dataUsers = $data->data_users;
        echo "<h2 class='ms-3'>Daftar Artis</h2>";
        echo "<div class='row'>";

        //Code Tampil Data Artis
        $i = 1;
        foreach ($dataUsers as $user) {
            if ($i % 5 == 0) {
                echo "</div><div class='row'>";
            }

            $status = "";
            if ($user->is_active) {
                $status = '<p class="card-text" style="color:green;">Status: Akun Aktif </p>';
            } else {
                $status = '<p class="card-text" style="color:red;">Status: Akun Nonaktif </p>';
            }

            if ($_SESSION['username'] != $user->username) {
                echo '<div class="mt-3 ms-3 col">
                    <div class="card mb-3" style="width: 20rem">
                    <div class="card-body">
                        <h5 class="card-title"> Nama Artis : ' . $user->name . '</h5>
                        <p class="card-text"> Role : ' . ucwords($user->role) . '</p>
                        ' . $status . '
                        <a href="ubahjadwal.php?username=' . $user->username . '" class="btn btn-primary"> Ubah Jadwal</a>
                    </div>
                    </div>
                </div>';
                $i++;
            }
        }
        if ($i % 5 != 0) {
            echo "</div>";
        }


        // Code Tampil Data Kontrak
        echo "<h2 class='ms-3'>Daftar Kontrak</h2>";
        echo "<div class='row'>";
        
        $dataKontrak = $data->data_contracts;
        $i = 1;
        foreach ($dataKontrak as $kontrak) {
            $dateStart = date("d-m-Y",strtotime($kontrak->date_start));
            $dateEnd = date("d-m-Y",strtotime($kontrak->date_end));

            $status = "";
            if ($kontrak->status == "accept") {
                $status = '<p class="card-text" style="color:green;">Status: Diterima </p>';
            } elseif ($kontrak->status == "cancel") {
                $status = '<p class="card-text" style="color:red;">Status: Ditolak </p>';
            } elseif ($kontrak->status == "pending"){
                $status = '<p class="card-text" style="color:blue;">Status: Pending </p>';
            }

            echo '<div class="mt-3 ms-3">
            <div class="card mb-3 me-3" style="width: 90%">
              <div class="card-body">
                <h5 class="card-title">'.$kontrak->name.'</h5>
                <p class="card-text mb-0">Tanggal Kontrak : '.$dateStart.' Sampai '.$dateEnd.'</p>
                <p class="card-text mb-0">Artis : '.$kontrak->user_username.'</p>
                <p class="card-text mb-0">Fee : Rp.'.$kontrak->fee.'</p>
                <p class="card-text">Manager : '.$kontrak->manager_username.'</p>
                <p class="card-text">'.$status.'</p>
              </div>
            </div>
          </div>';
        }
    }
    ?>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>

</html>