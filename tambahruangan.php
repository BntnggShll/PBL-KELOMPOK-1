<?php
require "koneksi.php";

if (isset($_POST['submit'])) {
    $id_ruangan = $_POST["id_ruangan"];
    $ruangan = $_POST["ruangan"];


    $checkQuery = "SELECT * FROM ruangan WHERE id_ruangan = '$id_ruangan'";
    $result = $db->query($checkQuery);

    if ($result->num_rows > 0) {
        echo "Gagal Menambahkan Ruangan, Ruangan sudah ada.";
    } else {
        $query = "INSERT INTO ruangan (id_ruangan, ruangan) VALUES ('$id_ruangan','$ruangan')";

        if ($db->query($query) == TRUE) {
            echo "Ruangan telah ditambahkan";
        } else {
            echo "Gagal Menambahkan Username" . $db->error;
        }
    }


}
?>
<div class="container">
    <h2 class="mt-5">Tambah Ruangan</h2>
    <form method="post" action="">
        <div class="form-group">
            <label for="username">Kode Ruangan:</label>
            <input type="text" class="form-control" name="id_ruangan" required>
        </div>

        <div class="form-group">
            <label for="nama">Nama Ruangan:</label>
            <input type="text" class="form-control" name="ruangan" required>
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
            <th>Nama Ruangan</th>
            <?php
            if ($_SESSION['level'] == 'admin') { ?>
                <th>Aksi</th>
            <?php } ?>
        </tr>
    </thead>
    <tbody>
        <?php $nomor = 1;

        $query = "SELECT * FROM ruangan ORDER BY id_ruangan;";
        $result = $db->query($query);

        foreach ($result as $row): ?>
            <tr>
                <td>
                    <?= $nomor++ ?>
                </td>
                <td>
                    <?= $row['id_ruangan'] ?>
                </td>
                <td>
                    <?= $row['ruangan'] ?>
                </td>

                <?php
                if ($_SESSION['level'] == 'admin') { ?>
                    <td>
                        <a class="badge bg-primary"
                            href="index.php?page=mahasiswa&aksi=edit&nim=<?= $row['id_ruangan'] ?>">Edit</a>
                        <a class="badge bg-danger" onclick="return confirm('Apakah Kamu Yakin Menghapusnya')"
                            href="tambahruangan.php?proses=delete&nim=<?= $row['id_ruangan'] ?>">Hapus</a>
                    </td>
                <?php } ?>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>