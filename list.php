<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apotek A24</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container my-5">
        <h2>Data Obat</h2>
        <a class="btn btn-primary" href="http://localhost/JobSheet4/tambah.php" role="button">Obat Baru</a>
        <a class="btn btn-primary" href="http://localhost/JobSheet4/index.php" role="button">Keluar</a>
        <br>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Obat</th>
                    <th>Jenis Obat</th>
                    <th>Harga</th>
                    <th>Tanggal Produksi</th>
                    <th>Tanggal Kadaluarsa</th>
                    <th>Stok</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "db_apotek";

    $connection = new mysqli($servername, $username, $password, $database);

    if ($connection->connect_error){
        die("gagal terhubung : " . $connection->connect_error);
    }

    $sql = "SELECT * FROM obat";
    $result = $connection->query($sql);

    while($row = $result->fetch_assoc()){
        // Add "Rp" in front of the harga
        $formattedHarga = "Rp " . number_format($row['harga'], 0, ',', '.');

        echo "
            <tr>
                <td>{$row['id']}</td>
                <td>{$row['nama_obat']}</td>
                <td>{$row['jenis_obat']}</td>
                <td>{$formattedHarga}</td>
                <td>{$row['tanggal_produksi']}</td>
                <td>{$row['tanggal_kadaluarsa']}</td>
                <td>{$row['stok']}</td>
                <td>
                    <a class='btn btn-primary btn-sm' href='edit.php?id={$row['id']}'>Edit</a>
                    <a class='btn btn-danger btn-sm' href='hapus.php?id={$row['id']}'>Hapus</a>
                </td>
            </tr>
        ";
    }
    ?>
</tbody>
        </table>
    </div>
</body>
</html>
