<?php
session_start();

$host = "localhost";
$user = "root";
$pass = "";
$db   = "praktikum_db";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) { 
    die("Koneksi database gagal: " . mysqli_connect_error()); 
}

function cek_login() {
    global $conn; 
    if (!isset($_SESSION['user_id'])) { 
        header("Location: login.php"); 
        exit; 
    }
}
?>