<?php

// ---------- 1. Satu peserta (array asosiatif) ----------
$peserta = [
    "nama"   => "jamal",
    "divisi" => "web dev",
    "kota"   => "solo"
];

echo "Nama: " . htmlspecialchars($peserta["nama"]) . "<br>";
echo "Divisi: " . htmlspecialchars($peserta["divisi"]) . "<br>";
echo "Kota: " . htmlspecialchars($peserta["kota"]) . "<br>";

// ---------- 2. Lima peserta (array multidimensi) ----------
$daftarPeserta = [
    ["nama" => "jamal", "divisi" => "web dev", "kota" => "solo"],
    ["nama" => "udin",  "divisi" => "ai",      "kota" => "samarinda"],
    ["nama" => "petot", "divisi" => "ui/ux",   "kota" => "solok"],
    ["nama" => "rina",  "divisi" => "mobile",  "kota" => "padang"],
    ["nama" => "dewi",  "divisi" => "web dev", "kota" => "medan"],
];

// ---------- 3. Mengambil satu nilai (index mulai dari 0) ----------
echo "<br>Peserta ke-3: " . htmlspecialchars($daftarPeserta[2]["nama"]) . "<br>";
echo "Kota peserta ke-5: " . htmlspecialchars($daftarPeserta[4]["kota"]) . "<br><br>";

// ---------- 4. foreach teks biasa ----------
foreach ($daftarPeserta as $orang) {
    echo htmlspecialchars($orang["nama"]) . " : " . htmlspecialchars($orang["divisi"]) . "<br>";
}

// ---------- 5 dan 6. Tabel HTML, semua teks di-escape ----------
echo "<br><table border='1' cellpadding='6'>";
echo "<tr><th>No</th><th>Nama</th><th>Divisi</th><th>Kota</th></tr>";

$no = 1;
foreach ($daftarPeserta as $orang) {
    echo "<tr>";
    echo "<td>" . $no . "</td>";
    echo "<td>" . htmlspecialchars($orang["nama"]) . "</td>";
    echo "<td>" . htmlspecialchars($orang["divisi"]) . "</td>";
    echo "<td>" . htmlspecialchars($orang["kota"]) . "</td>";
    echo "</tr>";
    $no++;
}

echo "</table>";

// ---------- 7. Jumlah peserta ----------
echo "<br>Jumlah peserta: " . count($daftarPeserta);