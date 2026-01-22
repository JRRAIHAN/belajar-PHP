<!-- tambahkan database baru di localhost/phpmyadmin contoh buku_tamu -->

<?php 
$hostname = "localhost";
$username = "root";
$password = "";
$database_name = "buku_tamu";

$db = mysqli_connect($hostname, $username, $password, $database_name);

if ($db->connect_error){
    echo "koneksi databse rusak";
    die("error");
}
?>