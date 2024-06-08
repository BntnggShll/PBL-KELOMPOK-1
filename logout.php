<?php
session_start();
include('koneksi.php');
$username = $_SESSION['username'];
$berhasil = true;
if($sql_login=mysqli_query($db, "UPDATE user SET terakir_login=now() WHERE username='$username'")){
    $_SESSION =[];
    session_unset();
    session_destroy();
    header("Location: login.php");
}