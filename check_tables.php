<?php
include 'db.php';

// Cek daftar tables
$result = mysqli_query($connection, "SHOW TABLES");
echo "Tables in database:<br>";
while ($row = mysqli_fetch_array($result)) {
    echo "- " . $row[0] . "<br>";
}
?>