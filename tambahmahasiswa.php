<?php
require "koneksi.php";

if (isset($_POST['submit'])) {
    $username = $_POST["username"];
    $nama = $_POST["nama"];
    $nim = $_POST["nim"];
    $id_kelas = $_POST["id_kelas"];
    $jenis_kelamin = $_POST["jenis_kelamin"];

    $checkQuery = "SELECT * FROM mahasiswa WHERE username = '$username' OR nim = '$nim'";
    $checkResult = mysqli_query($db, $checkQuery);
    if (mysqli_num_rows($checkResult) > 0) {
        echo "Gagal Menambahkan Mahasiswa, Username atau Nim sudah ada.";
    } else {
        $query = "INSERT INTO mahasiswa (username, nama,nim,id_kelas,jenis_kelamin) VALUES ('$username','$nama','$nim','$id_kelas','$jenis_kelamin')";

        if ($db->query($query) == TRUE) {
            echo "Mahasiswa telah ditambahkan";
        } else {
            echo "Gagal Menambahkan mahasiswa" . $db->error;
        }
    }
}
?>
<div class="container">
    <h2 class="mt-5">Tambah Mahasiswa</h2>
    <form method="post" action="">
        <div class="form-group">
            <label for="username">Username</label>
            <select name="username" class="form-select" required>
                <option value="" disabled selected>--Pilih Username--</option>
                <?php
                $username = mysqli_query($db, "SELECT username, nama FROM user");
                while ($data_username = mysqli_fetch_array($username)) {
                    echo "<option value=" . $data_username['username'] . ">" . $data_username['username'] . " - " . $data_username['nama'] . "</option>";
                }
                ?>
            </select>

        </div>
        <div class="form-group">
            <label for="nama">Nama Mahasiswa</label>
            <input type="text" class="form-control" name="nama" placeholder="Bintang Suhel" required>
        </div>

        <div class="form-group">
            <label for="nim">NIM</label>
            <input type="text" class="form-control" name="nim" placeholder="2201092028" required>
        </div>
        <div class="form-group">
            <label for="id_kelas">Kelas</label>
            <select name="id_kelas" class="form-select" required>
                <option value="" disabled selected>--Pilih Kelas--</option>
                <?php
                $kelas = mysqli_query($db, "SELECT * FROM kelas");
                while ($data_kelas = mysqli_fetch_array($kelas)) {
                    echo "<option value=" . $data_kelas['id_kelas'] . ">" . $data_kelas['id_kelas'] . "</option>";
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="jenis_kelamin">Jenis Kelamin</label>
            <select name="jenis_kelamin" class="form-select" required>
                <option value="" disabled selected>--Pilih jenis kelamin--</option>
                <option value="L">Pria</option>
                <option value="P">Wanita</option>
            </select>
        </div>


        <button type="submit" name="submit" class="btn btn-primary">Tambah</button>
    </form>
</div>