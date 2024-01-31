<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "db_apotek";

$connection = new mysqli($servername, $username, $password, $database);

$nama = "";
$jenis = "";
$harga = "";
$produksi = "";
$kadaluarsa = "";

$pesanError = "";
$pesanBerhasil = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $jenis = $_POST['jenis'];
    $harga = $_POST['harga'];
    $produksi = $_POST['produksi'];
    $kadaluarsa = $_POST['kadaluarsa'];

    if (empty($nama) || empty($jenis) || empty($harga) || empty($produksi) || empty($kadaluarsa)) {
        $pesanError = "Terdapat Error: Semua kolom harus diisi.";
    } else {
        $sql = "INSERT INTO obat (nama_obat, jenis_obat, harga, tanggal_produksi, tanggal_kadaluarsa) " .
            "VALUES ('$nama', '$jenis', '$harga', '$produksi', '$kadaluarsa')";
        
        $result = $connection->query($sql);

        if ($result) {
            $pesanBerhasil = "Obat berhasil ditambah.";
        } else {
            $pesanError = "Gagal menambahkan obat: " . $connection->error;
        }

        // Reset form fields
        $nama = "";
        $jenis = "";
        $harga = "";
        $produksi = "";
        $kadaluarsa = "";

        header("location: http://localhost/JobSheet4/");
        exit;
    }
}

// Close the database connection
$connection->close();
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
        <a class="btn btn-outline-primary" href="http://localhost/JobSheet4/index.php">Batal</a>
    </div>
</div>

        </form>
    </div>
</body>
</html>