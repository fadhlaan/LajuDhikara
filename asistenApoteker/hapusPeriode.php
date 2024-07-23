<?php
require_once '../config.php';

if (isset($_GET['id_periode'])) {
    $id_periode = $_GET['id_periode'];

    // Tambahkan pengecekan apakah $config sudah diinisialisasi sebelum digunakan
    if (isset($conn)) {
        $query = "DELETE FROM periode WHERE id_periode = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $id_periode);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            echo "Jenis berhasil dihapus!";
            echo "<script>window.alert('Data berhasil dihapus');</script>"; // Menampilkan alert bahwa data berhasil dihapus
            header("Location: periode.php"); // Redirect to pengguna.php after successful deletion
            exit();
        } else {
            echo "Gagal menghapus jenis.";
        }
    } else {
        echo "Koneksi database gagal.";
    }
}
