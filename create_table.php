<?php
include 'db.php';

$sql = "CREATE TABLE IF NOT EXISTS mahasiswa (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    nim VARCHAR(20) NOT NULL,
    prodi VARCHAR(50) NOT NULL
)";

if (mysqli_query($connection, $sql)) {
    echo "Table 'mahasiswa' created successfully!";
} else {
    echo "Error creating table: " . mysqli_error($connection);
}
?>