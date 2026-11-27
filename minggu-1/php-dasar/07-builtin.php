<?php

$kalimat = "Belajar PHP itu menyenangkan";
$nilai   = [78, 92, 65, 88, 70, 55, 95];
$nama    = ["Udin", "Jamal", "Petot", "Budi"];
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Latihan 7 - Fungsi Bawaan PHP</title>
</head>
<body>
  <h1>Latihan 7: Fungsi Bawaan</h1>

  <!-- ===================== STRING ===================== -->
  <h2>A. Fungsi string</h2>
  <?php
  echo "Teks asli: " . $kalimat . "<br><br>";

  echo "strlen: " . strlen($kalimat) . " karakter<br>";

  echo "str_replace: " . str_replace("PHP", "Laravel", $kalimat) . "<br>";

  echo "strtoupper: " . strtoupper($kalimat) . "<br>";
  echo "strtolower: " . strtolower($kalimat) . "<br>";

  // ucwords: huruf pertama tiap kata jadi kapital
  echo "ucwords: " . ucwords("belajar php itu seru") . "<br>";

  echo "str_contains 'PHP': ";
  var_dump(str_contains($kalimat, "PHP"));
  echo "<br>";

  echo "substr (7 huruf pertama): " . substr($kalimat, 0, 7) . "<br>";


  echo "trim: [" . trim("   halo   ") . "]<br>";
  ?>

  <!-- ===================== ARRAY ===================== -->
  <h2>B. Fungsi array</h2>
  <?php
  echo "Nilai: " . implode(", ", $nilai) . "<br><br>";

  // count: jumlah isi array
  echo "count: " . count($nilai) . " data<br>";

  // array_sum: jumlah semua angka
  echo "array_sum: " . array_sum($nilai) . "<br>";

  // rata-rata: gabungan dua fungsi di atas
  echo "Rata-rata: " . round(array_sum($nilai) / count($nilai), 1) . "<br>";

  // max / min: nilai terbesar dan terkecil
  echo "max: " . max($nilai) . ", min: " . min($nilai) . "<br>";

  // in_array: apakah nilai ada di dalam array?
  echo "Ada nilai 88? ";
  var_dump(in_array(88, $nilai));
  echo "<br>";
  ?>

  <h2>C. sort (mengurutkan)</h2>
  <?php
  // PENTING: sort() MENGUBAH array aslinya (tidak mengembalikan array baru).
  $urut = $nilai;          // salin dulu supaya $nilai asli aman
  sort($urut);             // kecil ke besar
  echo "sort (naik): " . implode(", ", $urut) . "<br>";

  rsort($urut);            // besar ke kecil
  echo "rsort (turun): " . implode(", ", $urut) . "<br>";

  $urutNama = $nama;
  sort($urutNama);         // untuk teks: urut abjad
  echo "Nama urut abjad: " . implode(", ", $urutNama) . "<br>";
  ?>

  <h2>D. array_filter (menyaring)</h2>
  <?php
  // array_filter(array, fungsi): hanya menyimpan isi yang membuat fungsi mengembalikan true.
  // fn($n) => $n >= 70 adalah "fungsi mini" (arrow function): $n masuk, hasil true/false keluar.
  $lulus = array_filter($nilai, fn($n) => $n >= 70);

  echo "Yang lulus (>= 70): " . implode(", ", $lulus) . "<br>";
  echo "Jumlah lulus: " . count($lulus) . " dari " . count($nilai) . "<br>";

  // Hati-hati: array_filter MEMPERTAHANKAN index lama. Rapikan dengan array_values.
  echo "<pre>";
  print_r($lulus);                    // index lompat: 0, 1, 3, 4, 6
  print_r(array_values($lulus));      // index diurutkan ulang: 0, 1, 2, 3, 4
  echo "</pre>";

  // Menyaring teks: nama yang panjangnya lebih dari 4 huruf
  $namaPanjang = array_filter($nama, fn($n) => strlen($n) > 4);
  echo "Nama lebih dari 4 huruf: " . implode(", ", $namaPanjang) . "<br>";
  ?>

  <h2>E. Gabungan: tabel nilai dengan fungsi bawaan</h2>
  <table border="1" cellpadding="6">
    <tr><th>No</th><th>Nilai</th><th>Status</th></tr>
    <?php
    foreach ($nilai as $i => $n) {
        $status = $n >= 70 ? "Lulus" : "Tidak Lulus";
        echo "<tr>";
        echo "<td>" . ($i + 1) . "</td>";
        echo "<td>" . $n . "</td>";
        echo "<td>" . $status . "</td>";
        echo "</tr>";
    }
    ?>
  </table>

  <p>
    <?php
    echo "Total: " . array_sum($nilai)
       . " | Tertinggi: " . max($nilai)
       . " | Terendah: " . min($nilai);
    ?>
  </p>
</body>
</html>