<?php
session_start();

if (isset($_GET['index'])) {
    $index = intval($_GET['index']);
    if (isset($_SESSION['items'][$index])) {
        array_splice($_SESSION['items'], $index, 1);
    }
}

header('Location: index.php');
exit();
?>
