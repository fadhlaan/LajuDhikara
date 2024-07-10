<?php
require_once '../config.php';

if (isset($_POST['submit'])) {
    $nama_satuan = $_POST['nama_satuan'];
    // Tambahkan pengecekan apakah $config sudah diinisialisasi sebelum digunakan
    if (isset($conn)) {
        // Tambahkan pengecekan apakah username sudah ada
        $check_query = "SELECT * FROM satuan WHERE nama_satuan = ?";
        $check_stmt = $conn->prepare($check_query);
        $check_stmt->bind_param("s", $nama_satuan);
        $check_stmt->execute();
        $check_stmt->store_result();

        if ($check_stmt->num_rows > 0) {
            echo "<script>window.alert('Jenis sudah ada.'); window.history.back();</script>"; // Menampilkan alert bahwa username sudah ada dan redirect ke halaman sebelumnya
            exit();
        }

        $query = "INSERT INTO satuan (nama_satuan) VALUES (?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $nama_satuan);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            echo "satuan baru berhasil ditambahkan!";
            echo "<script>window.alert('Data berhasil ditambah.'); window.location.href = 'satuan.php';</script>"; // Menampilkan alert bahwa data berhasil ditambah dan redirect ke halaman pengguna.php
            exit();
        } else {
            echo "Gagal menambahkan satuan baru.";
        }
    } else {
        echo "Koneksi database gagal.";
    }
}