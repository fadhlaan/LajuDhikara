<?php
require_once '../config.php';

if (isset($_POST['submit'])) {
    $nama_jenis = $_POST['nama_jenis'];
    // Tambahkan pengecekan apakah $config sudah diinisialisasi sebelum digunakan
    if (isset($conn)) {
        // Tambahkan pengecekan apakah username sudah ada
        $check_query = "SELECT * FROM jenis WHERE nama_jenis = ?";
        $check_stmt = $conn->prepare($check_query);
        $check_stmt->bind_param("s", $nama_jenis);
        $check_stmt->execute();
        $check_stmt->store_result();

        if ($check_stmt->num_rows > 0) {
            echo "<script>window.alert('Jenis sudah ada.'); window.history.back();</script>"; // Menampilkan alert bahwa username sudah ada dan redirect ke halaman sebelumnya
            exit();
        }

        $query = "INSERT INTO jenis (nama_jenis) VALUES (?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $nama_jenis);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            echo "Jenis baru berhasil ditambahkan!";
            echo "<script>window.alert('Data berhasil ditambah.'); window.location.href = 'jenis.php';</script>"; // Menampilkan alert bahwa data berhasil ditambah dan redirect ke halaman pengguna.php
            exit();
        } else {
            echo "Gagal menambahkan jenis baru.";
        }
    } else {
        echo "Koneksi database gagal.";
    }
}
?>
