<?php
require_once '../config.php';

if (isset($_GET['id'])) {
    $id_pengguna = $_GET['id'];

    // Tambahkan pengecekan apakah $config sudah diinisialisasi sebelum digunakan
    if (isset($conn)) {
        $query = "DELETE FROM pengguna WHERE id_pengguna = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $id_pengguna);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            echo "Pengguna berhasil dihapus!";
            echo "<script>window.alert('Data berhasil dihapus');</script>"; // Menampilkan alert bahwa data berhasil dihapus
            header("Location: pengguna.php"); // Redirect to pengguna.php after successful deletion
            exit();
        } else {
            echo "Gagal menghapus pengguna.";
        }
    } else {
        echo "Koneksi database gagal.";
    }
}
