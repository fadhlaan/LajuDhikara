<?php
require '../config.php';

$id_obatkeluar = $_GET['id_obatkeluar'];

$queryDelete = "DELETE FROM obat_keluar WHERE id_obatkeluar = $id_obatkeluar";

if (mysqli_query($conn, $queryDelete)) {
    echo "Data berhasil dihapus.";
    header("Location: obatKeluar.php");
} else {
    echo "Error: " . $queryDelete . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
?>
