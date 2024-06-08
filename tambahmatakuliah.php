<?php
require "koneksi.php";

if (isset($_POST['submit'])) {
    $id_matkul = $_POST["id_matkul"];
    $matakuliah = $_POST["matakuliah"];
    $id_dosen = $_POST["iddosen"];
    $sks = $_POST["sks"];
    $jam = $_POST["jam"];



    $checkQuery = "SELECT * FROM matakuliah WHERE id_matkul = '$id_matkul'";
    $result = $db->query($checkQuery);

    if ($result->num_rows > 0) {
        echo "Gagal Menambahkan Matakuliah, Kode Mata kuliah sudah ada.";
    } else {
        $query = "INSERT INTO matakuliah (nama_matkul, id_matkul,id_dosen,sks,jam) VALUES ('$matakuliah','$id_matkul','$id_dosen','$sks','$jam')";

    if ($db->query($query) == TRUE) {
        echo "Mata Kuliah telah ditambahkan";
    } else {
        echo "Gagal Menambahkan Username" . $db->error;
    }
    }
    
}
?>
<div class="container">
    <h2 class="mt-5">Tambah Mata Kuliah</h2>
    <form method="post" action="">
        <div class="form-group">
            <label for="username">Kode Matakuliah:</label>
            <input type="text" class="form-control" name="id_matkul" placeholder="JRK1" required>
        </div>

        <div class="form-group">
            <label for="nama">Nama Mata Kuliah:</label>
            <input type="text" class="form-control" name="matakuliah" placeholder="Jaringan Komputer" required>
        </div>
        <div class="form-group">
            <label for="nama">No Induk Dosen:</label>
            <select name="iddosen" class="form-select" required>
                <option value="" disabled selected>--Pilih No Induk Dosen--</option>
                <?php
                $dosen = mysqli_query($db, "SELECT * FROM dosen");
                while ($data_dosen = mysqli_fetch_array($dosen)) {
                    echo "<option value=" . $data_dosen['id_dosen'] . ">" . $data_dosen['id_dosen'] . " - " . $data_dosen['nama_dosen'] . "</option>";
                }
                ?>
            </select>
        </div>


        <div class="form-group">
            <label for="nama">SKS:</label>
            <input type="text" class="form-control" name="sks" placeholder="3" required>
        </div>
        <div class="form-group">
            <label for="nama">Jam:</label>
            <select name="jam" class="form-select" required>
                <option value="" disabled selected>--Pilih jam--</option>
                <?php
                $jam = mysqli_query($db, "SELECT * FROM jam");
                while ($data_jam = mysqli_fetch_array($jam)) {
                    $jam_mulai_selesai = $data_jam['jam_mulai'] . ' - ' . $data_jam['jam_selesai'];
                    echo "<option value='" . $jam_mulai_selesai . "'>" . $jam_mulai_selesai . "</option>";
                }
                ?>
            </select>

        </div>

        <button type="submit" name="submit" class="btn btn-primary">Tambah</button>
    </form>
</div>




<hr class="sidebar-divider d-none d-md-block">






<table id="example" class="table table-bordered table-info table-striped table-hover mt-5">
    <thead>
        <tr>
            <th>No</th>
            <th>Kode Mata Kuliah</th>
            <th>Mata Kuliah</th>
            <th>Dosen</th>
            <th>SKS</th>
            <th>Jam Mulai</th>
            <th>Jam Mulai</th>
            <?php
            if ($_SESSION['level'] == 'admin') { ?>
                <th>Aksi</th>
            <?php } ?>
        </tr>
    </thead>
    <tbody>
        <?php $nomor = 1;

        $query = "SELECT * FROM matakuliah JOIN dosen ON matakuliah.id_dosen = dosen.id_dosen JOIN jam ON matakuliah.kodejam=jam.kodejam ORDER BY matakuliah.nama_matkul ;";
        $result = $db->query($query);

        foreach ($result as $row): ?>
            <tr>
                <td>
                    <?= $nomor++ ?>
                </td>
                <td>
                    <?= $row['id_matkul'] ?>
                </td>
                <td>
                    <?= $row['nama_matkul'] ?>
                </td>
                <td>
                    <?= $row['nama_dosen'] ?>
                </td>
                <td>
                    <?= $row['sks'] ?>
                </td>
                <td>
                    <?= $row['jam_mulai'] ?>
                </td>
                <td>
                    <?= $row['jam_selesai'] ?>
                </td>

                <?php
                if ($_SESSION['level'] == 'admin') { ?>
                    <td>
                        <a class="badge bg-primary"
                            href="index.php?page=mahasiswa&aksi=edit&nim=<?= $row['id_matkul'] ?>">Edit</a>
                        <a class="badge bg-danger" onclick="return confirm('Apakah Kamu Yakin Menghapusnya')"
                            href="tambahruangan.php?proses=delete&nim=<?= $row['id_matkul'] ?>">Hapus</a>
                    </td>
                <?php } ?>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>