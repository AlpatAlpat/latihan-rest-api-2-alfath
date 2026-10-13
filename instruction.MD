Buat project starter Laravel untuk latihan memperbaiki REST API pendaftaran OSIS bagi siswa kelas XI RPL.

Project harus mencakup GET, POST, PUT, dan DELETE, menggunakan MySQL, serta dapat diuji melalui Postman.

KONTEKS PEMBELAJARAN

Siswa sudah mempelajari:
- Laravel, CRUD, relasi dasar, dan validasi.
- Client-server, request-response, JSON.
- HTTP method dan status code.
- Membuat API dan mengujinya melalui Postman.
- Clone dan fork repository.

Tujuan latihan:
Siswa mampu menemukan kesalahan perilaku API, memperbaikinya sesuai spesifikasi, dan membuktikan hasilnya melalui Postman serta database.

Gunakan versi Laravel pada workspace yang tersedia.
Jika membuat project baru, gunakan Laravel 13.
Tidak perlu frontend atau autentikasi.

Jika workspace sudah berisi project, periksa terlebih dahulu.
Pertahankan pekerjaan yang sudah ada dan jangan menghapus file secara sembarangan.

PRINSIP PROJECT STARTER

- Project dapat di-install, dijalankan, dan di-seed tanpa error.
- Sisipkan tepat sembilan masalah latihan yang dijelaskan di bawah.
- Kesalahan harus berupa logika atau perilaku API.
- Jangan membuat error sintaks, dependency, konfigurasi, migration, atau seeder.
- Jangan memberikan kode solusi kepada siswa.
- Jangan membuat branch solusi.
- Jangan menyisipkan masalah lain di luar daftar.


1. STRUKTUR DATABASE

Buat tiga tabel master:

A. kelas
- id
- nama_kelas
- timestamps

B. jenis_kelamin
- id
- nama
- timestamps

C. siswa
- id
- nis, unik
- nama
- kelas_id, foreign key ke kelas
- jenis_kelamin_id, foreign key ke jenis_kelamin
- timestamps

Buat tabel transaksi:

D. pendaftaran_osis
- id
- siswa_id, foreign key ke siswa
- pilihan_bidang
- motivasi
- timestamps

Relasi:
- Kelas memiliki banyak siswa.
- Jenis kelamin memiliki banyak siswa.
- Siswa terhubung ke kelas dan jenis kelamin.
- Pendaftaran OSIS terhubung ke siswa.

Kelas dan jenis kelamin pada respons pendaftaran diperoleh melalui relasi siswa.

Jangan menyimpan ulang nama siswa, kelas, atau jenis kelamin pada tabel pendaftaran.

Gunakan nama tabel secara eksplisit pada model jika tidak mengikuti konvensi Laravel.

Foreign key database tetap dipertahankan.

Untuk starter, siswa_id pada pendaftaran_osis belum memiliki unique constraint. Penolakan pendaftaran duplikat wajib diperbaiki siswa melalui validasi API. Penambahan unique constraint boleh menjadi pengayaan.


2. DATA AWAL

Buat seeder yang menghasilkan:
- 4 kelas.
- 2 jenis kelamin.
- 12 siswa fiktif yang tersebar pada kelas tersebut.
- 2 pendaftaran OSIS dari siswa yang berbeda.

Gunakan data fiktif, bukan nama siswa asli.

Seeder harus menghasilkan data yang konsisten dengan foreign key.

Sebagian siswa belum memiliki pendaftaran agar dapat digunakan untuk pengujian POST.


3. ENDPOINT

Sediakan:

Endpoint master:
- GET /api/kelas
- GET /api/jenis-kelamin
- GET /api/siswa

Endpoint pendaftaran:
- GET /api/pendaftaran-osis
- GET /api/pendaftaran-osis/{id}
- POST /api/pendaftaran-osis
- PUT /api/pendaftaran-osis/{id}
- DELETE /api/pendaftaran-osis/{id}

