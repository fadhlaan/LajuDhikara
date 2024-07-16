<?php
require '../config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari form
    $id_periode_bulan = $_POST['bulan'];
    $id_periode_tahun = $_POST['tahun'];
    $id_obat = $_POST['nama_obat']; // Menggunakan nama_obat untuk mendapatkan id_obat
    $jumlah_penjualan = $_POST['jumlah_penjualan'];

    // Query untuk mendapatkan bulan dan tahun dari tabel periode berdasarkan id_periode
    $queryPeriodeBulan = "SELECT bulan FROM periode WHERE id_periode = '$id_periode_bulan'";
    $queryPeriodeTahun = "SELECT tahun FROM periode WHERE id_periode = '$id_periode_tahun'";
    $resultPeriodeBulan = mysqli_query($conn, $queryPeriodeBulan);
    $resultPeriodeTahun = mysqli_query($conn, $queryPeriodeTahun);

    if ($resultPeriodeBulan && $resultPeriodeTahun) {
        $rowPeriodeBulan = mysqli_fetch_assoc($resultPeriodeBulan);
        $rowPeriodeTahun = mysqli_fetch_assoc($resultPeriodeTahun);
        $bulan = $rowPeriodeBulan['bulan'];
        $tahun = $rowPeriodeTahun['tahun'];

        // Masukkan data ke tabel obat_masuk
        $queryInsert = "INSERT INTO penjualan (id_periode, bulan, tahun, id_obat, jumlah_penjualan) VALUES ('$id_periode_bulan', '$bulan', '$tahun', '$id_obat', '$jumlah_penjualan')";

        if (mysqli_query($conn, $queryInsert)) {
            echo "<script>alert('Data berhasil ditambahkan.'); window.location.href='penjualan.php';</script>";
        } else {
            echo "Error: " . $queryInsert . "<br>" . mysqli_error($conn);
        }
    } else {
        echo "Error: " . $queryPeriodeBulan . " / " . $queryPeriodeTahun . "<br>" . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>
