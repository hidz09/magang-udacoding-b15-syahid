<?php
declare(strict_types=1);

// session_start() WAJIB di baris paling atas, sebelum ada output apa pun
// (termasuk sebelum require header.php yang mencetak HTML).
session_start();

require __DIR__ . '/functions.php';

// ==========================================================
// BAGIAN 1: MEMPROSES DATA (belum ada HTML yang dicetak)
// ==========================================================

$judulHalaman = 'Kalkulator Nilai Peserta';

$errors = [];       // pesan error per field
$hasil  = null;     // berisi hasil perhitungan kalau semua valid

// Isian awal kosong. Nanti diisi dari $_POST supaya tidak hilang saat error.
$input = [
    'nama'   => '',
    'divisi' => '',
    'tugas'  => '',
    'uts'    => '',
    'uas'    => '',
];

// Form dikirim? (method POST). Kalau halaman baru dibuka, method-nya GET.
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Ambil tiap field dari $_POST
    foreach ($input as $kunci => $_) {
        $input[$kunci] = ambil($_POST, $kunci);
    }

    $errors = validasiForm($input);

    // Tidak ada error: hitung, lalu simpan ke riwayat
    if (count($errors) === 0) {
        $hasil = buatHasil($input);
        simpanRiwayat($hasil);
    }
}

$riwayat = ambilRiwayat();

// ==========================================================
// BAGIAN 2: TAMPILAN
// ==========================================================
require __DIR__ . '/header.php';
?>

<section class="kalkulator">
  <h1>Kalkulator Nilai Peserta</h1>
  <p class="intro">
    Nilai akhir = <?= BOBOT_TUGAS ?>% tugas + <?= BOBOT_UTS ?>% UTS + <?= BOBOT_UAS ?>% UAS.
    Lulus jika nilai akhir minimal <?= BATAS_LULUS ?>.
  </p>

  <?php if ($hasil !== null): ?>
    <div class="card hasil <?= $hasil['status'] === 'Lulus' ? 'hasil-lulus' : 'hasil-gagal' ?>" role="status">
      <h2>Hasil Perhitungan</h2>
      <p class="hasil-nama">
        <?= e($hasil['nama']) ?> <span>(<?= e($hasil['divisi']) ?>)</span>
      </p>

      <dl class="hasil-daftar">
        <div><dt>Nilai Tugas</dt><dd><?= formatAngka($hasil['tugas']) ?></dd></div>
        <div><dt>Nilai UTS</dt><dd><?= formatAngka($hasil['uts']) ?></dd></div>
        <div><dt>Nilai UAS</dt><dd><?= formatAngka($hasil['uas']) ?></dd></div>
        <div><dt>Nilai Akhir</dt><dd class="hasil-angka"><?= formatAngka($hasil['nilaiAkhir']) ?></dd></div>
        <div><dt>Huruf Mutu</dt><dd class="hasil-angka"><?= e($hasil['huruf']) ?></dd></div>
        <div><dt>Status</dt><dd class="hasil-angka"><?= e($hasil['status']) ?></dd></div>
      </dl>
    </div>
  <?php endif; ?>

  <!-- novalidate: validasi HTML5 browser dimatikan supaya validasi PHP yang tampil.
       Validasi di server tetap WAJIB, karena validasi browser bisa dilewati. -->
  <form method="post" class="form" novalidate>

    <div class="form-group">
      <label for="nama">Nama</label>
      <input type="text" id="nama" name="nama"
             value="<?= e($input['nama']) ?>"
             <?php if (isset($errors['nama'])): ?>aria-invalid="true" aria-describedby="error-nama"<?php endif; ?>>
      <?php if (isset($errors['nama'])): ?>
        <p class="error" id="error-nama"><?= e($errors['nama']) ?></p>
      <?php endif; ?>
    </div>

    <div class="form-group">
      <label for="divisi">Divisi</label>
      <select id="divisi" name="divisi"
              <?php if (isset($errors['divisi'])): ?>aria-invalid="true" aria-describedby="error-divisi"<?php endif; ?>>
        <option value="">-- Pilih divisi --</option>
        <?php foreach (DAFTAR_DIVISI as $divisi): ?>
          <option value="<?= e($divisi) ?>" <?= $input['divisi'] === $divisi ? 'selected' : '' ?>>
            <?= e($divisi) ?>
          </option>
        <?php endforeach; ?>
      </select>
      <?php if (isset($errors['divisi'])): ?>
        <p class="error" id="error-divisi"><?= e($errors['divisi']) ?></p>
      <?php endif; ?>
    </div>

    <?php foreach (FIELD_NILAI as $kunci => $label): ?>
      <div class="form-group">
        <label for="<?= $kunci ?>"><?= $label ?> (0-100)</label>
        <input type="number" id="<?= $kunci ?>" name="<?= $kunci ?>"
               min="0" max="100" step="any"
               value="<?= e($input[$kunci]) ?>"
               <?php if (isset($errors[$kunci])): ?>aria-invalid="true" aria-describedby="error-<?= $kunci ?>"<?php endif; ?>>
        <?php if (isset($errors[$kunci])): ?>
          <p class="error" id="error-<?= $kunci ?>"><?= e($errors[$kunci]) ?></p>
        <?php endif; ?>
      </div>
    <?php endforeach; ?>

    <button type="submit" class="btn btn-utama">Hitung</button>
  </form>
</section>

<!-- Bonus: riwayat 5 perhitungan terakhir (dari $_SESSION) -->
<section class="riwayat">
  <h2>Riwayat <?= MAKS_RIWAYAT ?> perhitungan terakhir</h2>

  <?php if (count($riwayat) === 0): ?>
    <p class="intro">Belum ada perhitungan.</p>
  <?php else: ?>
    <div class="tabel-bungkus">
      <table>
        <thead>
          <tr>
            <th>No</th><th>Waktu</th><th>Nama</th><th>Divisi</th>
            <th>Nilai Akhir</th><th>Huruf</th><th>Status</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($riwayat as $i => $r): ?>
            <tr>
              <td><?= $i + 1 ?></td>
              <td><?= e($r['waktu']) ?></td>
              <td><?= e($r['nama']) ?></td>
              <td><?= e($r['divisi']) ?></td>
              <td><?= formatAngka($r['nilaiAkhir']) ?></td>
              <td><?= e($r['huruf']) ?></td>
              <td><?= e($r['status']) ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  <?php endif; ?>
</section>

<?php require __DIR__ . '/footer.php'; ?>