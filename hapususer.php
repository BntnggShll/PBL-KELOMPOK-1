
    <h1 class="text-center">Hapus User</h1>
    <div class="container mt-5">
        <h2>Search User</h2>

        <form method="post" action="" class="mb-4">
            <div class="form-group">
                <label for="carinama">Cari Berdasarkan Nama:</label>
                <input type="text" class="form-control" name="carinama" required>
            </div>
            <button type="submit" class="btn btn-primary">Cari</button>
       

        <?php
        require "koneksi.php";

        if (isset($_POST["carinama"])) {
            $searchUsername = $_POST["carinama"];

            // Use prepared statement to prevent SQL injection
            $query = "SELECT * FROM user WHERE nama LIKE ? ORDER BY nama";
            $stmt = $db->prepare($query);
            $stmt->bind_param("s", $searchUsername);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                ?>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Username</th>
                            <th>Nama</th>
                            <th>Jabatan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result->fetch_assoc()) { ?>
                            <tr>
                                <td><?= $row["username"] ?></td>
                                <td><?= $row["nama"] ?></td>
                                <td><?= $row["level"] ?></td>
                                <td>
                                        <input type="hidden" name="hapusUsername" value="username=<?= $row['username'] ?>">
                                       <a href="proseshapus.php?id_hapus=<?= $row['username'] ?>" class="badge bg-danger" onclick="return confirm('Apakah Kamu Yakin Menghapusnya,Menghapus User Akan Menghapus Data Yang berkaitan dengan user')">Hapus</a>
                                       
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                </form> 
            <?php
            } else {
                echo '<p>Tidak Ditemukan Data.</p>';
            }
        }
        ?>

    </div>

