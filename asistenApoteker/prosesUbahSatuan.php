<?php
require '../config.php';

if (isset($_POST['submit'])) {
    $id_satuan = isset($_POST['id_satuan']) ? $_POST['id_satuan'] : '';
    $nama_satuan = isset($_POST['nama_satuan']) ? $_POST['nama_satuan'] : '';

    if (isset($conn)) {
        $query = "UPDATE satuan SET nama_satuan = ? WHERE id_satuan = ?";
        $stmt = $conn->prepare($query);
        if ($stmt) {
            $stmt->bind_param("si", $nama_satuan, $id_satuan);
            if ($stmt->execute()) {
                if ($stmt->affected_rows > 0) {
                    echo "<script>alert('Data berhasil diubah.'); window.location.href = 'satuan.php';</script>";
                } else {
                    echo "Tidak ada perubahan data satuan.";
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