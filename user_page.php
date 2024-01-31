<?php

@include 'config.php';

session_start();

if(!isset($_SESSION['user_name'])){
    header('location:login_form.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>halaman pengguna</title>
    
    <!-- custom css -->
    <link rel="stylesheet" href="style.css">

</head>
<body>
    
<div class="container">

    <div class="content">
        <h1>hi, <span>pengguna</span></h1>
        <h1>Selamat datang <span><?php echo $_SESSION['user_name'] ?></span></h1>
        <p>ini adalah halaman pengguna</p>
        <a href="index.php" class="btn">masuk</a>
        <a href="register_form.php" class="btn">daftar</a>
        <a href="logout.php" class="btn">keluar</a>
    </div>

</div>

</body>
</html>