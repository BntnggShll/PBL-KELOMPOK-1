<table id="example" class="table table-bordered table-info table-striped table-hover mt-5">
    <thead>
        <tr>
            <th>No</th>
            <th>No Induk Dosen</th>
            <th>Nama Dosen</th>
            <th>bidang Studi</th>
            <th>Email</th>
            <th>No Telpone</th>
            <?php
            if ($_SESSION['level'] == 'admin') { ?>
                <th>Aksi</th>
            <?php } ?>
        </tr>
    </thead>
    <tbody>
        <?php $nomor = 1;

        $query = "SELECT * FROM dosen ;";
        $result = $db->query($query);

        foreach ($result as $row): ?>
            <tr>
                <td>
                    <?= $nomor++ ?>
                </td>
                <td>
                    <?= $row['id_dosen'] ?>
                </td>
                <td>
                    <?= $row['nama_dosen'] ?>
                </td>
                <td>
                    <?= $row['bidang_studi'] ?>
                </td>
                <td>
                    <?= $row['email'] ?>
                </td>
                <td>
                    <?= $row['no_telp'] ?>
                </td>
                <?php
                if ($_SESSION['level'] == 'admin') { ?>
                    <td>
                        <a class="badge bg-primary" href="index.php?page=mahasiswa&aksi=edit&nim=<?= $row['id_dosen'] ?>">Edit</a>
                        <a class="badge bg-danger" onclick="return confirm('Apakah Kamu Yakin Menghapusnya')"
                            href="proses-mahasiswa.php?proses=delete&id_dosen=<?= $row['id_dosen'] ?>">Hapus</a>
                    </td>
                <?php } ?>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>

<?php
if ($_SESSION['level'] == 'admin') {
    ?>
    <a href="index.php?page=tambahdosen" class="btn btn-primary mb-3">tambah Dosen</a>
    <?php
}
?>