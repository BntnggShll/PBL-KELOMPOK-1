<?php
require "koneksi.php";


if ($_GET['proses'] == 'update') {
    if (isset($_POST['submit'])) {
        $nama_mhs = $_POST['nama_mhs'];
        $alamat = $_POST['alamat'];
        $nim = $_POST['nim'];

        $tanggal = $_POST['tgl_lahir'];
        $bulan = $_POST['bln_lahir'];
        $tahun = $_POST['thn_lahir'];
        $tgl_lahir = $tahun . '-' . $bulan . '-' . $tanggal;

        $jenis_kelamin = $_POST['jenis_kelamin'];
        $prodi_id = $_POST['prodi_id'];
        $hobi = implode(",", $_POST['hobi']);


        $query = "UPDATE mahasiswa SET nama_mhs='$nama_mhs', tgl_lahir='$tgl_lahir', jenis_kelamin='$jenis_kelamin',prodi_id='$prodi_id', hobi='$hobi', alamat='$alamat' WHERE nim=$nim";

        if ($db->query($query) == TRUE) {
            header("Location: index.php?page=mahasiswa");
        } else {
            echo "Gagal Update Data" . $db->error;
        }
    }
    //memisahkan tanggal
    list($tahun, $bulan, $tgl_lahir) = explode('-', $row['tgl_lahir']);
}

if ($_GET['proses'] == 'delete') {

    require 'koneksi.php';

    $get_nim = $_GET['nim'];

    $sql = "DELETE FROM mahasiswa WHERE nim=$get_nim";

    if ($db->query($sql) == TRUE) {
        header("Location: index.php?page=mahasiswa");
    } else {
        echo "Gagal menghapus data" . $db->error;
    }
}
?>