<?php
include 'db.php';
$id = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($connection, "SELECT * FROM mahasiswa WHERE id=$id"));

if (isset($_POST['submit'])) {
    $nama = $_POST['nama'];
    $nim = $_POST['nim'];
    $prodi = $_POST['prodi'];

    mysqli_query($connection, "UPDATE mahasiswa SET nama='$nama', nim='$nim', prodi='$prodi' WHERE id=$id");
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Mahasiswa</title>
</head>
<body>

<h2>Edit Mahasiswa</h2>

<form method="POST">
    Nama: <input type="text" name="nama" value="<?= $data['nama'] ?>" required><br><br>
    NIM: <input type="text" name="nim" value="<?= $data['nim'] ?>" required><br><br>
    Prodi: <input type="text" name="prodi" value="<?= $data['prodi'] ?>" required><br><br>

    <button type="submit" name="submit">Update</button>
</form>

</body>
</html>