Pastikan route API terdaftar dan dapat diakses.

Endpoint master harus sudah berfungsi benar.

GET detail pendaftaran beserta relasinya dan penanganan ID tidak tersedia harus sudah berfungsi benar.


4. FORMAT RESPONS YANG HARUS DICAPAI

GET daftar:
HTTP 200
{"data": [...]}

Jika belum ada data:
HTTP 200
{"data": []}

GET detail:
HTTP 200
{"data": {...}}

Data pendaftaran memuat:
- id pendaftaran
- siswa:
  - id
  - nis
  - nama
  - kelas:
    - id
    - nama_kelas
  - jenis_kelamin:
    - id
    - nama
- pilihan_bidang
- motivasi

POST berhasil:
HTTP 201
{
  "message": "Pendaftaran berhasil dibuat.",
  "data": {...}
}

PUT berhasil:
HTTP 200
{
  "message": "Pendaftaran berhasil diperbarui.",
  "data": {...}
}

DELETE berhasil:
HTTP 204 tanpa body.

Input invalid:
HTTP 422 dengan JSON errors berdasarkan field yang salah.
Pesan validasi boleh mengikuti Laravel atau menggunakan bahasa Indonesia.

ID pendaftaran tidak tersedia:
HTTP 404
{"message": "Pendaftaran tidak ditemukan."}


5. ATURAN POST

Body wajib memuat:
- siswa_id
- pilihan_bidang
- motivasi

Aturan:
- siswa_id wajib, integer, dan tersedia pada tabel siswa.
- Satu siswa hanya boleh memiliki satu pendaftaran OSIS.
- pilihan_bidang wajib dan hanya menerima:
  kepemimpinan, keagamaan, olahraga, atau seni.
- motivasi wajib, string, minimal 20 dan maksimal 300 karakter.

Perilaku:
- Satu POST valid menambah tepat satu pendaftaran.
- Field tersimpan sesuai request.
- Respons memuat record yang benar-benar tersimpan.
- Request invalid tidak boleh menambah record.


6. ATURAN PUT

PUT digunakan untuk memperbarui satu pendaftaran.

Untuk latihan ini, body PUT wajib memuat seluruh field:
- siswa_id
- pilihan_bidang
- motivasi

Terapkan aturan seperti POST, dengan ketentuan:
- siswa_id milik pendaftaran yang sedang diedit boleh tetap digunakan.
- siswa_id milik pendaftaran lain harus ditolak.
- siswa_id siswa yang belum terdaftar boleh digunakan.
- ID pendaftaran tetap sama.
- Request valid hanya mengubah pendaftaran yang dituju.
- Jumlah record tidak bertambah.
- Respons memuat data terbaru yang benar-benar tersimpan.
- Request invalid tidak boleh mengubah database.
- ID pendaftaran tidak tersedia menghasilkan 404.


7. ATURAN DELETE

- Request tidak membutuhkan body.
- Hapus hanya pendaftaran sesuai ID pada URL.
- Jangan menghapus siswa, kelas, atau jenis kelamin.
- Jangan menghapus pendaftaran lain.
- Jumlah record pendaftaran berkurang tepat satu.
- Respons berhasil HTTP 204 tanpa body.
- GET detail terhadap record yang sudah dihapus menghasilkan 404.
- DELETE terhadap ID yang tidak tersedia menghasilkan 404.


8. SEMBILAN MASALAH LATIHAN

Implementasikan tepat sembilan masalah berikut:

L1. GET daftar pendaftaran belum menyertakan data kelas dan jenis kelamin melalui relasi siswa.
Data siswa lainnya tetap ditampilkan.

L2. Validasi POST belum memeriksa keberadaan siswa_id pada tabel siswa.
Foreign key tetap aktif. ID siswa yang tidak tersedia dapat menyebabkan kegagalan penyimpanan sebelum masalah diperbaiki.

L3. POST belum menolak pendaftaran kedua dari siswa yang sama.

