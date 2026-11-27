<?php
declare(strict_types=1);   // PHP menolak tipe yang salah (tidak diam-diam mengubah "5" jadi 5)

// ==========================================================
// LATIHAN 6: FUNCTION DENGAN TYPE DECLARATION
// ==========================================================

// ---------- 1. Function utama dari tugas ----------
// Menerima array angka, mengembalikan rata-ratanya (float).
function hitungRataRata(array $nilai): float
{
    // Guard: array kosong tidak boleh dibagi (hasilnya error "division by zero")
    if (count($nilai) === 0) {
        return 0.0;
    }

    $total = 0;
    foreach ($nilai as $n) {
        $total += $n;
    }

    return $total / count($nilai);
}

// ---------- 2. Function dengan dua parameter bertipe ----------
// Nilai akhir = 30% tugas + 30% UTS + 40% UAS (dipakai lagi di mini project)
function hitungNilaiAkhir(float $tugas, float $uts, float $uas): float
{
    return ($tugas * 0.3) + ($uts * 0.3) + ($uas * 0.4);
}

// ---------- 3. Function yang mengembalikan string ----------
// Skala sama dengan latihan 3.
function konversiHuruf(float $nilai): string
{
    return match (true) {
        $nilai >= 90 => "A",
        $nilai >= 80 => "B",
        $nilai >= 70 => "C",
        $nilai >= 60 => "D",
        default      => "E",
    };
}

// ---------- 4. Parameter dengan nilai default ----------
function statusKelulusan(float $nilai, float $batas = 70): string
{
    return $nilai >= $batas ? "Lulus" : "Tidak Lulus";
}

// ---------- 5. Function yang menerima string ----------
function sapa(string $nama, string $salam = "Halo"): string
{
    return $salam . ", " . $nama . "!";
}

// ---------- Data untuk ditampilkan ----------
$daftarPeserta = [
    ["nama" => "jamal", "nilai" => [80, 75, 90, 85]],
    ["nama" => "udin",  "nilai" => [60, 55, 70]],
    ["nama" => "petot", "nilai" => [95, 90, 100, 85, 92]],
    ["nama" => "rina",  "nilai" => []],               // sengaja kosong: menguji guard
];
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Latihan 6 - Function PHP</title>
</head>
<body>
  <h1>Latihan 6: Function</h1>

  <h2>1. hitungRataRata</h2>
  <?php
  $contoh = [80, 75, 90, 85];
  $rata = hitungRataRata($contoh);

  echo "Nilai: " . implode(", ", $contoh) . "<br>";   // implode: array jadi teks
  echo "Rata-rata: " . $rata . "<br>";                // (80+75+90+85)/4 = 82.5
  echo "<pre>";
  var_dump($rata);                                      // float(82.5)
  var_dump(hitungRataRata([]));                         // float(0), bukan error
  echo "</pre>";
  ?>

  <h2>2. hitungNilaiAkhir</h2>
  <?php
  $akhir = hitungNilaiAkhir(80, 70, 90);
  // 80*0.3 + 70*0.3 + 90*0.4 = 24 + 21 + 36 = 81
  echo "Tugas 80, UTS 70, UAS 90 = " . $akhir . "<br>";
  ?>

  <h2>3-4. konversiHuruf dan statusKelulusan</h2>
  <?php
  echo "Nilai {$akhir}: huruf " . konversiHuruf($akhir)
     . ", " . statusKelulusan($akhir) . "<br>";
  echo "Dengan batas 85: " . statusKelulusan($akhir, 85) . "<br>";   // default dibatalkan
  ?>

  <h2>5. sapa (nilai default)</h2>
  <?php
  echo sapa("Syahid") . "<br>";
  echo sapa("Syahid", "Selamat pagi") . "<br>";
  ?>

  <h2>6. Function dipakai di dalam loop (tabel)</h2>
  <table border="1" cellpadding="6">
    <tr>
      <th>No</th><th>Nama</th><th>Nilai</th><th>Rata-rata</th><th>Huruf</th><th>Status</th>
    </tr>
    <?php
    $no = 1;
    foreach ($daftarPeserta as $p) {
        $rataPeserta = hitungRataRata($p["nilai"]);

        echo "<tr>";
        echo "<td>" . $no . "</td>";
        echo "<td>" . htmlspecialchars($p["nama"]) . "</td>";
        echo "<td>" . (count($p["nilai"]) ? implode(", ", $p["nilai"]) : "-") . "</td>";
        echo "<td>" . round($rataPeserta, 1) . "</td>";
        echo "<td>" . konversiHuruf($rataPeserta) . "</td>";
        echo "<td>" . statusKelulusan($rataPeserta) . "</td>";
        echo "</tr>";
        $no++;
    }
    ?>
  </table>

  <h2>7. Uji tipe yang salah (buka komentar satu per satu)</h2>
  <?php
  // echo hitungRataRata("abc");      // TypeError: harus array, bukan string
  // echo sapa(123);                  // TypeError karena strict_types=1: 123 bukan string
  echo "Buka komentar di kode untuk melihat TypeError.";
  ?>
</body>
</html>