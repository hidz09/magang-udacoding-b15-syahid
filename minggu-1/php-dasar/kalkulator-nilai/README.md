# Mini Project: Kalkulator Nilai Peserta

Form PHP untuk menghitung nilai akhir peserta (30% tugas + 30% UTS + 40% UAS),
menampilkan huruf mutu (A-E) dan status Lulus (>= 70) / Tidak Lulus.

## Struktur file
- `index.php`     : form, validasi, hasil, riwayat
- `functions.php` : fungsi hitung, huruf mutu, status, validasi, escape
- `header.php` / `footer.php` : kerangka HTML (di-include)
- `style.css`     : CSS (ganti dengan CSS dari Bagian B)

## Cara menjalankan
Dari folder ini: `php -S localhost:8000`, lalu buka http://localhost:8000

## Kenapa wajib `htmlspecialchars()`? (XSS)
Semua teks dari user (nama, divisi, dan nilai yang diketik) tidak boleh dicetak
langsung ke HTML. Jika user mengisi nama dengan
`<script>alert('hack')</script>`, browser akan MENJALANKAN script itu sebagai
kode, bukan menampilkannya sebagai teks. Serangan ini disebut XSS
(Cross-Site Scripting): penyerang bisa mencuri cookie/session, mengalihkan
halaman, atau mengubah tampilan. `htmlspecialchars()` mengubah karakter
berbahaya (`< > & " '`) menjadi entitas HTML (`&lt; &gt; &amp; &quot; &#039;`)
sehingga hanya tampil sebagai teks biasa. Di project ini dibungkus fungsi
`e()` dan dipakai di setiap output, termasuk atribut `value` dan riwayat session.