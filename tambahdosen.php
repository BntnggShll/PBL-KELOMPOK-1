<?php
require "koneksi.php";

if (isset($_POST['submit'])) {
    $id_dosen = $_POST["id_dosen"];
    $username = $_POST["username"];
    $nama_dosen = $_POST["nama_dosen"];
    $bidang_studi = $_POST["bidang_studi"];
    $email = $_POST["email"];
    $no_telp = $_POST["no_telp"];

    $checkQuery = "SELECT * FROM dosen WHERE username = '$username' OR id_dosen = '$id_dosen'";
    $checkResult = mysqli_query($db, $checkQuery);
    if (mysqli_num_rows($checkResult) > 0) {
        echo "Gagal Menambahkan Dosen, Username atau Nip sudah ada.";
    } else {
        $query = "INSERT INTO dosen (id_dosen, username,nama_dosen,bidang_studi,email,no_telp) VALUES ('$id_dosen','$username','$nama_dosen','$bidang_studi','$email','$no_telp')";

        if ($db->query($query) == TRUE) {
            echo "Dosen telah ditambahkan";
        } else {
            echo "Gagal Menambahkan Dosen" . $db->error;
        }
    }

}
?>
<div class="container">
    <h2 class="mt-5">Tambah Dosen</h2>
    <form method="post" action="">
        <div class="form-group">
            <label for="id_dosen">NIP</label>
            <input type="text" class="form-control" name="id_dosen" placeholder="19760129 200212 1 001" required>
        </div>
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
            <label for="nama_dosen">Nama Dosen</label>
            <input type="text" class="form-control" name="nama_dosen" placeholder="Ronal Hadi, S.T., M.Kom" required>
        </div>

        <div class="form-group">
            <label for="bidang_studi">Bidang Studi</label>
            <input type="text" class="form-control" name="bidang_studi" placeholder="Teknologi Informasi" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" name="email" placeholder="ronal@gmail.com" required>
        </div>
        <div class="form-group">
            <label for="no_telp">No Telepone</label>
            <input type="text" class="form-control" name="no_telp" placeholder="08383823123" required>
        </div>
        


        <button type="submit" name="submit" class="btn btn-primary">Tambah</button>
    </form>
</div>