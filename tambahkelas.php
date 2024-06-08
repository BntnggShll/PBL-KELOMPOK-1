<?php
require "koneksi.php";

if (isset($_POST['submit'])) {
    $kodekelas = $_POST["KodeKelas"];
    $jurusan = $_POST["Jurusan"];
    $prodi = $_POST["Prodi"];
    $kelas = $_POST["Kelas"];

    $checkQuery = "SELECT * FROM kelas WHERE id_kelas = '$kodekelas'";
    $result = $db->query($checkQuery);

    if ($result->num_rows > 0) {
        echo "Gagal Menambahkan Kelas, Kelas sudah ada.";
    } else {
        $query = "INSERT INTO kelas (id_kelas, jurusan,prodi,kelas) VALUES ('$kodekelas','$jurusan','$prodi','$kelas')";

        if ($db->query($query) == TRUE) {
            echo "Kelas telah ditambahkan";
        } else {
            echo "Gagal Menambahkan Kelas" . $db->error;
        }
    }
}
?>
<div class="container">
    <h2 class="mt-5">Tambah Kelas</h2>
    <form method="post" action="">
        <div class="form-group">
            <label for="Kode Kelas">Kode Kelas</label>
            <input type="text" class="form-control" name="KodeKelas" placeholder="MI2A22" required>
        </div>
        <div class="form-group">
            <label for="Jurusan">Jurusan</label>
            <input type="text" class="form-control" name="Jurusan" placeholder="Teknologi Informasi" required>
        </div>
        <div class="form-group">
            <label for="Prodi">Prodi</label>
            <input type="text" class="form-control" name="Prodi" placeholder="Manajement Informatika" required>
        </div>
        <div class="form-group">
            <label for="Kelas">Kelas</label>
            <input type="text" class="form-control" name="Kelas" placeholder="MI2A" required>
        </div>


        <button type="submit" name="submit" class="btn btn-primary">Tambah</button>
    </form>
</div>

<hr class="sidebar-divider d-none d-md-block">






<table id="example" class="table table-bordered table-info table-striped table-hover mt-5">
    <thead>
        <tr>
            <th>No</th>
            <th>Kode Kelas</th>
            <th>Jurusan</th>
            <th>Prodi</th>
            <th>Kelas</th>
            <?php
            if ($_SESSION['level'] == 'admin') { ?>
                <th>Aksi</th>
            <?php } ?>
        </tr>
    </thead>
    <tbody>
        <?php $nomor = 1;

        $query = "SELECT * FROM kelas ;";
        $result = $db->query($query);

        foreach ($result as $row): ?>
            <tr>
                <td>
                    <?= $nomor++ ?>
                </td>
                <td>
                    <?= $row['id_kelas'] ?>
                </td>
                <td>
                    <?= $row['jurusan'] ?>
                </td>
                <td>
                    <?= $row['prodi'] ?>
                </td>
                <td>
                    <?= $row['kelas'] ?>
                </td>

                <?php
                if ($_SESSION['level'] == 'admin') { ?>
                    <td>
                        <a class="badge bg-primary"
                            href="index.php?page=mahasiswa&aksi=edit&id_kelas=<?= $row['id_kelas'] ?>">Edit</a>
                        <a class="badge bg-danger" onclick="return confirm('Apakah Kamu Yakin Menghapusnya')"
                            href="tambahruangan.php?proses=delete&id_kelas=<?= $row['id_kelas'] ?>">Hapus</a>
                    </td>
                <?php } ?>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>