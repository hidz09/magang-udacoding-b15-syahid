<?php
declare(strict_types=1);

// ==========================================================
// functions.php
// Berisi LOGIKA saja (aturan, validasi, hitungan). Tidak ada HTML di sini.
// ==========================================================

date_default_timezone_set('Asia/Jakarta');

// ---------- 1. Konstanta: aturan yang tidak berubah ----------
// Dikumpulkan di satu tempat. Kalau bobot atau batas lulus berubah, cukup ubah di sini.
const BOBOT_TUGAS = 30;     // persen
const BOBOT_UTS   = 30;
const BOBOT_UAS   = 40;
const BATAS_LULUS = 70;
const MAKS_RIWAYAT = 5;

// Daftar divisi yang diizinkan (dipakai untuk <select> DAN untuk validasi)
const DAFTAR_DIVISI = ['Web Development', 'Mobile', 'UI/UX', 'AI'];

// key = nama field di form, value = label yang tampil di pesan error
const FIELD_NILAI = [
    'tugas' => 'Nilai Tugas',
    'uts'   => 'Nilai UTS',
    'uas'   => 'Nilai UAS',
];

// ---------- 2. Escape output (pencegah XSS) ----------
// Pembungkus htmlspecialchars supaya pendek ditulis berulang kali.
// ENT_QUOTES: tanda kutip ' dan " juga diubah, penting saat dipakai di dalam atribut HTML.
function e(string $teks): string
{
    return htmlspecialchars($teks, ENT_QUOTES, 'UTF-8');
}

// ---------- 3. Mengambil input dengan aman ----------
// Mengembalikan teks yang sudah di-trim. Kalau key tidak ada (atau bukan teks,
// misalnya dikirim sebagai array), hasilnya string kosong.
function ambil(array $sumber, string $kunci): string
{
    $nilai = $sumber[$kunci] ?? '';
    return is_string($nilai) ? trim($nilai) : '';
}

// ---------- 4. Validasi ----------
// Menerima data form, mengembalikan array error.
// Array kosong berarti semua valid. Contoh hasil: ['nama' => 'Nama wajib diisi.']
function validasiForm(array $input): array
{
    $errors = [];

    // Nama
    if ($input['nama'] === '') {
        $errors['nama'] = 'Nama wajib diisi.';
    } elseif (strlen($input['nama']) > 50) {
        $errors['nama'] = 'Nama maksimal 50 karakter.';
    }

    // Divisi: wajib, dan harus salah satu dari daftar yang diizinkan (whitelist)
    if ($input['divisi'] === '') {
        $errors['divisi'] = 'Divisi wajib dipilih.';
    } elseif (!in_array($input['divisi'], DAFTAR_DIVISI, true)) {
        $errors['divisi'] = 'Divisi tidak valid.';
    }

    // Tiga nilai: aturan yang sama, jadi cukup satu loop.
    // Urutan cek penting: kosong -> bukan angka -> di luar rentang.
    foreach (FIELD_NILAI as $kunci => $label) {
        $nilai = $input[$kunci];

        if ($nilai === '') {                         // bukan empty(): "0" adalah nilai sah
            $errors[$kunci] = "$label wajib diisi.";
        } elseif (!is_numeric($nilai)) {
            $errors[$kunci] = "$label harus berupa angka.";
        } elseif ((float) $nilai < 0 || (float) $nilai > 100) {
            $errors[$kunci] = "$label harus antara 0 dan 100.";
        }
    }

    return $errors;
}

// ---------- 5. Perhitungan ----------
// Nilai akhir = 30% tugas + 30% UTS + 40% UAS.
// Dihitung dengan bilangan bulat (x30, x30, x40 lalu /100) dan dibulatkan 2 desimal,
// supaya tidak ada selisih kecil akibat pecahan desimal (mis. 69.9999999 padahal harusnya 70).
function hitungNilaiAkhir(float $tugas, float $uts, float $uas): float
{
    $total = ($tugas * BOBOT_TUGAS) + ($uts * BOBOT_UTS) + ($uas * BOBOT_UAS);
    return round($total / 100, 2);
}

// Skala sama dengan latihan 3. C ke atas (>= 70) otomatis Lulus.
function konversiHuruf(float $nilai): string
{
    return match (true) {
        $nilai >= 90 => 'A',
        $nilai >= 80 => 'B',
        $nilai >= 70 => 'C',
        $nilai >= 60 => 'D',
        default      => 'E',
    };
}

function statusKelulusan(float $nilai): string
{
    return $nilai >= BATAS_LULUS ? 'Lulus' : 'Tidak Lulus';
}

// Menyusun satu paket hasil dari input yang SUDAH valid.
function buatHasil(array $input): array
{
    $tugas = (float) $input['tugas'];       // dari form nilainya string, ubah ke angka
    $uts   = (float) $input['uts'];
    $uas   = (float) $input['uas'];

    $nilaiAkhir = hitungNilaiAkhir($tugas, $uts, $uas);

    return [
        'nama'       => $input['nama'],
        'divisi'     => $input['divisi'],
        'tugas'      => $tugas,
        'uts'        => $uts,
        'uas'        => $uas,
        'nilaiAkhir' => $nilaiAkhir,
        'huruf'      => konversiHuruf($nilaiAkhir),
        'status'     => statusKelulusan($nilaiAkhir),
        'waktu'      => date('d/m/Y H:i'),
    ];
}

// Angka ditampilkan format Indonesia: 81,50 (koma desimal)
function formatAngka(float $angka): string
{
    return number_format($angka, 2, ',', '.');
}

// ---------- 6. Bonus: riwayat di $_SESSION ----------
function simpanRiwayat(array $hasil): void
{
    $riwayat = $_SESSION['riwayat'] ?? [];
    $riwayat[] = $hasil;                                              // tambah di ujung
    $_SESSION['riwayat'] = array_slice($riwayat, -MAKS_RIWAYAT);      // sisakan 5 terakhir
}

// Terbaru di atas
function ambilRiwayat(): array
{
    return array_reverse($_SESSION['riwayat'] ?? []);
}