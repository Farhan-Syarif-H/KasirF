<?php
session_start();
if (!isset($_SESSION['items'])) {
    $_SESSION['items'] = [];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pembelanjaan Kasir</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Data Pembelanjaan Kasir</h1>
        <form id="itemForm" method="POST" action="tambah.php">
            <div class="form-group">
                <label for="namaBarang">Nama Barang:</label>
                <input type="text" id="namaBarang" name="namaBarang" required>
            </div>
            <div class="form-group">
                <label for="hargaBarang">Harga Barang:</label>
                <input type="number" id="hargaBarang" name="hargaBarang" required>
            </div>
            <div class="form-group">
                <label for="jumlahBarang">Jumlah Barang:</label>
                <input type="number" id="jumlahBarang" name="jumlahBarang" required>
            </div>
            <div class="form-actions">
                <button type="submit">Tambah</button>
                <a href="bayar.php"><button type="button">Bayar</button></a>
            </div>
        </form>
        <table id="dataTable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Barang</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($_SESSION['items'] as $index => $item): ?>
                    <tr>
                        <td><?= $index + 1 ?></td>
                        <td><?= htmlspecialchars($item['nama']) ?></td>
                        <td><?= htmlspecialchars(number_format($item['harga'], 2)) ?></td>
                        <td><?= htmlspecialchars($item['jumlah']) ?></td>
                        <td><?= htmlspecialchars(number_format($item['total'], 2)) ?></td>
                        <td>
                            <a href="hapus.php?index=<?= $index ?>"><button class="action-button">Hapus</button></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
