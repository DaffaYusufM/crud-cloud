<?php
include 'db.php';

if (isset($_POST['submit'])) {
    $nama = $_POST['nama'];
    $nim = $_POST['nim'];
    $prodi = $_POST['prodi'];

    $stmt = mysqli_prepare($connection, 
        "INSERT INTO mahasiswa (nama, nim, prodi) VALUES (?, ?, ?)"
    );
    mysqli_stmt_bind_param($stmt, "sss", $nama, $nim, $prodi);
    mysqli_stmt_execute($stmt);

    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Tambah Mahasiswa</title>
</head>
<body>
<h2>Tambah Mahasiswa</h2>

<form method="POST">
    Nama: <input type="text" name="nama" required><br><br>
    NIM: <input type="text" name="nim" required><br><br>
    Prodi: <input type="text" name="prodi" required><br><br>
    <button type="submit" name="submit">Simpan</button>
</form>

</body>
</html>
