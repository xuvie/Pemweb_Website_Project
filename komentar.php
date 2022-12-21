<?php
require_once 'cek-akses.php';

if (empty($_POST)) {
    header("Location: index.php");
    exit;
}

if (!isset($_POST['id_user']) || empty($_POST['id_user'])) {
    header("Location: index.php");
    exit;
}

$pdo = require 'koneksi.php';

$sql = "INSERT INTO komentar (komentar, tanggal, id_user)
VALUES (:komentar, now(), :id_user)";

$query = $pdo->prepare($sql);
$query->execute(array(
    'komentar' => $_POST['komentar'],
    'id_user' => $_POST['id_user'],
    'id_user' => $_SESSION['user']['id'],
));

header("Location: index.php?id=". $_POST['id']);
exit;