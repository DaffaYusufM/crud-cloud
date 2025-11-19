<?php
include 'db.php';

$id = intval($_GET['id']); // memastikan ID adalah angka

// Ambil data mahasiswa
$stmt = mysqli_prepare($connection, "SELECT nama, nim, prodi FROM mahasiswa WHERE id = ?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$data = mysqli_fetch_assoc($result);

if (!$data) {
    die("Data tidak ditemukan");
}

if (isset($_POST['submit'])) {
    $nama = $_POST['nama'];
    $nim = $_POST['nim'];
    $prodi = $_POST['prodi'];

    // Update database secara aman
    $update = mysqli_prepare($connection,
        "UPDATE mahasiswa SET nama = ?, nim = ?, prodi = ? WHERE id = ?"
    );
    mysqli_stmt_bind_param($update, "sssi", $nama, $nim, $prodi, $id);
    mysqli_stmt_execute($update);

    header("Location: index.php");
    exit;
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
