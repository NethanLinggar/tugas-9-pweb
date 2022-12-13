<?php
$host = "localhost"; // Nama hostnya
$username = "user_pweb"; // Username
$password = "admin123"; // Password 
$database = "tugas_foto_pweb"; // Nama databasenya
// Koneksi ke MySQL dengan PDO
$pdo = null;
try{
    $pdo = new PDO('mysql:host=' . $host . ';dbname=' . $database, $username, $password);
    // $db = mysqli_connect($host, $username, $password, $password);
}
catch(PDOException $e){
    echo('Connecition failed');
}
?>