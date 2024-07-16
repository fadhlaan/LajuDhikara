<?php
require '../config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_penjualan = $_POST['id_penjualan'];
    $id_periode_bulan = $_POST['bulan'];
    $id_periode_tahun = $_POST['tahun'];
    $id_obat = $_POST['nama_obat'];
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

        $queryUpdate = "UPDATE penjualan SET id_periode='$id_periode_bulan', bulan='$bulan', tahun='$tahun', id_obat='$id_obat', jumlah_penjualan='$jumlah_penjualan' WHERE id_penjualan='$id_penjualan'";

        if (mysqli_query($conn, $queryUpdate)) {
            echo "<script>alert('Data berhasil diubah.'); window.location.href='penjualan.php';</script>";
        } else {
            echo "Error: " . $queryUpdate . "<br>" . mysqli_error($conn);
        }
    } else {
        echo "Error: " . $queryPeriodeBulan . " / " . $queryPeriodeTahun . "<br>" . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>
