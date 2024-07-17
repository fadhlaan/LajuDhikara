<?php
session_start();
include 'config.php'; // Sertakan file konfigurasi database Anda

$username = $_POST['username'];
$password = $_POST['password'];

// Pastikan nama kolom sesuai dengan yang ada di database
$sql = "SELECT jabatan FROM pengguna WHERE username = ? AND password = ?";
$stmt = $conn->prepare($sql);

// Periksa apakah statement berhasil dipersiapkan
if ($stmt) {
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        $_SESSION['jabatan'] = $row['jabatan'];
        // Redirect berdasarkan role
        switch ($row['jabatan']) {
            case 'admin':
                header('Location: admin/index.php');
                break;
            case 'direktur keuangan':
                header('Location: direkturkeuangan/index.php');
                break;
            case 'direktur utama':
                header('Location: direkturutama/index.php');
                break;
            case 'asisten apoteker':
                header('Location: asistenApoteker/index.php');
                break;
            case 'apoteker penanggung jawab':
                header('Location: apotekerpenanggungjawab/index.php');
                break;
            default:
                header('Location: login.php'); // Redirect kembali jika role tidak dikenali
                break;
        }
    } else {
        echo "<script>alert('Username atau password salah!'); window.location.href='login.php';</script>";
    }
} else {
    echo "Query error: " . $conn->error;
}

$stmt->close();
$conn->close();
?>