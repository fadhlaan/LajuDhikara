<?php
require_once '../config.php';

if (isset($_POST['submit'])) {
    $nama_supplier = $_POST['nama_supplier'];
    // Tambahkan pengecekan apakah $config sudah diinisialisasi sebelum digunakan
    if (isset($conn)) {
        // Tambahkan pengecekan apakah username sudah ada
        $check_query = "SELECT * FROM supplier WHERE nama_supplier = ?";
        $check_stmt = $conn->prepare($check_query);
        $check_stmt->bind_param("s", $nama_supplier);
        $check_stmt->execute();
        $check_stmt->store_result();

        if ($check_stmt->num_rows > 0) {
            echo "<script>window.alert('Supplier sudah ada.'); window.history.back();</script>"; // Menampilkan alert bahwa username sudah ada dan redirect ke halaman sebelumnya
            exit();
        }

        $query = "INSERT INTO supplier (nama_supplier) VALUES (?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $nama_supplier);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            echo "Supplier baru berhasil ditambahkan!";
            echo "<script>window.alert('Data berhasil ditambah.'); window.location.href = 'jenis.php';</script>"; // Menampilkan alert bahwa data berhasil ditambah dan redirect ke halaman pengguna.php
            exit();
        } else {
            echo "Gagal menambahkan supplier baru.";
        }
    } else {
        echo "Koneksi database gagal.";
    }
}
?>
