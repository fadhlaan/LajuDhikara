<?php
require_once '../config.php';

if (isset($_POST['submit'])) {
    $nama_pengguna = $_POST['nama_pengguna'];
    $jabatan = $_POST['jabatan'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // mengenkripsi password

    // Tambahkan pengecekan apakah $config sudah diinisialisasi sebelum digunakan
    if (isset($conn)) {
        // Tambahkan pengecekan apakah username sudah ada
        $check_query = "SELECT * FROM pengguna WHERE username = ?";
        $check_stmt = $conn->prepare($check_query);
        $check_stmt->bind_param("s", $username);
        $check_stmt->execute();
        $check_stmt->store_result();

        if ($check_stmt->num_rows > 0) {
            echo "<script>window.alert('Username sudah ada.'); window.history.back();</script>"; // Menampilkan alert bahwa username sudah ada dan redirect ke halaman sebelumnya
            exit();
        }

        $query = "INSERT INTO pengguna (jabatan, nama_pengguna, username, email, password) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sssss", $jabatan, $nama_pengguna, $username, $email, $password);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            echo "Pengguna baru berhasil ditambahkan!";
            echo "<script>window.alert('Data berhasil ditambah.'); window.location.href = 'pengguna.php';</script>"; // Menampilkan alert bahwa data berhasil ditambah dan redirect ke halaman pengguna.php
            exit();
        } else {
            echo "Gagal menambahkan pengguna baru.";
        }
    } else {
        echo "Koneksi database gagal.";
    }
}
?>
