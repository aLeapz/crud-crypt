# crud-crypt
Inventory Management System dengan Kriptografi Stream XOR

Aplikasi berbasis web sederhana untuk manajemen stok barang (Inventory). Proyek ini menerapkan keamanan data menggunakan algoritma kriptografi simetris **AES-256-CTR** (Stream Cipher) untuk mengenkripsi harga beli barang.

Dibuat untuk memenuhi Tugas Mata Kuliah Kriptografi dan Steganografi IF502.

## Fitur Utama

* **CRUD Barang:** Menambah, Melihat, Mengubah (Stok), dan Menghapus data barang.
* **Manajemen Stok:**
    * Fitur `Pakai` (Mengurangi stok).
    * Fitur `Tambah` (Menambah stok).
    * Otomatis update status barang (`Available` / `Not Available`) berdasarkan jumlah stok.
* **Generate Kode Barang:** Input kode barang manual atau otomatis.
* **Keamanan Data (Kriptografi):** Enkripsi kolom sensitif pada database.

## Implementasi Kriptografi

Aplikasi ini menggunakan algoritma **AES-256-CTR** (*Advanced Encryption Standard* dalam mode *Counter*) yang bekerja sebagai *Stream Cipher*.

* **Algoritma:** AES-256-CTR.
* **Data yang Dienkripsi:** Kolom `harga_beli` pada tabel `tb_inventory`.
* **Cara Kerja:**
    1.  Saat user menginput harga (contoh: `5000`), sistem membuat **IV (Initialization Vector)** acak.
    2.  Data dienkripsi menjadi *ciphertext* (teks acak) menggunakan Kunci Rahasia + IV.
    3.  Database menyimpan gabungan `IV + Ciphertext` dalam format Base64.
    4.  Saat data ditampilkan di tabel, sistem mendekripsi kembali *ciphertext* menjadi angka asli agar bisa dibaca user.

> **Catatan Keamanan:** Teknik ini mencegah pihak yang memiliki akses database (SQL Dump) untuk melihat harga modal asli barang.

## Teknologi yang Digunakan

* **Backend:** PHP Native
* **Frontend:** Bootstrap 5 (Template SB Admin)
* **Database:** MySQL
* **Server:** XAMPP (Apache)

## Cara Instalasi (Localhost)

1.  **Clone/Download Repository**
    
2.  **Siapkan Database**
    * Buka XAMPP Control Panel, nyalakan Apache dan MySQL.
    * Buka `phpMyAdmin` (http://localhost/phpmyadmin).
    * Buat database baru bernama `db_inventory`.
    * Import file `db_inventory.sql` yang ada di folder `CRUD/db`.

3.  **Memastikan Konfigurasi Koneksi**
    * Buka file `konek.php`.
    * Sesuaikan konfigurasi database:
        ```php
        $host = "localhost";
        $user = "root";
        $pass = "";
        $db_name = "db_inventory";
        ```
4.  **Jalankan Aplikasi**
    * Pindahkan folder CRUD dari repository ini ke folder `xampp/htdocs`.
    * Buka browser dan akses `http://localhost/CRUD`.
    * Kemudian Akses ke Bagian Tables untuk Mengolah Data.

## Screenshots Implementasi Kriptografi
### Data harga_beli Terenkripsi di Database
![Data Harga Beli Terenkripsi](https://i.ibb.co.com/8LRGSfSv/ss-enkripsi.png)

### Data harga_beli Terdekripsi di Tampilan Tables
![Dashboard Aplikasi Inventory](https://i.ibb.co.com/99JMS190/ss-dekripsi.png)

## Credits

* **Nama:** MUHAMMAD ALIF RIDO
* **NIM:** 230401010006
* **Kampus:** Universitas Siber Asia
* **Dosen Pengampu Mata Kuliah :** Alun Sujjada, S.Kom., M.T
  
---
