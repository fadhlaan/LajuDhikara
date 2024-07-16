<?php
require '../config.php';

$id_penjualan = $_GET['id_penjualan'];

$queryDelete = "DELETE FROM penjualan WHERE id_penjualan = $id_penjualan";

if (mysqli_query($conn, $queryDelete)) {
    echo "Data berhasil dihapus.";
    header("Location: penjualan.php");
} else {
    echo "Error: " . $queryDelete . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
?>