L4. Validasi POST dan PUT belum membatasi pilihan_bidang pada empat pilihan yang ditentukan.

L5. Validasi POST dan PUT belum menerapkan batas panjang motivasi 20–300 karakter.

L6. POST berhasil masih mengembalikan HTTP 200, padahal spesifikasinya HTTP 201.

L7. PUT menolak siswa_id milik pendaftaran yang sedang diedit karena pemeriksaan duplikat belum membedakan record sendiri dengan pendaftaran lain.

L8. PUT mengembalikan respons berhasil, tetapi perubahan pilihan_bidang dan motivasi belum tersimpan ke database.

L9. DELETE mengembalikan HTTP 204 tanpa body, tetapi pendaftaran belum benar-benar dihapus.

Ketentuan penting:
- Validasi required dan tipe data harus sudah berfungsi.
- Pemeriksaan keberadaan siswa_id pada PUT harus sudah benar.
- Pemeriksaan duplikat pada PUT tetap menolak siswa_id milik pendaftaran lain.
- PUT dan DELETE sudah memiliki pencarian ID serta penanganan 404 yang benar.
- Semua perilaku selain L1–L9 harus sesuai spesifikasi.
- Masalah boleh saling menutupi. README harus menjelaskan bahwa siswa perlu menguji ulang setelah memperbaiki satu masalah.
- Untuk mengamati L8 sebelum L7 diperbaiki, pengujian oleh pembuat project boleh menggunakan siswa_id dari siswa yang belum terdaftar.


9. KOMENTAR PETUNJUK DI KODE

Pasang komentar TODO LATIHAN L1 sampai L9 pada lokasi terkait.

Setiap komentar memuat:
- Perilaku yang seharusnya terjadi.
- Cara membuktikan masalah melalui Postman.
- Satu pertanyaan penuntun.

Jangan mencantumkan:
- Kode solusi.
- Nama aturan validasi yang menjadi jawaban.
- Potongan perbaikan siap salin.

Contoh gaya komentar:

// TODO LATIHAN L3:
// Satu siswa hanya boleh mendaftar satu kali.
// Kirim dua POST valid dengan siswa_id yang sama.
// Bandingkan respons kedua dan jumlah record.
// Di bagian mana aturan ini seharusnya diperiksa?

Untuk masalah yang berlaku pada POST dan PUT, gunakan kode TODO yang sama di kedua lokasi.


10. README UNTUK SISWA

Buat README berbahasa Indonesia yang jelas, ringkas, dan dapat diikuti siswa.

Susun bagian berikut:

A. Tujuan latihan

Jelaskan bahwa siswa memperbaiki API berdasarkan spesifikasi dan membuktikan hasilnya melalui Postman serta database.

B. Prasyarat

Cantumkan kebutuhan PHP, Composer, Git, MySQL, dan Postman sesuai project yang benar-benar dibuat.

C. Instalasi

Urutan:
1. Fork repository guru melalui GitHub.
2. Clone repository hasil fork milik sendiri.
3. Masuk ke folder project.
4. Jalankan composer install.
5. Salin .env.example menjadi .env.
6. Jalankan php artisan key:generate.
7. Buat database MySQL pendaftaran_osis.
8. Sesuaikan konfigurasi database pada .env.
9. Jalankan php artisan migrate --seed.
10. Jalankan php artisan serve.

Sediakan perintah salin .env untuk Windows PowerShell dan macOS/Linux.

Gunakan placeholder:
<URL_REPOSITORY_HASIL_FORK>

Jangan mengarang URL repository guru.

Jelaskan:
- Fork membuat salinan repository pada akun GitHub siswa.
- Clone mengunduh repository tersebut ke komputer siswa.
- Push mengirim perubahan lokal ke repository hasil fork.

D. Alur pengerjaan

