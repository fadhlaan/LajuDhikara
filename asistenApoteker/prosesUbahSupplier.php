<?php
require '../config.php';

if (isset($_POST['submit'])) {
    $id_supplier = isset($_POST['id_supplier']) ? $_POST['id_supplier'] : '';
    $nama_supplier = isset($_POST['nama_supplier']) ? $_POST['nama_supplier'] : '';

    if (isset($conn)) {
        $query = "UPDATE supplier SET nama_supplier = ? WHERE id_supplier = ?";
        $stmt = $conn->prepare($query);
        if ($stmt) {
            $stmt->bind_param("si", $nama_supplier, $id_supplier);
            if ($stmt->execute()) {
                if ($stmt->affected_rows > 0) {
                    echo "<script>alert('Data berhasil diubah.'); window.location.href = 'supplier.php';</script>";
                } else {
                    echo "Tidak ada perubahan data supplier.";
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