<?php
require '../config.php';

if (isset($_POST['submit'])) {
    $id_jenis = isset($_POST['id_jenis']) ? $_POST['id_jenis'] : '';
    $nama_jenis = isset($_POST['nama_jenis']) ? $_POST['nama_jenis'] : '';

    if (isset($conn)) {
        $query = "UPDATE jenis SET nama_jenis = ? WHERE id_jenis = ?";
        $stmt = $conn->prepare($query);
        if ($stmt) {
            $stmt->bind_param("si", $nama_jenis, $id_jenis);
            if ($stmt->execute()) {
                if ($stmt->affected_rows > 0) {
                    echo "<script>alert('Data berhasil diubah.'); window.location.href = 'jenis.php';</script>";
                } else {
                    echo "Tidak ada perubahan data jenis.";
                }
            } else {
                echo "Gagal mengeksekusi pernyataan SQL.";
            }
        } else {
            echo "Gagal menyiapkan pernyataan SQL.";
        }
    } else {
        echo "Koneksi database gagal.";
    }
}
?>