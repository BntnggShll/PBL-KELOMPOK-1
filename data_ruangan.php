<?php
$aksi = isset($_GET['aksi']) ? $_GET['aksi'] : 'list';

switch ($aksi) {
    case 'list':
        ?>

        <table id="example" class="table table-bordered table-info table-striped table-hover mt-5">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Kelas</th>
                    <th>Ruangan</th>
                    <th>Matakuliah</th>
                    <th>Hari</th>
                    <th>Jam Mulai</th>
                    <th>Jam Selesai</th>
                    <th>Kelas</th>
                    <?php
                    if ($_SESSION['level'] == 'admin') { ?>
                        <th>Aksi</th>
                    <?php } ?>
                </tr>
            </thead>
            <tbody>
                <?php $nomor = 1;

                $query = "SELECT * FROM ruangan JOIN jadwal ON ruangan.id_ruangan = jadwal.id_ruangan JOIN matakuliah ON jadwal.id_matkul = matakuliah.id_matkul JOIN kelas ON jadwal.id_kelas = kelas.id_kelas JOIN hari ON jadwal.kodehari = hari.codehari JOIN jam ON jadwal.kodejam = jam.kodejam ORDER BY hari.hari;";

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
                        <td>
                            <?= $row['nama_matkul'] ?>
                        </td>
                        <td>
                            <?= $row['hari'] ?>
                        </td>
                        <td>
                            <?= $row['jam_mulai'] ?>
                        </td>
                        <td>
                            <?= $row['jam_selesai'] ?>
                        </td>
                        <td>
                            <?= $row['kelas'] ?>
                        </td>
                        <?php
                        if ($_SESSION['level'] == 'admin') { ?>
                            <td>
                                <a class="badge bg-primary" href="index.php?page=mahasiswa&aksi=edit&nim=<?= $row['id_dosen'] ?>">Edit</a>
                                <a class="badge bg-danger" onclick="return confirm('Apakah Kamu Yakin Menghapusnya')"
                                    href="proses-mahasiswa.php?proses=delete&nim=<?= $row['id_dosen'] ?>">Hapus</a>
                            </td>
                        <?php } ?>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
        <?php
        if ($_SESSION['level']=='admin'){ 
    ?>
        <a href="index.php?page=ruang" class="btn btn-primary mb-3">tambah Ruangan</a>
    <?php
        }
    ?>

               <?php
        break;

    case 'edit':

        $get_nim = $_GET['nim'];
        $sql = "SELECT * FROM mahasiswa WHERE nim=$get_nim";
        $result = $db->query($sql);
        //cek apakah ada data/row dari table tamu dengan id yang di kirim
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $nim = $row['nim'];
            $nama_mhs = $row['nama_mhs'];
            $tgl_lahir = $row['tgl_lahir'];
            $alamat = $row['alamat'];
        } else {
            echo "Data $get_nim tidak tersedia";
            exit;
        }

        //memisahkan tanggal
        list($tahun, $bulan, $tgl_lahir) = explode('-', $row['tgl_lahir']);
        ?>
        <form action="proses-mahasiswa.php?proses=update" method="POST">
            <div class="card">
                <div class="card-header text-center">
                    <h2>Edit Data Mahasiswa</h2>
                </div>
                <div class="card-body">
                    <form action="" method="post">
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">NIM</label>
                            <div class="col-sm-10">
                                <input type="text" name="nim" value="<?php echo $row['nim']; ?>">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Nama</label>
                            <div class="col-sm-10">
                                <input type="text" name="nama_mhs" value="<?php echo $row['nama_mhs']; ?>">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Program Studi</label>
                            <div class="col-sm-3">
                                <select name="prodi_id" class="form-select">
                                    <option value="">--Pilih prodi--</option>
                                    <?php
                                    $prodi = mysqli_query($db, "SELECT * FROM prodi");
                                    while ($data_prodi = mysqli_fetch_array($prodi)) {
                                        $select = $data_prodi['id'] == $row['prodi_id'] ? 'selected' : '';
                                        echo "<option $select value=" . $data_prodi['id'] . ">" . $data_prodi['nama_prodi'] . "</option>";
                                    }

                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div>
                                <label class="col-sm-2 col-form-label">Tgl Lahir</label>
                                <tr>
                                    <td>
                                        <select name="tgl_lahir" id="tgl_lahir">
                                            <?php
                                            for ($i = 1; $i <= 31; $i++) {
                                                $selected = ($i == $tgl_lahir) ? 'selected' : '';
                                                echo "<option value='$i' $selected>$i</option>";
                                            }
                                            ?>
                                        </select>
                                        <select name="bln_lahir" id="bulan">
                                            <?php
                                            $namaBulan = [
                                                "01" => "Januari",
                                                "02" => "Februari",
                                                "03" => "Maret",
                                                "04" => "April",
                                                "05" => "Mei",
                                                "06" => "Juni",
                                                "07" => "Juli",
                                                "08" => "Agustus",
                                                "09" => "September",
                                                "10" => "Oktober",
                                                "11" => "Noveber",
                                                "12" => "Desember",
                                            ];

                                            foreach ($namaBulan as $key => $value) {
                                                $selected = ($key == $bulan) ? 'selected' : '';
                                                echo "<option value='$key' $selected>$value</option>";
                                            }
                                            ?>
                                        </select>
                                        <select name="thn_lahir" id="thn_lahir">
                                            <?php
                                            for ($i = date("Y"); $i >= 1950; $i--) {
                                                $selected = ($i == $tahun) ? 'selected' : '';
                                                echo "<option value='$i' $selected>$i</option>";
                                            }
                                            ?>
                                        </select>
                                    </td>
                                </tr>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Jenis Kelamin</label>
                            <div class="col-sm-10">
                                <input type="radio" value="L" name="jenis_kelamin" <?= $row['jenis_kelamin'] == 'L' ? 'checked' : '' ?>>
                                <label>Laki-Laki</label>

                                <input type="radio" value="P" name="jenis_kelamin" <?= $row['jenis_kelamin'] == 'P' ? 'checked' : '' ?>>
                                <label>Perempuan</label>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Hobi</label>
                            <div class="col-sm-10">

                                <input class="form-check-input" type="checkbox" value="bola" name="hobi[]" <?= in_array('bola', explode(',', $row['hobi'])) ? 'checked' : '' ?>>
                                <label class="form-check-label" for="flexCheckDefault">
                                    bola
                                </label>


                                <input class="form-check-input" type="checkbox" value="renang" name="hobi[]"
                                    <?= in_array('renang', explode(',', $row['hobi'])) ? 'checked' : '' ?>>
                                <label class="form-check-label" for="flexCheckChecked">
                                    renang
                                </label>

                                <input class="form-check-input" type="checkbox" value="koding" name="hobi[]"
                                    <?= in_array('koding', explode(',', $row['hobi'])) ? 'checked' : '' ?>>
                                <label class="form-check-label" for="flexCheckChecked">
                                    koding
                                </label>

                            </div>
                        </div>


                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Alamat</label>
                            <div class="col-sm-5">
                                <textarea cols="40" rows="5" name="alamat"><?php echo $row['alamat']; ?></textarea>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary" name="submit">Update</button>
                    </form>
                </div>
            </div>
        </form>
        <?php
        break;
}
?>