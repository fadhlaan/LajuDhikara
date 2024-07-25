<?php
require_once '../config.php';

if (isset($_POST['submit'])) {
    $bulan = $_POST['bulan'];
    $tahun = $_POST['tahun'];
    // Tambahkan pengecekan apakah $config sudah diinisialisasi sebelum digunakan
    if (isset($conn)) {
        // Tambahkan pengecekan apakah username sudah ada
        $check_query = "SELECT * FROM periode WHERE bulan = ? AND tahun = ?";
        $check_stmt = $conn->prepare($check_query);
        $check_stmt->bind_param("ss", $bulan, $tahun);
        $check_stmt->execute();
        $check_stmt->store_result();

        if ($check_stmt->num_rows > 0) {
            echo "<script>window.alert('Bulan sudah ada.'); window.history.back();</script>"; // Menampilkan alert bahwa username sudah ada dan redirect ke halaman sebelumnya
            exit();
        }

        $query = "INSERT INTO periode (bulan, tahun) VALUES (?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ss", $bulan, $tahun);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            echo "Periode baru berhasil ditambahkan!";
            echo "<script>window.alert('Data berhasil ditambah.'); window.location.href = 'periode.php';</script>"; // Menampilkan alert bahwa data berhasil ditambah dan redirect ke halaman pengguna.php
            exit();
        } else {
            echo "Gagal menambahkan periode baru.";
        }
    } else {
        echo "Koneksi database gagal.";
    }
}
?>
