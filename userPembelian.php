<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form dengan Opsi dari Database</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
            display: flex;
            height: 100vh;
        }

        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 50%;
            height: 60%;
            align-items: center;
            justify-content: center;
            margin: auto;
        }

        .form-group {
            margin-bottom: 20px;
            
        }

        .form-label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
            color: #333;
        }

        h2 {
            font-size: 40px;
            align-items: center;
            justify-content: center;
            padding-left: 30%;
        }

        .form-control {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 14px;
        }

        .btn-primary,
        .btn-secondary {
            display: inline-block;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            text-align: center;
            text-decoration: none;
            transition: background-color 0.3s ease;
            color: #fff;
        }

        .btn-primary {
            background-color: #007bff;
        }

        .btn-secondary {
            background-color: #6c757d;
            margin-left: 10px;
        }

        .btn-primary:hover,
        .btn-secondary:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "db_apotek";
    
    $connection = new mysqli($servername, $username, $password, $database);
    ?>

<div class="container">
    <form action="userBerhasil.php" method="post">
            <h2>Pebelian Obat</h2>
            <div class="form-group">
                <label for="namaPembeli" class="form-label">Nama Pembeli:</label>
                <input type="text" name="namaPembeli" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="selectOption" class="form-label">Obat:</label>
                <select name="selectOption" id="selectOption" class="form-control">
                    <option value="">Pilih Obat</option>
                    <?php
                    $query = "SELECT id, nama_obat FROM obat";
                    $result = $connection->query($query);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value='" . $row["id"] . "'>" . htmlentities($row["nama_obat"]) . "</option>";
                        }
                    } else {
                        echo "<option value=''>Tidak ada opsi</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="jumlah" class="form-label">Jumlah:</label>
                <input type="number" name="jumlah" class="form-control" required>
            </div>
            <div class="form-group">
                <input type="submit" value="Beli" class="btn-primary">
                <a href="userWeb.php" class="btn-secondary">Batal</a>
            </div>
        </form>
    </div>

    <?php
    $connection->close();
    ?>
</body>
</html>
