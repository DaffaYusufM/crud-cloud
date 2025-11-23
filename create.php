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
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Mahasiswa Baru - CRUD System</title>
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

        .form-guide {
            background: #e8f4fd;
            border: 1px solid #3498db;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 30px;
        }

        .form-guide h4 {
            color: #3498db;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .guide-list {
            list-style: none;
            padding: 0;
        }

        .guide-list li {
            padding: 8px 0;
            display: flex;
            align-items: center;
            gap: 10px;
            color: #2c3e50;
        }

        .guide-list li i {
            color: #3498db;
            font-size: 0.9rem;
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
            <h1><i class="fas fa-user-plus"></i> Tambah Mahasiswa Baru</h1>
            <p class="subtitle">Tambahkan data mahasiswa baru ke dalam sistem</p>
        </header>

        <div class="form-container">
            <div class="form-card">
                <div class="form-header">
                    <h2><i class="fas fa-user-graduate"></i> Form Pendaftaran</h2>
                    <p>Isi form berikut untuk menambahkan mahasiswa baru</p>
                </div>

                <div class="form-guide">
                    <h4><i class="fas fa-info-circle"></i> Panduan Pengisian</h4>
                    <ul class="guide-list">
                        <li><i class="fas fa-check-circle"></i> Isi semua field dengan data yang valid</li>
                        <li><i class="fas fa-check-circle"></i> NIM harus unik dan tidak boleh duplikat</li>
                        <li><i class="fas fa-check-circle"></i> Pastikan data sudah dicek sebelum disimpan</li>
                    </ul>
                </div>

                <form method="POST">
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-user"></i> Nama Lengkap
                        </label>
                        <input type="text" 
                               name="nama" 
                               class="form-input" 
                               required 
                               placeholder="Masukkan nama lengkap mahasiswa"
                               maxlength="100">
                    </div>

                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-id-card"></i> Nomor Induk Mahasiswa (NIM)
                        </label>
                        <input type="text" 
                               name="nim" 
                               class="form-input" 
                               required 
                               placeholder="Masukkan NIM mahasiswa"
                               maxlength="20">
                    </div>

                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-graduation-cap"></i> Program Studi
                        </label>
                        <input type="text" 
                               name="prodi" 
                               class="form-input" 
                               required 
                               placeholder="Masukkan program studi"
                               maxlength="50">
                    </div>

                    <div class="form-actions">
                        <a href="index.php" class="btn-cancel">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                        <button type="submit" name="submit" class="btn-submit">
                            <i class="fas fa-save"></i> Simpan Data
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

            // Validasi form sebelum submit
            const form = document.querySelector('form');
            form.addEventListener('submit', function(e) {
                const inputs = this.querySelectorAll('input[required]');
                let valid = true;
                
                inputs.forEach(input => {
                    if (!input.value.trim()) {
                        valid = false;
                        input.style.borderColor = '#e74c3c';
                    } else {
                        input.style.borderColor = '#27ae60';
                    }
                });
                
                if (!valid) {
                    e.preventDefault();
                    alert('Harap isi semua field yang wajib diisi!');
                }
            });
        });
    </script>
</body>
</html>