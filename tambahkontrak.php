<?php
require 'readapi.php';
session_start();

$usernameManager = $_SESSION['username'];

$urlArtist = "http://localhost/utsisa/showartists.php";
$data = [];
$resultArtists = send_post($urlArtist, $data);
$dataArtist = $resultArtists->data_users;

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $artistUsername = $_POST['username_artist'];
    $dateStart = date("Y-m-d", strtotime($_POST['dateStart']));
    $dateEnd = date("Y-m-d", strtotime($_POST['dateEnd']));
    $fee = $_POST['price'];

    $url = "http://localhost/utsisa/addcontract.php";
    $data = ["name" => $name, "artist_username" => $artistUsername, "date_start" => $dateStart, "date_end" =>  $dateEnd, "fee" => $fee, "manager_username" => $usernameManager];
    $resultAdd = send_post($url, $data);


    header("location: index.php");
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
                <input type="text" class="form-control" id="name" name="name" required/>
                <label for="name">Nama Kontrak</label>
            </div>
            <div class="form-floating mb-3">
                <select class="form-select" aria-label="Default select example" id="namaArtis" name="username_artist" required>
                    <option selected>Pilih artis</option>
                    <?php foreach ($dataArtist as $artist) : ?>;
                    <option value="<?php echo $artist->username; ?>"><?php echo $artist->name; ?></option>
                <?php endforeach; ?>
                </select>
                <label for="namaArtis">Nama Artis</label>
            </div>
            <div class="form-floating mb-3">
                <input type="number" class="form-control" id="number" name="price" required/>
                <label for="number">Nilai Kontrak</label>
            </div>
            <div class="form-floating mb-3">
                <input type="date" class="form-control" id="dateStart" name="dateStart" required/>
                <label for="dateStart">Tanggal Mulai</label>
            </div>
            <div class="form-floating mb-3">
                <input type="date" class="form-control" id="dateEnd" name="dateEnd" required/>
                <label for="dateEnd">Tanggal Selesai</label>
            </div>
            <button class="btn btn-success" type="submit" name="submit">Tambah Kontrak</button>
        </div>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>

</html>