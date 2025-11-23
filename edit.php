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
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Mahasiswa - CRUD System</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .form-container {
            max-width: 600px;
            margin: 0 auto;
            padding: 40px;
        }

        .form-card {
            background: white;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            border: 1px solid #e9ecef;
        }

        .form-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .form-header h2 {
            color: #2c3e50;
            font-size: 2.2rem;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 15px;
        }

        .form-header p {
            color: #7f8c8d;
            font-size: 1.1rem;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #2c3e50;
            font-size: 1rem;
        }

        .form-input {
            width: 100%;
            padding: 15px 20px;
            border: 2px solid #e9ecef;
            border-radius: 12px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: #f8f9fa;
        }

        .form-input:focus {
            outline: none;
            border-color: #3498db;
            background: white;
            box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.1);
            transform: translateY(-2px);
        }

        .form-actions {
            display: flex;
            gap: 15px;
            justify-content: center;
            margin-top: 40px;
            flex-wrap: wrap;
        }

        .btn-cancel {
            background: #95a5a6;
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

        .btn-cancel:hover {
            background: #7f8c8d;
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(149, 165, 166, 0.3);
        }

        .btn-submit {
            background: linear-gradient(135deg, #27ae60, #219a52);
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
            box-shadow: 0 4px 15px rgba(39, 174, 96, 0.3);
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(39, 174, 96, 0.4);
        }

        .current-data {
            background: #e8f5e8;
            border: 1px solid #27ae60;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 30px;
        }

        .current-data h4 {
            color: #27ae60;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .data-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
        }

        .data-item {
            background: white;
            padding: 12px;
            border-radius: 8px;
            border-left: 4px solid #27ae60;
        }

        .data-label {
            font-weight: 600;
            color: #2c3e50;
            font-size: 0.9rem;
            margin-bottom: 5px;
        }

        .data-value {
            color: #27ae60;
            font-weight: 500;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .form-container {
                padding: 20px;
            }

            .form-card {
                padding: 30px 20px;
            }

            .form-header h2 {
                font-size: 1.8rem;
            }

            .form-actions {
                flex-direction: column;
            }

            .btn-cancel, .btn-submit {
                width: 100%;
                justify-content: center;
            }

            .data-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 480px) {
            .form-header h2 {
                font-size: 1.5rem;
                flex-direction: column;
                gap: 10px;
            }

            .form-input {
                padding: 12px 15px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <header class="header">
            <h1><i class="fas fa-user-graduate"></i> Edit Data Mahasiswa</h1>
            <p class="subtitle">Perbarui informasi mahasiswa dengan data terbaru</p>
        </header>

        <div class="form-container">
            <div class="form-card">
                <div class="form-header">
                    <h2><i class="fas fa-edit"></i> Form Edit Data</h2>
                    <p>ID Mahasiswa: #<?= $id ?></p>
                </div>

                <div class="current-data">
                    <h4><i class="fas fa-info-circle"></i> Data Saat Ini</h4>
                    <div class="data-grid">
                        <div class="data-item">
                            <div class="data-label">Nama</div>
                            <div class="data-value"><?= htmlspecialchars($data['nama']) ?></div>
                        </div>
                        <div class="data-item">
                            <div class="data-label">NIM</div>
                            <div class="data-value"><?= htmlspecialchars($data['nim']) ?></div>
                        </div>
                        <div class="data-item">
                            <div class="data-label">Program Studi</div>
                            <div class="data-value"><?= htmlspecialchars($data['prodi']) ?></div>
                        </div>
                    </div>
                </div>

                <form method="POST">
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-user"></i> Nama Lengkap
                        </label>
                        <input type="text" 
                               name="nama" 
                               value="<?= htmlspecialchars($data['nama']) ?>" 
                               class="form-input" 
                               required 
                               placeholder="Masukkan nama lengkap mahasiswa">
                    </div>

                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-id-card"></i> Nomor Induk Mahasiswa (NIM)
                        </label>
                        <input type="text" 
                               name="nim" 
                               value="<?= htmlspecialchars($data['nim']) ?>" 
                               class="form-input" 
                               required 
                               placeholder="Masukkan NIM mahasiswa">
                    </div>

                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-graduation-cap"></i> Program Studi
                        </label>
                        <input type="text" 
                               name="prodi" 
                               value="<?= htmlspecialchars($data['prodi']) ?>" 
                               class="form-input" 
                               required 
                               placeholder="Masukkan program studi">
                    </div>

                    <div class="form-actions">
                        <a href="index.php" class="btn-cancel">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                        <button type="submit" name="submit" class="btn-submit">
                            <i class="fas fa-save"></i> Update Data
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Animasi untuk form input
        document.addEventListener('DOMContentLoaded', function() {
            const inputs = document.querySelectorAll('.form-input');
            inputs.forEach(input => {
                input.addEventListener('focus', function() {
                    this.parentElement.style.transform = 'translateY(-5px)';
                });
                
                input.addEventListener('blur', function() {
                    this.parentElement.style.transform = 'translateY(0)';
                });
            });
        });
    </script>
</body>
</html>