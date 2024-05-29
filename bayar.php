<?php
session_start();

$totalPembayaran = 0;
foreach ($_SESSION['items'] as $item) {
    $totalPembayaran += $item['total'];
}

// Membuat nomor transaksi dan tanggal
$nomorTransaksi = uniqid('TRX-');
$tanggal = date('d-m-Y');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nominalUang = floatval($_POST['nominalUang']);
    $kembalian = $nominalUang - $totalPembayaran;
    if ($kembalian >= 0) {
        $_SESSION['nominalUang'] = $nominalUang;
        $_SESSION['kembalian'] = $kembalian;
        $_SESSION['nomorTransaksi'] = $nomorTransaksi;
        $_SESSION['tanggal'] = $tanggal;
        header('Location: bukti_pembayaran.php');
        exit();
    } else {
        $_SESSION['error'] = "Uang yang Anda masukkan kurang.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran</title>
    <link rel="stylesheet" href="bayar.css">
</head>
<body>
    <div class="container">
        <h1>Pembayaran</h1>
        <div class="transaction-details">
            <p>No. Transaksi: <?= $nomorTransaksi ?></p>
            <p>Tanggal: <?= $tanggal ?></p>
        </div>
        <?php if (isset($_SESSION['error'])): ?>
            <p class="error"><?= $_SESSION['error'] ?></p>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>
        <form method="POST" action="">
            <div class="form-group">
                <label for="nominalUang">Masukkan Nominal Uang:</label>
                <input type="number" id="nominalUang" name="nominalUang" required>
            </div>
            <div class="form-group">
                <label>Total yang Harus Dibayarkan:</label>
                <p class="total">Rp <?= number_format($totalPembayaran, 2) ?></p>
            </div>
            <div class="form-actions">
                <button type="submit" class="primary-button">Bayar</button>
                <a href="index.php"><button type="button" class="secondary-button">Kembali</button></a>
            </div>
        </form>
    </div>
</body>
</html>
