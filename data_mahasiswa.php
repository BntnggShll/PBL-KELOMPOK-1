
        <table id="example" class="table table-bordered table-info table-striped table-hover mt-5">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nim</th>
                    <th>Nama</th>
                    <th>Jenis Kelamin</th>
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

                $query = "SELECT * FROM mahasiswa JOIN kelas ON mahasiswa.id_kelas = kelas.id_kelas ORDER BY mahasiswa.nama;";
                $result = $db->query($query);

                foreach ($result as $row): ?>
                    <tr>
                        <td>
                            <?= $nomor++ ?>
                        </td>
                        <td>
                            <?= $row['nim'] ?>
                        </td>
                        <td>
                            <?= $row['nama'] ?>
                        </td>
                        <td>
                            <?= $row['jenis_kelamin'] ?>
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
                                <a class="badge bg-primary" href="index.php?page=mahasiswa&aksi=edit&nim=<?= $row['nim'] ?>">Edit</a>
                                <a class="badge bg-danger" onclick="return confirm('Apakah Kamu Yakin Menghapusnya')"
                                    href="proses-mahasiswa.php?proses=delete&nim=<?= $row['nim'] ?>">Hapus</a>
                            </td>
                        <?php } ?>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
        <?php
        if ($_SESSION['level']=='admin'){ 
    ?>
        <a href="index.php?page=tambahmahasiswa" class="btn btn-primary mb-3">tambah Mahasiswa</a>
        <?php } ?>
   