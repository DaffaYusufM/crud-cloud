<?php
include 'db.php';
$result = mysqli_query($connection, "SELECT * FROM mahasiswa ORDER BY id DESC");
?>
<!DOCTYPE html>
<html>
<head>
    <title>CRUD Mahasiswa</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<h2>Data Mahasiswa</h2>
<a href="create.php" class="btn">Tambah Mahasiswa</a>
<br><br>

<table>
    <tr>
        <th>ID</th>
        <th>Nama</th>
        <th>NIM</th>
        <th>Prodi</th>
        <th>Aksi</th>
    </tr>

    <?php while($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['nama'] ?></td>
            <td><?= $row['nim'] ?></td>
            <td><?= $row['prodi'] ?></td>
            <td>
                <a href="edit.php?id=<?= $row['id'] ?>">Edit</a> | 
                <a href="delete.php?id=<?= $row['id'] ?>" onclick="return confirm('Hapus data?')">Hapus</a>
            </td>
        </tr>
    <?php } ?>
</table>

</body>
</html>
