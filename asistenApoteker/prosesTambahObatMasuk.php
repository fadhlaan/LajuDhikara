<?php
require_once '../config.php';

if (isset($_POST['submit'])) {
    $bulan = $_POST['bulan'];
    $tahun = $_POST['tahun'];
    $id_obat = $_POST['nama_obat'];
    $jumlah_penerimaan = $_POST['jumlah_penerimaan'];

    // Tidak ada pengecekan apakah nama obat sudah ada karena perbolehkan kondisi nama obat yang sama

    if (isset($conn)) {
        $query = "INSERT INTO obat_masuk (nama_obat, bulan, tahun, jumlah_penerimaan) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ssss", $id_obat, $bulan, $tahun, $jumlah_penerimaan);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            echo "Obat baru berhasil ditambahkan!";
            echo "<script>window.alert('Data berhasil ditambah.'); window.location.href = 'obatMasuk.php';</script>"; // Menampilkan alert bahwa data berhasil ditambah dan redirect ke halaman obatMasuk.php
            exit();
        } else {
            echo "Gagal menambahkan obat baru.";
        }
    } else {
        echo "Koneksi database gagal.";
    }
}
?>
