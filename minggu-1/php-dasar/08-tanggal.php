<?php
declare(strict_types=1);


// Zona waktu: tanpa ini PHP bisa memakai UTC, jadi tanggalnya bisa meleset
// beberapa jam (misalnya masih "kemarin" saat dini hari di Indonesia).
date_default_timezone_set("Asia/Jakarta");

// Masalah: date("l") menghasilkan nama hari dan bulan dalam BAHASA INGGRIS
// (Monday, November). PHP tidak punya pengaturan bahasa bawaan yang praktis,
// jadi kita buat daftar nama Indonesia sendiri.

// Index array = angka dari date("w"): 0 = Minggu, 1 = Senin, ... 6 = Sabtu
const NAMA_HARI = ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu"];

// Index 0 sengaja dikosongkan, supaya date("n") (1-12) langsung cocok: 1 = Januari
const NAMA_BULAN = [
    "", "Januari", "Februari", "Maret", "April", "Mei", "Juni",
    "Juli", "Agustus", "September", "Oktober", "November", "Desember",
];

// Function: terima timestamp (angka detik), kembalikan teks tanggal Indonesia.
// Tanda ? pada ?int artinya boleh null (kalau null, pakai waktu sekarang).
function formatTanggal(?int $timestamp = null): string
{
    $timestamp = $timestamp ?? time();       // time() = detik sejak 1 Januari 1970

    $hari    = NAMA_HARI[(int) date("w", $timestamp)];
    $tanggal = date("j", $timestamp);        // j = tanggal tanpa nol di depan (3, bukan 03)
    $bulan   = NAMA_BULAN[(int) date("n", $timestamp)];
    $tahun   = date("Y", $timestamp);        // Y = tahun 4 digit

    return "$hari, $tanggal $bulan $tahun";
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Latihan 8 - Tanggal Indonesia</title>
</head>
<body>
  <h1>Latihan 8: Tanggal Indonesia</h1>

  <h2>1. Hari ini</h2>
  <p><?= formatTanggal() ?></p>

  <h2>2. Kenapa tidak cukup pakai date("l")?</h2>
  <?php
  echo 'date("l, j F Y") = ' . date("l, j F Y") . " (masih bahasa Inggris)<br>";
  echo "formatTanggal() = " . formatTanggal() . "<br>";
  ?>

  <h2>3. Kode format date() yang dipakai</h2>
  <table border="1" cellpadding="6">
    <tr><th>Kode</th><th>Arti</th><th>Hasil hari ini</th></tr>
    <?php
    $kode = [
        "w" => "Nomor hari (0 = Minggu)",
        "j" => "Tanggal tanpa nol",
        "n" => "Nomor bulan (1-12)",
        "Y" => "Tahun 4 digit",
        "H:i" => "Jam:menit (24 jam)",
    ];
    foreach ($kode as $k => $arti) {
        echo "<tr>";
        echo "<td><code>$k</code></td>";
        echo "<td>$arti</td>";
        echo "<td>" . date($k) . "</td>";
        echo "</tr>";
    }
    ?>
  </table>

  <h2>4. Tanggal tertentu (bukan hari ini)</h2>
  <?php
  // mktime(jam, menit, detik, bulan, tanggal, tahun) membuat timestamp
  $ulangTahun = mktime(0, 0, 0, 8, 17, 2026);
  echo "17 Agustus 2026 jatuh pada: " . formatTanggal($ulangTahun) . "<br>";

  // strtotime membaca teks tanggal berbahasa Inggris
  $besok = strtotime("+1 day");
  echo "Besok: " . formatTanggal($besok) . "<br>";
  ?>

  <h2>5. Tujuh hari ke depan (function di dalam loop)</h2>
  <table border="1" cellpadding="6">
    <tr><th>Hari ke-</th><th>Tanggal</th></tr>
    <?php
    for ($i = 0; $i < 7; $i++) {
        $ts = strtotime("+$i day");
        echo "<tr>";
        echo "<td>" . $i . "</td>";
        echo "<td>" . formatTanggal($ts) . "</td>";
        echo "</tr>";
    }
    ?>
  </table>

  <h2>6. Jam sekarang</h2>
  <p><?= date("H:i:s") ?> WIB</p>
</body>
</html>