<?php
require "koneksi.php";

if (isset($_POST['submit'])) {
    $username = $_POST["username"];
    $nama = $_POST["nama"];
    $password = md5($_POST["password"]);
    $level = $_POST["level"];

    $checkQuery = "SELECT * FROM user WHERE username = '$username'";
    $result = $db->query($checkQuery);

    if ($result->num_rows > 0) {
        echo "Gagal Menambahkan Username, Username sudah ada.";
    } else {
        $insertQuery = "INSERT INTO user (username, nama, password, level) VALUES ('$username','$nama','$password','$level')";

        if ($db->query($insertQuery) == TRUE) {
            echo "User telah ditambahkan";
        } else {
            echo "Gagal Menambahkan User: " . $db->error;
        }
    }
}

?>
<div class="container">
    <h2 class="mt-5">Tambah User</h2>
    <form method="post" action="">
        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" class="form-control" name="username" required>
        </div>

        <div class="form-group">
            <label for="nama">Nama:</label>
            <input type="text" class="form-control" name="nama" required>
        </div>

        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" class="form-control" name="password" required>
        </div>

        <div class="form-group">
            <label for="level">Level:</label>
            <select class="form-control" name="level" required>
                <option value="">--Pilih Level--</option>
                <option value="mahasiswa">Mahasiswa</option>
                <option value="admin">Admin</option>
                <option value="dosen">Dosen</option>
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
            <th>Username</th>
            <th>nama</th>
            <th>Jabatan</th>
            <th>last Login</th>
            <?php
            if ($_SESSION['level'] == 'admin') { ?>
                <th>Aksi</th>
            <?php } ?>
        </tr>
    </thead>
    <tbody>
        <?php $nomor = 1;

        $query = "SELECT * FROM user ;";
        $result = $db->query($query);

        foreach ($result as $row): ?>
            <tr>
                <td>
                    <?= $nomor++ ?>
                </td>
                <td>
                    <?= $row['username'] ?>
                </td>
                <td>
                    <?= $row['nama'] ?>
                </td>
                <td>
                    <?= $row['level'] ?>
                </td>
                <td>
                    <?= $row['terakir_login'] ?>
                </td>

                <?php
                if ($_SESSION['level'] == 'admin') { ?>
                    <td>
                        <a class="badge bg-primary"
                            href="index.php?page=mahasiswa&aksi=edit&username=<?= $row['username'] ?>">Edit</a>
                        <a class="badge bg-danger" onclick="return confirm('Apakah Kamu Yakin Menghapusnya')"
                            href="tambahruangan.php?proses=delete&username=<?= $row['username'] ?>">Hapus</a>
                    </td>
                <?php } ?>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>

