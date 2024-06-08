<?php
require "koneksi.php";

$aksi = isset($_GET['aksi']) ? $_GET['aksi'] : 'list';

switch ($aksi) {
    case 'list':

        if (isset($_POST['submit'])) {
        $user = $_SESSION['username'];
        $nim_query = "SELECT nim FROM mahasiswa WHERE username='$user'";
        $result_nim = mysqli_query($db, $nim_query);
        
        if ($result_nim) {
            $data_nim = mysqli_fetch_assoc($result_nim);
            $nim = $data_nim['nim'];
            $id_matkul = $_POST["id_matkul"];
            $waktu = date("Y-m-d H:i:s");
        
            $query = "UPDATE absen SET jumlah_kehadiran = jumlah_kehadiran + 1 , waktu='$waktu' WHERE nim = '$nim' AND id_matkul = '$id_matkul'";
            $result_query = $db->query($query);
        
            echo $result_query ? "Anda telah mengisi Absensi" : "Gagal mengisi Absensi" . $db->error;
        } else {
            echo "Gagal mengambil data NIM" . mysqli_error($db);
        }
    }
        ?>
        <div class="container">
            <h3>Apakah Anda Sudah Diruangan?</h3>
            <form method="post" action="">
                <div class="form-group">
                    <label for="id_matkul">Nama Matakuliah</label>
                    <select name="id_matkul" class="form-select" required>
                        <option value="" disabled selected>--Nama Matakuliah--</option>
                        <?php
                        $matkul = mysqli_query($db, "SELECT * FROM matakuliah");
                        while ($data_matkul = mysqli_fetch_array($matkul)) {
                            echo "<option value=" . $data_matkul['id_matkul'] . ">" . $data_matkul['id_matkul'] . " - " . $data_matkul['nama_matkul'] . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <button type="submit" name="submit" class="btn btn-primary">Hadir</button>
            </form>
        </div>

        <?php
        break;
    case "dosen": 

    if (isset($_POST['submit'])) {
        $user = $_SESSION['username'];
        $nim_query = "SELECT id_dosen FROM dosen WHERE username='$user'";
        $result_nim = mysqli_query($db, $nim_query);
        
        if ($result_nim) {
            $data_nim = mysqli_fetch_assoc($result_nim);
            $id_dosen = $data_nim['id_dosen'];
            $id_matkul = $_POST["id_matkul"];
            $waktu = date("Y-m-d H:i:s");
        
            $query = "INSERT INTO absensi ";
            $result_query = $db->query($query);
        
            echo $result_query ? "Anda telah mengisi Absensi" : "Gagal mengisi Absensi" . $db->error;
        } else {
            echo "Gagal mengambil data NIM" . mysqli_error($db);
        }
    }
        ?>

<div class="container">
            <form method="post" action="">
                <div class="form-group">
                    <label for="id_matkul">Nama Matakuliah</label>
                    <select name="id_matkul" class="form-select" required>
                        <option value="" disabled selected>--Nama Matakuliah--</option>
                        <?php
                        $matkul = mysqli_query($db, "SELECT * FROM matakuliah");
                        while ($data_matkul = mysqli_fetch_array($matkul)) {
                            echo "<option value=" . $data_matkul['id_matkul'] . ">" . $data_matkul['id_matkul'] . " - " . $data_matkul['nama_matkul'] . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <button type="submit" name="submit" class="btn btn-primary">Hadir</button>
            </form>
        </div>


        <?php

        break;

} ?>