1. Jalankan project dan periksa data master.
2. Catat hasil pengujian awal sebelum memperbaiki kode.
3. Telusuri TODO L1–L9.
4. Perbaiki satu masalah, lalu uji ulang.
5. Bandingkan respons dengan kondisi database.
6. Catat hasil sebelum dan sesudah perbaikan.
7. Commit perubahan secara bertahap.
8. Push ke repository hasil fork.

E. Daftar masalah dan spesifikasi

Cantumkan L1–L9 beserta kriteria keberhasilannya.
Cantumkan aturan POST, PUT, dan DELETE.
Jangan memberikan solusi implementasi.

F. Penggunaan Postman

Jelaskan:
- Memilih method dan URL.
- Menggunakan Accept: application/json.
- Menggunakan Content-Type: application/json untuk POST dan PUT.
- Memilih Body raw JSON.
- GET dan DELETE pada latihan ini tidak membutuhkan body.

Berikan satu contoh body valid.

Ingatkan siswa mengambil siswa_id dari endpoint master, bukan menebak ID.
Untuk POST valid, pilih siswa yang belum terdaftar.

Jangan memberikan collection berisi jawaban atau hasil uji yang sudah selesai.


11. SKENARIO PENGUJIAN WAJIB

Sediakan tabel kosong dalam README:

Nomor | Skenario | Perkiraan status | Status aktual |
Ringkasan respons | Perubahan database | Kesimpulan

Siswa mengisi perkiraan sebelum menjalankan request.

Skenario:

1. GET /api/kelas.
2. GET /api/jenis-kelamin.
3. GET /api/siswa.
4. GET daftar pendaftaran beserta data relasinya.
5. GET detail pendaftaran yang tersedia.
6. GET detail ID yang tidak tersedia.
7. POST pendaftaran valid.
8. POST kedua dengan siswa_id yang sama.
9. POST dengan siswa_id yang tidak tersedia.
10. POST dengan pilihan_bidang di luar ketentuan.
11. POST dengan motivasi 19 karakter.
12. POST dengan motivasi 301 karakter.
13. PUT valid menggunakan siswa_id yang tetap sama.
14. PUT menggunakan siswa_id milik pendaftaran lain.
15. PUT dengan pilihan_bidang invalid.
16. PUT dengan motivasi di luar batas panjang.
17. PUT terhadap ID pendaftaran yang tidak tersedia.
18. DELETE terhadap pendaftaran yang tersedia.
19. GET detail terhadap pendaftaran yang sudah dihapus.
20. DELETE kembali terhadap ID yang sudah dihapus.

Petunjuk pengujian:
- Setiap uji invalid hanya mengubah satu kondisi.
- Field lain harus valid.
- Untuk uji POST invalid, gunakan siswa yang belum terdaftar, kecuali pada uji duplikat.
- Untuk PUT invalid, gunakan siswa_id milik record sendiri setelah L7 diperbaiki.
- Pastikan dua pendaftaran tersedia untuk menguji duplikat.
- DELETE dilakukan paling akhir agar data untuk PUT masih tersedia.

Bukti database:
- POST valid: jumlah record bertambah tepat satu.
- POST invalid: jumlah record tidak berubah.
- PUT valid: ID tetap, jumlah record tetap, field berubah sesuai request.
- PUT invalid: seluruh data record tetap.
- DELETE valid: jumlah record berkurang tepat satu.
- Record lain dan data master tetap tersedia.

Jelaskan bahwa sebelum diperbaiki, hasil aktual dapat berbeda dari perkiraan.
Siswa wajib menguji ulang kasus yang gagal setelah perbaikan.


12. PERTANYAAN ANALISIS

Cantumkan tanpa jawaban:

1. Saat pengujian melalui Postman, siapa client dan siapa server? Bagian request mana yang menentukan proses Laravel?

2. Mengapa request menggunakan siswa_id, bukan mengirim ulang nama siswa, kelas, dan jenis kelamin?

3. Telusuri satu request POST dari route, controller, validasi, database, hingga respons. Tunjukkan lokasi kode yang terlibat.

