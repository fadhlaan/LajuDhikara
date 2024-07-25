<?php
require '../config.php';

if (isset($_POST['submit'])) {
    $id_periode = isset($_POST['id_periode']) ? $_POST['id_periode'] : '';
    $bulan = isset($_POST['bulan']) ? $_POST['bulan'] : '';
    $tahun = isset($_POST['tahun']) ? $_POST['tahun'] : '';

    if (isset($conn)) {
        $query = "UPDATE periode SET bulan = ?, tahun = ? WHERE id_periode = ?";
        $stmt = $conn->prepare($query);
        if ($stmt) {
            $stmt->bind_param("ssi", $bulan, $tahun, $id_periode); // Perbaikan: Ubah "si" menjadi "ssi" untuk mengubah tipe data $id_periode menjadi string
            if ($stmt->execute()) {
                if ($stmt->affected_rows > 0) {
                    echo "<script>alert('Data berhasil diubah.'); window.location.href = 'periode.php';</script>";
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