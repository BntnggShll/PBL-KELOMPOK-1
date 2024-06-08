<?php
include 'koneksi.php';
session_start();

if (!isset($_SESSION['username'])) {
    echo "Sesi username tidak ditemukan. Lakukan aksi yang sesuai.";
    exit();
}

$username = $_SESSION['username'];

$userToDelete = $_GET['id_hapus'];

if ($userToDelete == $username) {
    echo 'Tidak Bisa menghapus akun sendiri.';
} else {
    $sql = "DELETE FROM user WHERE username='$userToDelete'";

    if ($db->query($sql) === TRUE) {
        header('location:index.php?page=hapususer');
    } else {
        echo "Gagal menghapus data: " . $db->error;
    }
}

$db->close();
?>
