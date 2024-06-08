<?php
session_start();

include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password =md5($_POST['password']);

    $query = "SELECT * FROM user WHERE username = '$username' AND password = '$password'";
    $result = $db->query($query);

    if ($result->num_rows == 1) {
        $_SESSION['login'] = TRUE;
        $_SESSION['username'] = $username;
        $_SESSION['level'] = $result->fetch_assoc()['level'];  
        // Login berhasil, arahkan ke halaman lain
        header("Location: index.php");
        exit;
    } else {
        echo "Login gagal. Silakan coba lagi.";
    }
}
