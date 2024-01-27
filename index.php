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
        <h2>List Obat</h2>
        <a class="btn btn-primary" href="http://localhost/materi%20php/crud/create.php" role="button">Obat Baru</a>
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
                    <th>Action</th>
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
                    echo "
                        <tr>
                            <td>{$row['id']}</td>
                            <td>{$row['nama_obat']}</td>
                            <td>{$row['jenis_obat']}</td>
                            <td>{$row['harga']}</td>
                            <td>{$row['tanggal_produksi']}</td>
                            <td>{$row['tanggal_kadaluarsa']}</td>
                            <td>
                                <a class='btn btn-primary btn-sm' href='/db_apotek/edit.php?id={$row['id']}'>Edit</a>
                                <a class='btn btn-danger btn-sm' href='/db_apotek/delete.php?id={$row['id']}'>Hapus</a>
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
