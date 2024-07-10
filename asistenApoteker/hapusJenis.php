<?php
require_once '../config.php';

if (isset($_GET['id_jenis'])) {
    $id_jenis = $_GET['id_jenis'];

    // Tambahkan pengecekan apakah $config sudah diinisialisasi sebelum digunakan
    if (isset($conn)) {
        $query = "DELETE FROM jenis WHERE id_jenis = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $id_jenis);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            echo "Jenis berhasil dihapus!";
            echo "<script>window.alert('Data berhasil dihapus');</script>"; // Menampilkan alert bahwa data berhasil dihapus
            header("Location: jenis.php"); // Redirect to pengguna.php after successful deletion
            exit();
        } else {
            echo "Gagal menghapus jenis.";
        }
    } else {
        echo "Koneksi database gagal.";
    }
}
