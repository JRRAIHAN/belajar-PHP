<?php 
    include "service/database.php";
    session_start();

    // ini agar setelah login tidak bisa masuk lagi ke login
    if (isset($_SESSION["is_login"])){
        header("location: dashboard.php");
    }

    $login_message = "";

    if(isset($_POST['login'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $hash_password = hash("sha256", $password);
        echo $username . ' ' . $password;
    }

    $sql = "SELECT * FROM users WHERE username= '$username' AND password= '$hash_password'";
    
    $result = $db->query($sql);

    if($result->num_rows > 0){
        // artinya untuk keluarin hasil dari data base
        $data = $result->fetch_assoc();
        // test data
        echo $data['username'];
        echo $data['password']; 

        echo "datanya ada";
        // sebelum pergi ke dashboard kita buat sesi
        $_SESSION["username"] = $data["username"];
        $_SESSION["is_login"] = true;
        header("location: dashboard.php");
    }else{
        $login_message = "akun tidak ditemukan";
    }$db->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <?php include "layout/header.html" ?>
    <h3>Masuk Akun</h3>
    <i> <?= $login_message ?></i>
    <form action="login.php" method="POST">
        <input type="text" name="username" placeholder="username">
        <input type="password" name="password" placeholder="password">
        <button type="submit" name="login">Masuk Sekarang</button>
    </form>
    <?php include "layout/footer.html" ?>
</body>
</html>