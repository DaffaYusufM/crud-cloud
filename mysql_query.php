<?php
include 'db.php';

echo "<!DOCTYPE html>
<html lang='id'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>MySQL Query Tool - CRUD System</title>
    <link rel='stylesheet' href='style.css'>
    <link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css' rel='stylesheet'>
    <style>
        .query-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .query-card {
            background: white;
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            margin-bottom: 30px;
        }

        .query-header {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 2px solid #f8f9fa;
        }

        .query-header h2 {
            color: #2c3e50;
            font-size: 2.2rem;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 15px;
        }

        .query-header p {
            color: #7f8c8d;
            font-size: 1.1rem;
        }

        .query-form {
            margin-bottom: 30px;
        }

        .query-textarea {
            width: 100%;
            padding: 20px;
            border: 2px solid #e9ecef;
            border-radius: 12px;
            font-family: 'Courier New', monospace;
            font-size: 1rem;
            line-height: 1.5;
            background: #f8f9fa;
            resize: vertical;
            min-height: 150px;
            transition: all 0.3s ease;
        }

        .query-textarea:focus {
            outline: none;
            border-color: #3498db;
            background: white;
            box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.1);
        }

        .query-actions {
            display: flex;
            gap: 15px;
            margin-top: 20px;
            flex-wrap: wrap;
        }

        .btn-execute {
            background: linear-gradient(135deg, #3498db, #2980b9);
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 10px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            box-shadow: 0 4px 15px rgba(52, 152, 219, 0.3);
        }

        .btn-execute:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(52, 152, 219, 0.4);
        }

        .btn-clear {
            background: #95a5a6;
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 10px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-clear:hover {
            background: #7f8c8d;
            transform: translateY(-2px);
        }

        .btn-back {
            background: #34495e;
            color: white;
            text-decoration: none;
            padding: 12px 30px;
            border-radius: 10px;
            font-weight: 600;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-back:hover {
            background: #2c3e50;
            transform: translateY(-2px);
        }

        .samples-section {
            margin-bottom: 30px;
        }

        .samples-header {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 20px;
            color: #2c3e50;
        }

        .sample-buttons {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .btn-sample {
            background: #e3f2fd;
            color: #1976d2;
            border: 1px solid #bbdefb;
            padding: 10px 20px;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 0.9rem;
            font-weight: 500;
        }

        .btn-sample:hover {
            background: #bbdefb;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(25, 118, 210, 0.2);
        }

        .result-section {
            margin-top: 30px;
        }

        .result-header {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 20px;
            color: #27ae60;
        }

        .result-table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        }

        .result-table th {
            background: linear-gradient(135deg, #34495e, #2c3e50);
            color: white;
            padding: 15px;
            text-align: left;
            font-weight: 600;
            font-size: 0.9rem;
        }

        .result-table td {
            padding: 12px 15px;
            border-bottom: 1px solid #ecf0f1;
        }

        .result-table tbody tr:hover {
            background: #f8f9fa;
        }

        .result-table tbody tr:last-child td {
            border-bottom: none;
        }

        .error-message {
            background: #ffeaa7;
            border: 1px solid #fdcb6e;
            border-radius: 12px;
            padding: 20px;
            margin-top: 20px;
            color: #2d3436;
        }

        .success-message {
            background: #55efc4;
            border: 1px solid #00b894;
            border-radius: 12px;
            padding: 15px;
            margin-top: 20px;
            color: #2d3436;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .info-box {
            background: #dfe6e9;
            border: 1px solid #b2bec3;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 30px;
        }

        .info-box h4 {
            color: #2d3436;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .info-list {
            list-style: none;
            padding: 0;
        }

        .info-list li {
            padding: 8px 0;
            display: flex;
            align-items: center;
            gap: 10px;
            color: #636e72;
        }

        .info-list li i {
            color: #3498db;
            font-size: 0.8rem;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .query-container {
                padding: 10px;
            }

            .query-card {
                padding: 20px;
            }

            .query-header h2 {
                font-size: 1.8rem;
            }

            .query-actions {
                flex-direction: column;
            }

            .btn-execute, .btn-clear, .btn-back {
                width: 100%;
                justify-content: center;
            }

            .sample-buttons {
                flex-direction: column;
            }

            .btn-sample {
                text-align: center;
            }
        }

        @media (max-width: 480px) {
            .query-header h2 {
                font-size: 1.5rem;
                flex-direction: column;
                gap: 10px;
            }

            .query-textarea {
                padding: 15px;
            }
        }
    </style>
</head>
<body>
    <div class='container'>
        <header class='header'>
            <h1><i class='fas fa-database'></i> MySQL Query Tool</h1>
            <p class='subtitle'>Database Management Interface</p>
        </header>

        <div class='query-container'>
            <div class='query-card'>
                <div class='query-header'>
                    <h2><i class='fas fa-terminal'></i> SQL Query Executor</h2>
                    <p>Jalankan query SQL langsung ke database</p>
                </div>

                <div class='info-box'>
                    <h4><i class='fas fa-info-circle'></i> Informasi Keamanan</h4>
                    <ul class='info-list'>
                        <li><i class='fas fa-shield-alt'></i> Tool ini hanya untuk development</li>
                        <li><i class='fas fa-exclamation-triangle'></i> Hati-hati dengan query DELETE/UPDATE</li>
                        <li><i class='fas fa-database'></i> Database: " . getenv('AZURE_MYSQL_DBNAME') . "</li>
                        <li><i class='fas fa-server'></i> Host: " . getenv('AZURE_MYSQL_HOST') . "</li>
                    </ul>
                </div>

                <form method='post' class='query-form'>
                    <textarea name='query' class='query-textarea' placeholder='Masukkan query SQL Anda di sini...'>SHOW DATABASES;</textarea>
                    
                    <div class='query-actions'>
                        <button type='submit' class='btn-execute'>
                            <i class='fas fa-play'></i> Execute Query
                        </button>
                        <button type='button' class='btn-clear' onclick='clearQuery()'>
                            <i class='fas fa-eraser'></i> Clear Query
                        </button>
                        <a href='index.php' class='btn-back'>
                            <i class='fas fa-arrow-left'></i> Kembali ke Dashboard
                        </a>
                    </div>
                </form>

                <div class='samples-section'>
                    <div class='samples-header'>
                        <i class='fas fa-lightbulb'></i>
                        <h3>Query Samples</h3>
                    </div>
                    <div class='sample-buttons'>
                        <button class='btn-sample' onclick=\"setQuery('SHOW DATABASES;')\">Show Databases</button>
                        <button class='btn-sample' onclick=\"setQuery('SHOW TABLES;')\">Show Tables</button>
                        <button class='btn-sample' onclick=\"setQuery('SELECT * FROM mahasiswa;')\">Show Mahasiswa</button>
                        <button class='btn-sample' onclick=\"setQuery('DESCRIBE mahasiswa;')\">Describe Table</button>
                        <button class='btn-sample' onclick=\"setQuery('SELECT COUNT(*) as total FROM mahasiswa;')\">Count Records</button>
                        <button class='btn-sample' onclick=\"setQuery('SELECT * FROM mahasiswa ORDER BY id DESC LIMIT 5;')\">Latest 5 Records</button>
                    </div>
                </div>";

if (isset($_POST['query'])) {
    $query = $_POST['query'];
    $start_time = microtime(true);
    $result = mysqli_query($connection, $query);
    $end_time = microtime(true);
    $execution_time = round(($end_time - $start_time) * 1000, 2); // dalam milidetik
    
    if ($result) {
        $affected_rows = mysqli_affected_rows($connection);
        
        echo "<div class='result-section'>";
        echo "<div class='success-message'>";
        echo "<i class='fas fa-check-circle'></i>";
        echo "Query berhasil dijalankan (" . $execution_time . " ms)";
        if ($affected_rows >= 0) {
            echo " - Affected rows: " . $affected_rows;
        }
        echo "</div>";
        
        echo "<div class='result-header'>";
        echo "<i class='fas fa-table'></i>";
        echo "<h3>Hasil Query:</h3>";
        echo "</div>";
        
        if (mysqli_num_rows($result) > 0) {
            echo "<div style='overflow-x: auto;'>";
            echo "<table class='result-table'>";
            
            // Header
            echo "<thead><tr>";
            $field_info = mysqli_fetch_fields($result);
            foreach ($field_info as $field) {
                echo "<th>" . htmlspecialchars($field->name) . "</th>";
            }
            echo "</tr></thead>";
            
            // Data
            echo "<tbody>";
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                foreach ($row as $value) {
                    echo "<td>" . htmlspecialchars($value) . "</td>";
                }
                echo "</tr>";
            }
            echo "</tbody>";
            echo "</table>";
            echo "</div>";
        } else {
            echo "<div class='info-box'>";
            echo "<h4><i class='fas fa-info-circle'></i> Tidak ada data yang ditemukan</h4>";
            echo "<p>Query berhasil dijalankan tetapi tidak mengembalikan data.</p>";
            echo "</div>";
        }
        
        echo "</div>";
    } else {
        echo "<div class='error-message'>";
        echo "<h4><i class='fas fa-exclamation-triangle'></i> Error dalam menjalankan query:</h4>";
        echo "<p>" . htmlspecialchars(mysqli_error($connection)) . "</p>";
        echo "</div>";
    }
}

echo "
            </div>
        </div>
    </div>

    <script>
        function setQuery(query) {
            document.querySelector('textarea[name=\"query\"]').value = query;
        }
        
        function clearQuery() {
            document.querySelector('textarea[name=\"query\"]').value = '';
        }
        
        // Auto-focus textarea
        document.addEventListener('DOMContentLoaded', function() {
            const textarea = document.querySelector('textarea[name=\"query\"]');
            textarea.focus();
            textarea.setSelectionRange(textarea.value.length, textarea.value.length);
        });
    </script>
</body>
</html>";
?>