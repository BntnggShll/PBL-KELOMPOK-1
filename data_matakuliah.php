

        <table id="example" class="table table-bordered table-info table-striped table-hover mt-5">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Matakuliah</th>
                    <th>Matakuliah</th>
                    <th>Dosen</th>
                    <th>SKS</th>
                    <th>Jam Mulai</th>
                    <th>Jam Selesai</th>
                    <?php
                    if ($_SESSION['level'] == 'admin') { ?>
                        <th>Aksi</th>
                    <?php } ?>
                </tr>
            </thead>
            <tbody>
                <?php $nomor = 1;

                $query = "SELECT * FROM matakuliah JOIN dosen ON matakuliah.id_dosen=dosen.id_dosen JOIN jam ON matakuliah.kodejam=jam.kodejam";

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
        <a href="index.php?page=inputmatakuliah" class="btn btn-primary mb-3">tambah Matakuliah</a>
    <?php
        }
    ?>
