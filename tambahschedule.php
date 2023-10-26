<?php 
    require 'readapi.php';

    if(isset($_POST['submit'])){
        $url = "http://localhost/utsisa/addschedule.php";
        $namaKegiatan = $_POST['nama'];
        $waktuKegiatan = date("Y-m-d H:i:s", strtotime($_POST['waktu']));
        
        $data = send_post($url, ["username"=>$_GET['username'], "name"=>$namaKegiatan, "datetime" => $waktuKegiatan]);

        header("location: ubahjadwal.php?username=".$_GET['username']);
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

    <form action="" method="post">
        <div class="container">
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="nama" name="nama" required/>
                <label for="nama">Nama Kegiatan</label>
            </div>
            <div class="form-floating mb-3">
                <input type="datetime-local" class="form-control" id="waktu" name="waktu" required/>
                <label for="waktu">Waktu Kegiatan</label>
            </div>
            <input type="hidden" name="username" value="<?php echo $_GET['username']; ?>">
            <button class="btn btn-success" type="submit" name="submit">Tambah Jadwal</button>
        </div>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>

</html>