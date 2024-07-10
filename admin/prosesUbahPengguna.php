<?php
require '../config.php';

if (isset($_POST['submit'])) {
    $id_pengguna = isset($_POST['id_pengguna']) ? $_POST['id_pengguna'] : '';
    $nama_pengguna = isset($_POST['nama_pengguna']) ? $_POST['nama_pengguna'] : '';
    $username = isset($_POST['username']) ? $_POST['username'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $jabatan = isset($_POST['jabatan']) ? $_POST['jabatan'] : '';

    if (isset($conn)) {
        $query = "UPDATE pengguna SET nama_pengguna = ?, username = ?, email = ?, password = ?, jabatan = ? WHERE id_pengguna = ?";
        $stmt = $conn->prepare($query);
        if ($stmt) {
            $stmt->bind_param("sssssi", $nama_pengguna, $username, $email, $password, $jabatan, $id_pengguna);
            if ($stmt->execute()) {
                if ($stmt->affected_rows > 0) {
                    echo "Data pengguna berhasil diubah.";
                } else {
                    echo "Tidak ada perubahan data pengguna.";
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