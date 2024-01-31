<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

$servername = "localhost";
$username = "root";
$password = "";
$database = "db_apotek";

$connection = new mysqli($servername, $username, $password, $database);

$id = "";
$nama = "";
$jenis = "";
$harga = "";
$produksi = "";
$kadaluarsa = "";
$stok = "";

$pesanError = "";
$pesanBerhasil = "";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (!isset($_GET["id"])) {
        header("location: http://localhost/JobSheet4/list.php");
        exit;
    }

    $id = $_GET["id"];

    // Read the row of the selected obat from the database table
    $sql = "SELECT * FROM obat WHERE id = ?";
    $stmt = $connection->prepare($sql);

    if (!$stmt) {
        die("Error preparing statement: " . $connection->error);
    }

    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if ($row) {
        $nama = htmlspecialchars($row["nama_obat"]);
        $jenis = htmlspecialchars($row["jenis_obat"]);
        $harga = $row["harga"];
        $produksi = $row["tanggal_produksi"];
        $kadaluarsa = $row["tanggal_kadaluarsa"];
        $stok = $row["stok"];
    } else {
        header("location: http://localhost/JobSheet4/list.php");
        exit;
    }

    $stmt->close();
} elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST["id"];
    $nama = $_POST["nama"];
    $jenis = $_POST["jenis"];
    $harga = $_POST["harga"];
    $produksi = $_POST["produksi"];
    $kadaluarsa = $_POST["kadaluarsa"];
    $stok = $_POST["stok"];


    if (empty($id) || empty($nama) || empty($jenis) || empty($harga) || empty($produksi) || empty($kadaluarsa) || empty($stok)) {
        $pesanError = "Terdapat Error: Semua kolom harus diisi.";
    } else {
        // Update operation
        $sql = "UPDATE obat SET nama_obat = ?, jenis_obat = ?, harga = ?, tanggal_produksi = ?, tanggal_kadaluarsa = ?, stok = ? WHERE id = ?";
        $stmt = $connection->prepare($sql);

        if (!$stmt) {
            die("Error preparing statement: " . $connection->error);
        }

        $stmt->bind_param("ssdss", htmlspecialchars($nama), htmlspecialchars($jenis), $harga, $produksi, $kadaluarsa, $stok, $id);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            $pesanBerhasil = "Obat berhasil diupdate.";
        } else {
            $pesanError = "Gagal mengupdate obat: " . $stmt->error;
        }

        $stmt->close();
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
    <title>Update Obat</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="container my-5">
        <h2>Update Obat</h2>

        <?php
        if (!empty($pesanError)) {
            echo "
                <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                    <strong>$pesanError</strong>
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='close'></button>
                </div>
            ";
        }

        if (!empty($pesanBerhasil)) {
            echo "
                <div class='alert alert-success alert-dismissible fade show' role='alert'>
                    <strong>$pesanBerhasil</strong>
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='close'></button>
                </div>
            ";
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // ... (your existing POST handling code)
        
            // After updating, redirect to the main page
            echo '<script>window.location.href = "list.php";</script>';
        }
        ?>

        <form method="POST">
            <input type="hidden" name="id" value="<?php echo $id; ?>">

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Nama Obat</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="nama" value="<?php echo $nama; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Jenis Obat</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="jenis" value="<?php echo $jenis; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Harga</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="harga" value="<?php echo $harga; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Tanggal Produksi</label>
                <div class="col-sm-6">
                    <input type="date" class="form-control" name="produksi" value="<?php echo $produksi; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Tanggal Kadaluarsa</label>
                <div class="col-sm-6">
                    <input type="date" class="form-control" name="kadaluarsa" value="<?php echo $kadaluarsa; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Stok</label>
                <div class="col-sm-6">
                <input type="number" class="form-control" name="stok" value="<?php echo $stok; ?>">

                </div>
            </div>

            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a class="btn btn-outline-primary" href="http://localhost/JobSheet4/list.php">Batal</a>
                </div>
            </div>
        </form>
    </div>
</body>
</html>
