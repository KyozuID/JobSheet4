<?php

@include 'config.php';

session_start();

if(!isset($_SESSION['admin_name'])){
    header('location:index.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Admin</title>
    
    <!-- custom css -->
    <link rel="stylesheet" href="style.css">

</head>
<body>
    
<div class="container">

    <div class="content">
        <h1>Hi, <span><?php echo $_SESSION['admin_name'] ?></span></h1>
        <h1>Selamat Datang Di A24</h1>
        <p></p>
        <a href="list.php  " class="btn">masuk</a>
        <a href="index.php" class="btn">keluar</a>
    </div>

</div>

</body>
</html>