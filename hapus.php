<?php
if (isset($_GET["id"])) {
    $id = $_GET["id"];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "db_apotek";

    $connection = new mysqli($servername, $username, $password, $database);

    $sql = "DELETE FROM obat WHERE id=$id";
    $result = $connection->query($sql);
}

header("location: http://localhost/JobSheet4/list.php");
exit;
?>