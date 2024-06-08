<?php
$aksi = isset($_GET['aksi']) ? $_GET['aksi'] : 'list';

switch ($aksi) {
    case 'list':
        ?>

        <table id="example" class="table table-bordered table-info table-striped table-hover mt-5">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Jadwal</th>
                    <th>Matakuliah</th>
                    <th>Hari</th>
                    <th>Ruangan</th>
                    <th>Jam Mulai</th>
                    <th>Jam Selesai</th>
                    <th>Kelas </th>
                    <th>Semester</th>
                    <?php
                    if ($_SESSION['level'] == 'admin') { ?>
                        <th>Aksi</th>
                    <?php } ?>
                </tr>
            </thead>
            <tbody>
                <?php $nomor = 1;
                $username=$_SESSION['username'];
                $usernamejadi="SELECT username FROM mahasiswa JOIN user ON mahasiswa.username=user.username WHERE user.username='$username' ;";

                $query = "SELECT * FROM jadwal JOIN matakuliah ON jadwal.id_matkul=matakuliah.id_matkul JOIN hari ON jadwal.kodehari=hari.codehari JOIN ruangan ON jadwal.id_ruangan=ruangan.id_ruangan JOIN jam ON jadwal.kodejam=jam.kodejam JOIN kelas ON jadwal.id_kelas=kelas.id_kelas JOIN tahun_ajaran ON jadwal.id_thn_ajaran=tahun_ajaran.id_thn_ajaran ;";

                $result = $db->query($query);

                foreach ($result as $row): ?>
                    <tr>
                        <td>
                            <?= $nomor++ ?>
                        </td>
                        <td>
                            <?= $row['kode_jadwal'] ?>
                        </td>
                        <td>
                            <?= $row['nama_matkul'] ?>
                        </td>
                        <td>
                            <?= $row['hari'] ?>
                        </td>
                        <td>
                            <?= $row['ruangan'] ?>
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
                        <td>
                            <?= $row['semester'] ?>
                        </td>
                        <?php
                        if ($_SESSION['level'] == 'admin') { ?>
                            <td>
                                <a class="badge bg-primary"
                                    href="index.php?page=mahasiswa&aksi=edit&nim=<?= $row['id_dosen'] ?>">Edit</a>
                                <a class="badge bg-danger" onclick="return confirm('Apakah Kamu Yakin Menghapusnya')"
                                    href="proses-mahasiswa.php?proses=delete&nim=<?= $row['id_dosen'] ?>">Hapus</a>
                            </td>
                        <?php } ?>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
        <?php
        if ($_SESSION['level'] == 'admin') {
            ?>
            <a href="index.php?page=tambahjadwal" class="btn btn-primary mb-3">tambah Jadwal</a>
            <?php
        }
        ?>

        <?php
        break;

    case 'edit':
        ?>


        <?php
        break;
}
?>