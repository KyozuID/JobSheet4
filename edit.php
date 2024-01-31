<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "db_apotek";

// Create connection
$connection = new mysqli($servername, $username, $password, $database);

$id = "";
$nama = "";
$jenis = "";
$harga = "";
$produksi = "";
$kadaluarsa = "";

$pesanError = "";
$pesanBerhasil = "";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // GET method: Show the data of the obat

    if (!isset($_GET["id"])) {
        header("location: http://localhost/materi%20php/job%204/index.php");
        exit;
    }
    $id = $_GET["id"];

    // Read the row of the selected obat from database table
    $sql = "SELECT * FROM obat WHERE id=$id";
    $result = $connection->query($sql);
    $row = $result->fetch_assoc();

    if (!$row) {
        header("location: http://localhost/materi%20php/job%204/index.php");
        exit;
    }

    $nama = $row["nama_obat"];
    $jenis = $row["jenis_obat"];
    $harga = $row["harga"];
    $produksi = $row["tanggal_produksi"];
    $kadaluarsa = $row["tanggal_kadaluarsa"];
}
else {
    // POST method: Update the data of the obat

    $id = $_POST["id"];
    $nama = $_POST["nama"];
    $jenis = $_POST["jenis"];
    $harga = $_POST["harga"];
    $produksi = $_POST["produksi"];
    $kadaluarsa = $_POST["kadaluarsa"];

    do {
        if (empty($id) || empty($nama) || empty($jenis) || empty($harga) || empty($produksi) || empty($kadaluarsa)) {
            $pesanError = "Terdapat Error: Semua kolom harus diisi.";
            break;
        }

        $sql = "UPDATE obat" . "SET nama = '$nama', jenis = '$jenis', harga = '$harga', produksi = '$produksi', kadaluarsa = '$kadaluarsa'" . "WHERE id = $id";

        $result = $connection->query($sql);

        if (!$result) {
            $pesanError = "Gagal menambahkan obat: " . $connection->error;
            break;
        }

        $pesanBerhasil = "Obat berhasil ditambah.";

        header("location: http://localhost/materi%20php/job%204/index.php");
        exit;

    } while (true);

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apotek A24</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container my-5">
        <h2>Obat Baru</h2>
        

        <?php
       if (!empty($pesanError)) {
        echo "
            <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                <strong>$pesanError</strong>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='close'></button>
            </div>
        ";
    }
    
        ?>
        <form method="POST">
            <input type="hidden" name="id" values="<?php echo $id;?>">
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Nama Obat</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="nama" value="<?php echo $nama;?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Jenis Obat</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="jenis" value="<?php echo $jenis;?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Harga</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="harga" value="<?php echo $harga;?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Tanggal Produksi</label>
                <div class="col-sm-6">
                    <input type="date" class="form-control" name="produksi" value="<?php echo $produksi;?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Tanggal Kadaluarsa</label>
                <div class="col-sm-6">
                    <input type="date" class="form-control" name="kadaluarsa" value="<?php echo $kadaluarsa;?>">
                </div>
            </div>

            <?php
        if (!empty($pesanBerhasil)) {
            echo "
                <div class='row mb-3'>
                    <div class='alert alert-success alert-dismissible fade show' role='alert'>
                        <strong>$pesanBerhasil</strong>
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='close'></button>
                    </div>
                </div>
            ";
        }
        
            ?>

          


<div class="row mb-3">
    <div class="offset-sm-3 col-sm-3 d-grid">
        <button type="submit" class="btn btn-primary">Tambah</button>
    </div>
    <div class="col-sm-3 d-grid">
        <a class="btn btn-outline-primary" href="http://localhost/materi php/Job 4/index.php">Batal</a>
    </div>
</div>

        </form>
    </div>
</body>
</html>