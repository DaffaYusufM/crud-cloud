<?php
include 'db.php';

// Validasi ID hanya angka
$id = intval($_GET['id']);

if ($id <= 0) {
    die("ID tidak valid");
}

// Gunakan prepared statement
$stmt = mysqli_prepare($connection, "DELETE FROM mahasiswa WHERE id = ?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);

// Redirect kembali
header("Location: index.php");
exit;
?>
