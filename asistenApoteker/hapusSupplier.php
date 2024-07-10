<?php
require_once '../config.php';

if (isset($_GET['id_supplier'])) {
    $id_supplier = $_GET['id_supplier'];

    // Tambahkan pengecekan apakah $config sudah diinisialisasi sebelum digunakan
    if (isset($conn)) {
        $query = "DELETE FROM supplier WHERE id_supplier = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $id_supplier);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            echo "Supplier berhasil dihapus!";
            echo "<script>window.alert('Data berhasil dihapus');</script>"; // Menampilkan alert bahwa data berhasil dihapus
            header("Location: supplier.php"); // Redirect to pengguna.php after successful deletion
            exit();
        } else {
            echo "Gagal menghapus Supplier.";
        }
    } else {
        echo "Koneksi database gagal.";
    }
}