<?php
include "../config.php";

// Periksa koneksi
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Ambil id_pengguna dari query string
$get_id = $_GET['id_pengguna'] ?? null;

// Periksa apakah id_pengguna ada dalam query string
if (!$get_id) {
    die("ID Pengguna tidak ditemukan. Pastikan Anda mengirimkan ID Pengguna yang benar.");
}

// Jalankan query untuk mendapatkan data pengguna dengan menggunakan prepared statement untuk mencegah SQL injection
$stmt = $conn->prepare("SELECT * FROM pengguna WHERE id_pengguna=?");
$stmt->bind_param("s", $get_id);
$stmt->execute();
$result = $stmt->get_result();

// Periksa apakah query berhasil
if (!$result) {
    die("Query gagal: " . mysqli_error($conn));
}

// Ambil hasil query
$row = $result->fetch_assoc();

// Periksa apakah hasil query kosong
if (!$row) {
    die("Pengguna dengan ID tersebut tidak ditemukan. Apakah Anda yakin ID Pengguna tersebut ada?");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Ubah Data Pengguna</title>

    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        <!-- Sidebar content here... -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
                <!-- Topbar content here... -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <div class="container-fluid">
                        <!-- DataTales Example -->
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Ubah Data Pengguna</h6>
                            </div>
                            <div class="card-body">
                                <form method="post" action="prosesUbahPengguna.php">
                                    <div class="form-group">
                                        <label for="id_pengguna">ID Pengguna</label>
                                        <input type="text" class="form-control" name="id_pengguna" id="id_pengguna" placeholder="Masukkan ID Pengguna" value="<?php echo htmlspecialchars($row['id_pengguna']); ?>" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="nama_pengguna">Nama Pengguna</label>
                                        <input type="text" class="form-control" name="nama_pengguna" id="nama_pengguna" placeholder="Masukkan Nama Pengguna" value="<?php echo htmlspecialchars($row['nama_pengguna']); ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="username">Username</label>
                                        <input type="text" class="form-control" name="username" id="username" placeholder="Masukkan Username" pattern="^(?![_.])(?!.*[_.]{2})[a-zA-Z0-9._]+(?<![_.])$" minlength="5" aria-describedby="usernameValidation" value="<?php echo htmlspecialchars($row['username']); ?>" required>
                                        <div id="usernameValidation" class="validationMessage"></div>
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" name="email" id="email" placeholder="Masukkan Email" autocomplete="email" value="<?php echo htmlspecialchars($row['email']); ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password" class="form-control" name="password" id="password" placeholder="Masukkan Password" value="<?php echo htmlspecialchars($row['password']); ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="konfirmasiPassword">Konfirmasi Password</label>
                                        <input type="password" class="form-control" id="konfirmasiPassword" placeholder="Konfirmasi Password" value="<?php echo htmlspecialchars($row['password']); ?>" required>
                                        <span id="passwordValidation" style="color:red;"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="jabatan">Jabatan</label>
                                        <select class="form-control" name="jabatan" id="jabatan">
                                            <option value="" disabled selected>Pilih Jabatan</option>
                                            <?php
                                            // Assuming $result_jabatan is fetched from database before this point
                                            if ($result_jabatan && $result_jabatan->num_rows > 0) {
                                                while ($row_jabatan = $result_jabatan->fetch_assoc()) {
                                                    $jabatan = htmlspecialchars($row_jabatan['jabatan']);
                                                    echo '<option value="' . $jabatan . '"';
                                                    if ($row['jabatan'] == $jabatan) {
                                                        echo ' selected';
                                                    }
                                                    echo '>' . $jabatan . '</option>';
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <input type="submit" class="btn btn-success" name="submit" value="Submit">
                                    <a href="pengguna.php" class="btn btn-secondary">Kembali</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; PT. Laju Dhikara Abadi 2024</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->
        </div>
        <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <!-- Modal content here... -->

    <!-- Validasi form password-->
    <script>
        const password = document.getElementById('password');
        const konfirmasiPassword = document.getElementById('konfirmasiPassword');
        const passwordValidation = document.getElementById('passwordValidation');

        konfirmasiPassword.addEventListener('input', () => {
            if (password.value !== konfirmasiPassword.value) {
                passwordValidation.textContent = 'Password tidak sama';
            } else {
                passwordValidation.textContent = '';
            }
        });
    </script>

    <!-- Validasi form username-->
    <script>
        const form = document.querySelector('form');
        const usernameInput = form.elements.username;

        form.addEventListener('submit', (event) => event.preventDefault());

        const customValidationUsernameHandler = (event) => {
            event.target.setCustomValidity('');

            if (event.target.validity.valueMissing) {
                event.target.setCustomValidity('Wajib diisi.');
                return;
            }

            if (event.target.validity.tooShort) {
                event.target.setCustomValidity('Minimal panjang adalah enam karakter.');
                return;
            }

            if (event.target.validity.patternMismatch) {
                event.target.setCustomValidity(
                    'Tidak boleh diawali dengan simbol, mengandung white space atau spasi, dan mengandung karakter spesial seperti dolar ($).'
                );
                return;
            }
        };

        usernameInput.addEventListener('change', customValidationUsernameHandler);
        usernameInput.addEventListener('invalid', customValidationUsernameHandler);

        usernameInput.addEventListener('blur', (event) => {
            const isValid = event.target.validity.valid;
            const errorMessage = event.target.validationMessage;

            const connectedValidationId = event.target.getAttribute('aria-describedby');
            const connectedValidationEl = connectedValidationId
                ? document.getElementById(connectedValidationId)
                : null;

            if (connectedValidationEl && errorMessage && !isValid) {
                connectedValidationEl.innerText = errorMessage;
            } else {
                connectedValidationEl.innerText = '';
            }
        });
    </script>

    <!-- Bootstrap core JavaScript-->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="../vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../js/demo/chart-area-demo.js"></script>
    <script src="../js/demo/chart-pie-demo.js"></script>
</body>

</html>
