<?php
include 'db.php';
$result = mysqli_query($connection, "SELECT * FROM mahasiswa ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Mahasiswa - Sistem Management</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <header class="header">
            <h1><i class="fas fa-user-graduate"></i> Data Mahasiswa</h1>
            <p class="subtitle">Sistem Management Data Akademik</p>
        </header>

        <div class="action-bar">
            <a href="create.php" class="btn btn-primary">
                <i class="fas fa-plus"></i> Tambah Mahasiswa Baru
            </a>
            <div class="stats">
                <span class="stat-badge">
                    <i class="fas fa-users"></i> 
                    Total: <?= mysqli_num_rows($result) ?> Mahasiswa
                </span>
            </div>
        </div>

        <div class="table-container">
            <table class="modern-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama Lengkap</th>
                        <th>NIM</th>
                        <th>Program Studi</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(mysqli_num_rows($result) > 0): ?>
                        <?php while($row = mysqli_fetch_assoc($result)): ?>
                            <tr>
                                <td class="text-muted">#<?= $row['id'] ?></td>
                                <td class="name-cell"><?= htmlspecialchars($row['nama']) ?></td>
                                <td><span class="nim-badge"><?= $row['nim'] ?></span></td>
                                <td><?= htmlspecialchars($row['prodi']) ?></td>
                                <td class="action-cell">
                                    <div class="btn-group">
                                        <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-edit">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <a href="delete.php?id=<?= $row['id'] ?>" 
                                           class="btn btn-delete" 
                                           onclick="return confirm('Yakin ingin menghapus data mahasiswa <?= htmlspecialchars($row['nama']) ?>?')">
                                            <i class="fas fa-trash"></i> Hapus
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="text-center no-data">
                                <i class="fas fa-inbox"></i>
                                <p>Belum ada data mahasiswa</p>
                                <a href="create.php" class="btn btn-primary">Tambah Data Pertama</a>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <footer class="footer">
            <p>&copy; 2024 CRUD Mahasiswa. Powered by Azure Cloud.</p>
        </footer>
    </div>

    <script>
        // Tambahkan efek smooth hover
        document.addEventListener('DOMContentLoaded', function() {
            const rows = document.querySelectorAll('.modern-table tbody tr');
            rows.forEach(row => {
                row.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-2px)';
                    this.style.boxShadow = '0 4px 12px rgba(0,0,0,0.1)';
                });
                row.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0)';
                    this.style.boxShadow = 'none';
                });
            });
        });
    </script>
</body>
</html>