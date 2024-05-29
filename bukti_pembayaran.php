<?php
session_start();

if (!isset($_SESSION['nominalUang']) || !isset($_SESSION['kembalian'])) {
    header('Location: index.php');
    exit();
}

$nominalUang = $_SESSION['nominalUang'];
$kembalian = $_SESSION['kembalian'];
$nomorTransaksi = $_SESSION['nomorTransaksi'];
$tanggal = $_SESSION['tanggal'];
$totalPembayaran = 0;

foreach ($_SESSION['items'] as $item) {
    $totalPembayaran += $item['total'];
}

$items = $_SESSION['items'];
session_destroy();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bukti Pembayaran</title>
    <link rel="stylesheet" href="pembayaran.css">
</head>
<body>
    <div class="container receipt-container">
        <h1>Bukti Pembayaran</h1>
        <div class="transaction-details">
            <p>No. Transaksi: <?= $nomorTransaksi ?></p>
            <p>Tanggal: <?= $tanggal ?></p>
        </div>
        <div class="receipt">
            <div class="items">
                <h2>Rincian Pembelian</h2>
                <?php foreach ($items as $item): ?>
                    <div class="item">
                        <div class="item-name"><?= htmlspecialchars($item['nama']) ?></div>
                        <div class="item-details">
                            <span class="item-price">Rp <?= number_format($item['harga'], 2) ?></span>
                            <span class="item-quantity">Jumlah: <?= $item['jumlah'] ?></span>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="summary">
                <h2>Ringkasan</h2>
                <p>Total Pembayaran: <span class="normal-amount">Rp <?= number_format($totalPembayaran, 2) ?></span></p>
                <p>Uang Dibayarkan: <span class="normal-amount">Rp <?= number_format($nominalUang, 2) ?></span></p>
                <p>Kembalian: <span class="normal-amount">Rp <?= number_format($kembalian, 2) ?></span></p>
            </div>
        </div>
        <div class="form-actions">
            <a href="index.php"><button type="button" class="secondary-button">Kembali ke Beranda</button></a>
        </div>
    </div>
</body>
</html>
