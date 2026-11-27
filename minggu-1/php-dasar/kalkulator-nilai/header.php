<?php
// header.php
// Bagian ATAS halaman: pembuka HTML, <head>, navbar, dan pembuka <main>.
// Dipanggil dengan require dari index.php (functions.php harus sudah dimuat lebih dulu,
// karena di sini memakai function e()).

// $judulHalaman diisi oleh halaman yang memanggil file ini. Kalau tidak ada, pakai teks bawaan.
$judul = $judulHalaman ?? 'Kalkulator Nilai';
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= e($judul) ?> | Udacoding</title>
  <link rel="icon" href="data:,">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

  <!-- CSS dari Bagian B (path relatif dari folder kalkulator-nilai) -->
  <link rel="stylesheet" href="../../landing-page/style.css">
  <!-- CSS tambahan khusus kalkulator -->
  <link rel="stylesheet" href="style-kalkulator.css">
</head>
<body>
  <header class="header">
    <nav class="navbar" aria-label="Navigasi utama">
      <a href="index.php" class="logo">Udacoding</a>
      <a href="../../landing-page/index.html" class="nav-link">Landing page</a>
    </nav>
  </header>

  <main>