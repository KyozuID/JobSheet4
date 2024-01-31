<?php

@include 'config.php';

if(isset($_POST['submit'])){

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = md5($_POST['password']);
    $cpass = md5($_POST['cpassword']);
    $user_type = $_POST['user_type'];

    $select = " SELECT * FROM user_form WHERE email = '$email' && password = '$pass' ";

    $result = mysqli_query($conn, $select);

    if(mysqli_num_rows($result) > 0){

        $error[] = 'user already exist!';

    }else{
        
        if($pass != $cpass){
            $error[] = 'password not matched!';
        }else{
             $insert = "INSERT INTO user_form(name, email, password, user_type) VALUES('$name','$email','$pass','$user_type')";
             mysqli_query($conn, $insert);
             header('location: index.php');
        }
    }
};

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Pendaftaran</title>

    <!-- custom css link -->
    <link rel="stylesheet" href="style.css">

</head>
<body>
    
<div class="form-container">

    <form action="" method="post">
        <h3>Daftar Sekarang</h3>
        <?php
        if(isset($error)){
            foreach($error as $error){
                echo '<span class="error-msg">'.$error.'</span>';
            };
        };
        ?>
        <input type="text" name="name" required placeholder="Masukkan nama anda">
        <input type="email" name="email" required placeholder="Masukkan email anda">
        <input type="password" name="password" required placeholder="masukkan password anda"> 
        <input type="password" name="cpassword" required placeholder="konfirmasi password anda">
        <select name="user_type">
            <option value="user">Pengguna</option>
        </select> 
        <input type="submit" name="submit" value="Daftar Sekarang" class="form-btn">
        <p>Sudah memiliki akun? <a href="JobSheet4/index.php">Masuk sekarang</a></p>
    </form>
</div>

</body>
</html>