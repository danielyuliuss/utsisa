<?php
require 'readapi.php';

$username = "";
if (isset($_GET['username'])) {
    $url = 'http://localhost/utsisa/showschedule.php';

    $username = $_GET['username'];

    // ambil username dari session lalu post data
    $data = ['username' => $username];
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
    <a href="tambahschedule.php?<?php echo "username=$username"; ?>" class="btn btn-primary ms-3">Tambah Jadwal Baru</a>
    <?php
    $dataSchedule = $data->data_schedules;

    echo "<div class='row justify-content-start'>";
    $i = 1;
    foreach ($dataSchedule as $jadwal) {
        $timestamp = strtotime($jadwal->date);
        $tanggal = date("d-m-Y", $timestamp);
        $jam = date("H:i", $timestamp);

        if ($i % 5 == 0) {
            echo "</div><div class='row'>";
        }
        echo '<div class="mt-3 ms-3 col">
            <div class="card mb-3" style="width: 18rem">
              <div class="card-body">
                <h5 class="card-title">' . $jadwal->name . '</h5>
                <p class="card-text mb-1">Tanggal : ' . $tanggal . '</p>
                <p class="card-text">Jam : ' . $jam . '</p>
                <a href="hapusschedule.php?id='.$jadwal->id.'&username='.$username.'" class="btn btn-danger">Hapus</a>
              </div>
            </div>
          </div>';
    }

    if ($i % 5 != 0) {
        echo "</div>";
    }

    ?>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>

</html>