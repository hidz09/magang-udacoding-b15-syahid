<?php

$produk = [
    "nama"  => "jamal",
    "divisi" => "web dev",
    "kota"  => "solo"
];

echo $produk["nama"];    // jamal

$daftarProduk = [
    ["nama" => "jamal", "divisi" => "web dev", "kota" => "solo"],
    ["nama" => "udin",    "divisi" => "ai", "kota" => "samarinda"],
    ["nama" => "petot",  "divisi" => "ui/ux", "kota" => "solok"],
];
echo $daftarProduk[0]["divisi"];  //web dev
echo $daftarProduk[1]["nama"];     // udin
echo $daftarProduk[2]["kota"];    // solok



foreach ($daftarProduk as $pekerjaan) {
    echo $pekerjaan["nama"] . " : " . $pekerjaan["divisi"] . "<br>";
}


echo "<table border='1' cellpadding='6'>";
echo "<tr><th>No</th><th>Nama</th><th>Stok</th></tr>";

$no = 1;
foreach ($daftarProduk as $pekerjaan) {
    echo "<tr>";
    echo "<td>" . $no . "</td>";
    echo "<td>" . $pekerjaan["nama"] . "</td>";
    echo "<td>" . $pekerjaan["kota"] . "</td>";
    echo "</tr>";
    $no++;
}

echo "</table>";


echo "<td>" . htmlspecialchars($pekerjaan["nama"]) . "</td>";