4. Jika siswa_id tidak tersedia, apa perbedaan antara menolaknya melalui validasi API dan membiarkannya gagal saat penyimpanan database?

5. Mengapa pendaftaran kedua perlu ditolak meskipun seluruh field sudah terisi?

6. Mengapa siswa_id milik record sendiri boleh digunakan pada PUT, tetapi siswa_id milik pendaftaran lain harus ditolak?

7. Bagaimana membuktikan PUT benar-benar mengubah data, bukan hanya mengembalikan pesan berhasil?

8. Mengapa menghapus pendaftaran tidak boleh sekaligus menghapus data siswa?

9. Mengapa DELETE pertama berhasil, sedangkan DELETE kedua terhadap ID yang sama menghasilkan 404?

10. Pilih satu masalah yang kamu perbaiki. Jelaskan perilaku sebelum perbaikan, perubahan kode yang dilakukan, dan bukti setelah perbaikan.

11. Apakah status berhasil cukup untuk membuktikan API benar? Gunakan hasil pengujianmu sebagai alasan.


13. PENGUMPULAN MELALUI FORK

Siswa wajib mengumpulkan:

A. Tautan repository hasil fork
- Berisi kode yang sudah diperbaiki.
- Perubahan sudah di-commit dan di-push.
- Repository dapat diakses guru.

B. Collection Postman
- Format JSON.
- Mencakup GET, POST, PUT, dan DELETE.
- Disimpan pada folder docs/postman.
- Request diberi nama sesuai skenario pengujian.

C. Laporan PDF
Disimpan pada folder docs/laporan dan berisi:
- Identitas siswa.
- Tabel hasil pengujian.
- Bukti sebelum dan sesudah perbaikan.
- Screenshot method, URL, status, dan body respons.
- Bukti perubahan atau tidak berubahnya database.
- Jawaban pertanyaan analisis.

Jangan mengumpulkan:
- File .env.
- Kredensial.
- Folder vendor.
- Data pribadi asli.

AI boleh digunakan saat pengerjaan.
Siswa wajib menjelaskan kode dan hasil uji secara individual tanpa jawaban dari AI atau teman saat verifikasi.

Buat folder docs/postman dan docs/laporan dengan .gitkeep.
Jangan mengisi laporan atau jawaban siswa.


14. PEMERIKSAAN OLEH PEMBUAT PROJECT

Sebelum menyerahkan starter, verifikasi:
- Instalasi dapat dijalankan.
- Migration dan seeder berhasil.
- Route API terdaftar.
- Ketiga endpoint master berfungsi.
- GET detail dan 404 berfungsi benar.
- POST valid dapat menyimpan data.
- PUT dan DELETE dapat diakses.
- Tepat sembilan masalah muncul sesuai rancangan.
- Tidak ada masalah tambahan.

Lakukan pemeriksaan menggunakan data uji sementara.
Setelah pemeriksaan, pulihkan database ke kondisi seeder.
Jangan memperbaiki sembilan masalah pada starter.
Jangan menyimpan jawaban atau kode solusi pada repository.


15. OUTPUT AKHIR

Hasilkan:
- Project starter Laravel yang dapat dijalankan.
- Model, migration, seeder, controller, dan route API.
- Komentar TODO LATIHAN L1–L9.
- README lengkap untuk siswa.
- Folder pengumpulan docs/postman dan docs/laporan.
- .gitignore yang sesuai.

Pada respons akhir kepada guru, berikan:
- Ringkasan struktur project.
- Daftar file yang dibuat atau diubah.
- Lokasi sembilan masalah.
- Hasil pemeriksaan yang benar-benar dijalankan.
- Batasan pemeriksaan jika ada.

Catatan pemeriksaan guru disampaikan pada respons akhir.
Jangan memasukkan solusi ke README atau repository siswa.

Jika instalasi atau pengujian terhalang lingkungan, jelaskan kendalanya dengan jujur. Jangan mengklaim pemeriksaan berhasil jika belum dilakukan.