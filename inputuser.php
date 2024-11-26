<?php 
// koneksi database
include 'koneksi.php';

// menangkap data yang di kirim dari form
$nama = $_POST['nama'];
$username = $_POST['username'];
$password = $_POST['password'];
$email = $_POST['email'];

// Prepare an SQL statement for execution to prevent SQL injection
mysqli_query($koneksi, "INSERT INTO user (nama, username, password, email) VALUES ('$nama', '$username', '$password', '$email')");

header("location: tampil.php");

?>