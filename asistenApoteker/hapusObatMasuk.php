<?php
require '../config.php';

$id_obatmasuk = $_GET['id_obatmasuk'];

$queryDelete = "DELETE FROM obat_masuk WHERE id_obatmasuk = $id_obatmasuk";

if (mysqli_query($conn, $queryDelete)) {
    echo "Data berhasil dihapus.";
    header("Location: obatMasuk.php");
} else {
    echo "Error: " . $queryDelete . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
?>
