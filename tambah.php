<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $namaBarang = $_POST['namaBarang'];
    $hargaBarang = floatval($_POST['hargaBarang']);
    $jumlahBarang = intval($_POST['jumlahBarang']);
    $total = $hargaBarang * $jumlahBarang;

    $item = [
        'nama' => $namaBarang,
        'harga' => $hargaBarang,
        'jumlah' => $jumlahBarang,
        'total' => $total,
    ];

    $_SESSION['items'][] = $item;
}

header('Location: index.php');
exit();
?>
