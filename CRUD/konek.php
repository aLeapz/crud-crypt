<?php
//Connect php
$host = "localhost";
$user = "root";
$pass = "";
$db_name = "db_inventory";
$db = new mysqli($host, $user, $pass, $db_name);
//Cek koneksi
if ($db->connect_error) {
    die("Koneksi gagal: " . $db->connect_error);
}

// --- KONFIGURASI KRIPTOGRAFI (STREAM XOR / AES-CTR) ---

// 1. Kunci Enkripsi
define('ENCRYPTION_KEY', '4cf6dc124f816d5f256d04f68a25d8b0a06ccbb2665aaa4220723473bdab1953'); 

// 2. Fungsi Enkripsi (Dipanggil saat INSERT data)
function encryptData($plaintext) {
    $cipher_method = 'AES-256-CTR';
    $iv_length = openssl_cipher_iv_length($cipher_method);
    $iv = openssl_random_pseudo_bytes($iv_length); // Membuat IV unik (Nonce)
    
    // Proses XOR Stream
    $ciphertext = openssl_encrypt($plaintext, $cipher_method, ENCRYPTION_KEY, 0, $iv);
    
    // Gabungkan IV dan Ciphertext lalu encode ke Base64 agar aman disimpan di DB
    return base64_encode($iv . $ciphertext); 
}

// 3. Fungsi Dekripsi (Dipanggil saat SELECT/READ data)
function decryptData($encrypted_data) {
    $cipher_method = 'AES-256-CTR';
    
    // Decode dari Base64
    $data = base64_decode($encrypted_data);
    $iv_length = openssl_cipher_iv_length($cipher_method);
    
    // Pisahkan IV dan Ciphertext
    $iv = substr($data, 0, $iv_length);
    $ciphertext = substr($data, $iv_length);
    
    // Proses Balikan (Decrypt)
    return openssl_decrypt($ciphertext, $cipher_method, ENCRYPTION_KEY, 0, $iv);
}
?>