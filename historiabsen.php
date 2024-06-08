<table id="example" class="table table-bordered table-info table-striped table-hover mt-5">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nim</th>
                    <th>Nama</th>
                    <th>Jumlah Kehadiran</th>
                    <th>Jumlah Sakit</th>
                    <th>Jumlah Izin</th>
                    <th>Jumlah Alfa</th>
                    <?php
                    if ($_SESSION['level'] == 'admin') { ?>
                        <th>Aksi</th>
                    <?php } ?>
                </tr>
            </thead>
            <tbody>
                <?php $nomor = 1;

                $query = "SELECT mahasiswa.*, absen.* FROM mahasiswa JOIN absen ON mahasiswa.nim = absen.nim ORDER BY mahasiswa.nim;";
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
                            <?= $row['jumlah_kehadiran'] ?>
                        </td>
                        <td>
                            <?= $row['jumlah_sakit'] ?>
                        </td>
                        <td>
                            <?= $row['jumlah_izin'] ?>
                        </td>
                        <td>
                            <?= $row['jumlah_alfa'] ?>
                        </td>
                        <?php
                        if ($_SESSION['level'] == 'admin') { ?>
                            <td>
                                <a class="badge bg-primary" href="index.php?page=mahasiswa&aksi=edit&nim=<?= $row['nim'] ?>">Edit</a>
                            </td>
                        <?php } ?>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>