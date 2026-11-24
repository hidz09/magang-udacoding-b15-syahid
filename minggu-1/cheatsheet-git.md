# Cheatsheet Git

15 perintah Git yang kupakai selama minggu 1 magang.

## 1. git config
**Fungsi:** Mengatur identitas seperti nama atau gmail.
**Contoh:** `git config --global user.name "Syahid"`
**Kapan dipakai:** Sekali saja di awal, setelah install Git.

## 2. git clone
**Fungsi:** digunakan untuk Mengunduh repo dari GitHub ke laptop.
**Contoh:** `git clone git@github.com:hidz09/magang-udacoding-b15-syahid.git`
**Kapan dipakai:** Saat mulai mengerjakan repo yang belum ada di laptop.

## 3. git status
**Fungsi:** Menampilkan status atau kondisi dari file.
**Contoh:** `git status`
**Kapan dipakai:** Sebelum add atau commit, untuk memastikan tidak ada file yang tertinggal.

## 4. git add
**Fungsi:** digunakan saat menambahkan atau perubahan file.
**Contoh:** `git add .`
**Kapan dipakai:** Setelah selesai mengedit file atau menambah dan siap disimpan ke commit.

## 5. git commit
**Fungsi:** Menyimpan perubahan yang ada di dalam staging area .
**Contoh:** `git commit -m "docs: tambah cheatsheet git"`
**Kapan dipakai:** Setiap selesai satu pekerjaan kecil, dengan format Conventional Commits.

## 6. git push
**Fungsi:** Mengirim commit dari laptop ke GitHub.
**Contoh:** `git push -u origin docs/cheatsheet-git`
**Kapan dipakai:** Setelah commit, supaya bisa dibuatkan Pull Request.

## 7. git pull
**Fungsi:** Mengambil perubahan terbaru dari GitHub dan menggabungkannya ke branch lokal.
**Contoh:** `git pull`
**Kapan dipakai:** Setelah PR di-merge di GitHub, supaya `main` di laptop ikut terbarui.

## 8. git switch
**Fungsi:** Pindah dari satu branch ke branch lain.
**Contoh:** `git switch main`
**Kapan dipakai:** Saat mau kembali ke `main` setelah selesai mengerjakan branch fitur.

## 9. git switch -c
**Fungsi:** Membuat branch baru sekaligus langsung pindah ke sana.
**Contoh:** `git switch -c feature/landing-page`
**Kapan dipakai:** Di awal setiap tugas baru, supaya `main` tidak langsung diubah.

## 10. git branch
**Fungsi:** Menampilkan daftar branch di laptop dan branch yang sedang aktif.
**Contoh:** `git branch`
**Kapan dipakai:** Untuk mengecek sedang ada di branch mana.

## 11. git branch -d
**Fungsi:** Menghapus branch lokal yang sudah selesai dan ter-merge.
**Contoh:** `git branch -d docs/update-readme`
**Kapan dipakai:** Setelah PR di-merge, untuk merapikan branch lama.

## 12. git log --oneline
**Fungsi:** Menampilkan riwayat commit, satu baris per commit.
**Contoh:** `git log --oneline`
**Kapan dipakai:** Untuk memastikan commit dan merge PR sudah masuk ke `main`.

## 13. git fetch
**Fungsi:** Mengambil info terbaru dari GitHub tanpa mengubah file di laptop.
**Contoh:** `git fetch origin`
**Kapan dipakai:** Saat ingin mengecek isi remote dulu sebelum menggabungkan.

## 14. git remote -v
**Fungsi:** Menampilkan alamat repo GitHub yang terhubung ke repo lokal.
**Contoh:** `git remote -v`
**Kapan dipakai:** Untuk memastikan repo terhubung ke alamat yang benar.

## 15. git push --force-with-lease
**Fungsi:** Memaksa push untuk menimpa branch di GitHub, tapi hanya kalau remote sesuai dugaan kita.
**Contoh:** `git push -u --force-with-lease origin docs/update-readme`
**Kapan dipakai:** Saat push ditolak karena versi lama branch masih ada di GitHub. Hanya untuk branch pribadi, jangan di `main`.