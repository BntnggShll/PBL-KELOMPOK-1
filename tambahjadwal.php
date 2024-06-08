<?php
require "koneksi.php";

if (isset($_POST['submit'])) {
    $kode_jadwal = $_POST["kode_jadwal"];
    $id_matkul = $_POST["id_matkul"];
    $kodehari = $_POST["kodehari"];
    $kodejam = $_POST["kodejam"];
    $id_ruangan = $_POST["id_ruangan"];
    $id_thn_ajaran = $_POST["id_thn_ajaran"];
    $id_kelas = $_POST["id_kelas"];

    $checkQuery = "SELECT * FROM jadwal WHERE kode_jadwal = '$kode_jadwal' ";
    $checkResult = mysqli_query($db, $checkQuery);
    if (mysqli_num_rows($checkResult) > 0) {
        echo "Gagal Menambahkan Jadwal, Jadwal sudah ada.";
    } else {
        $query = "INSERT INTO jadwal (kode_jadwal,id_matkul,kodehari,kodejam,id_ruangan,id_thn_ajaran,id_kelas) VALUES ('$kode_jadwal','$id_matkul','$kodehari','$kodejam','$id_ruangan','$id_thn_ajaran','$id_kelas')";

        if ($db->query($query) == TRUE) {
            echo "Jadwal telah ditambahkan";
        } else {
            echo "Gagal Menambahkan Jadwal" . $db->error;
        }
    }

}
?>
<div class="container">
    <h2 class="mt-5">Tambah Jadwal</h2>
    <form method="post" action="">
        <div class="form-group">
            <label for="kode_jadwal">Kode Jadwal</label>
            <input type="text" class="form-control" name="kode_jadwal" placeholder="ETC3102" required>
        </div>

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

        <div class="form-group">
            <label for="kodehari">Hari</label>
            <select name="kodehari" class="form-select" required>
                <option value="" disabled selected>-- Hari --</option>
                <?php
                $hari = mysqli_query($db, "SELECT * FROM hari");
                while ($data_hari = mysqli_fetch_array($hari)) {
                    echo "<option value=" . $data_hari['codehari'] . ">" . $data_hari['hari'] . "</option>";
                }

                ?>
            </select>

        </div>
        <div class="form-group">
            <label for="kodejam">Jam</label>
            <select name="kodejam" class="form-select" required>
                <option value="" disabled selected>--Jam--</option>
                <?php
                $jam = mysqli_query($db, "SELECT * FROM jam");
                while ($data_jam = mysqli_fetch_array($jam)) {
                    echo "<option value=" . $data_jam['kodejam'] . ">" . $data_jam['jam_mulai'] . " - " . $data_jam['jam_selesai'] . "</option>";
                }
                
                ?>
            </select>

        </div>
        <div class="form-group">
            <label for="id_ruangan">Ruangan</label>
            <select name="id_ruangan" class="form-select" required>
                <option value="" disabled selected>--Ruangan--</option>
                <?php
                $ruangan = mysqli_query($db, "SELECT * FROM ruangan");
                while ($data_ruangan = mysqli_fetch_array($ruangan)) {
                    echo "<option value=" . $data_ruangan['id_ruangan'] . ">" . $data_ruangan['ruangan'] .  "</option>";
                }
                
                ?>
            </select>

        </div>
        <div class="form-group">
            <label for="id_thn_ajaran">Tahun Ajaran</label>
            <select name="id_thn_ajaran" class="form-select" required>
                <option value="" disabled selected>--Tahun Ajaran--</option>
                <?php
                $tahun_ajaran = mysqli_query($db, "SELECT * FROM tahun_ajaran");
                while ($data_tahun_ajaran = mysqli_fetch_array($tahun_ajaran)) {
                    echo "<option value=" . $data_tahun_ajaran['id_thn_ajaran'] . ">" . $data_tahun_ajaran['thn_ajaran'] . " - " . $data_tahun_ajaran['semester'] . "</option>";
                }
                
                ?>
            </select>

        </div>
        <div class="form-group">
            <label for="id_kelas">Kelas</label>
            <select name="id_kelas" class="form-select" required>
                <option value="" disabled selected>--Kelas--</option>
                <?php
                $kelas = mysqli_query($db, "SELECT * FROM kelas");
                while ($data_kelas = mysqli_fetch_array($kelas)) {
                    echo "<option value=" . $data_kelas['id_kelas'] . ">" . $data_kelas['id_kelas'] . " - " . $data_kelas['kelas'] . "</option>";
                }
                
                ?>
            </select>

        </div>


        <button type="submit" name="submit" class="btn btn-primary">Tambah</button>
    </form>
</div>