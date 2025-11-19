<?php
$host = getenv("AZURE_MYSQL_HOST");
$user = getenv("AZURE_MYSQL_USERNAME");
$pass = getenv("AZURE_MYSQL_PASSWORD");
$db   = getenv("AZURE_MYSQL_DBNAME");
$port = getenv("AZURE_MYSQL_PORT");

// Init connection
$connection = mysqli_init();

// Azure Flexible Server requires SSL
mysqli_ssl_set($connection, NULL, NULL, NULL, NULL, NULL);

mysqli_real_connect(
    $connection,
    $host,
    $user,
    $pass,
    $db,
    $port,
    MYSQLI_CLIENT_SSL
);

if (mysqli_connect_errno()) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
