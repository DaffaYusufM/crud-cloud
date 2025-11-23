<?php
include 'db.php';

echo "<h2>Run MySQL Queries from Web</h2>";

if (isset($_POST['query'])) {
    $query = $_POST['query'];
    $result = mysqli_query($connection, $query);
    
    if ($result) {
        echo "<h3>Result:</h3>";
        echo "<table border='1'>";
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            foreach ($row as $value) {
                echo "<td>" . htmlspecialchars($value) . "</td>";
            }
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "Error: " . mysqli_error($connection);
    }
}
?>

<form method="post">
    <textarea name="query" rows="5" cols="80" placeholder="Enter SQL query">SHOW DATABASES;</textarea><br>
    <input type="submit" value="Execute Query">
</form>

<h3>Sample Queries:</h3>
<button onclick="document.querySelector('textarea').value='SHOW DATABASES;'">Show Databases</button>
<button onclick="document.querySelector('textarea').value='SHOW TABLES;'">Show Tables</button>
<button onclick="document.querySelector('textarea').value='SELECT * FROM mahasiswa;'">Show Data</button>