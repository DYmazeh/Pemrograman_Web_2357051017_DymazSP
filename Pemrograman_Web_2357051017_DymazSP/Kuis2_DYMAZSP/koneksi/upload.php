<?php
session_start();
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}

$servername = "localhost";
$username = "root"; 
$password = ""; 
$database = "hasil_db";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$target_dir = "C:/xampp/htdocs/Kuis2_DYMAZSP/uploads/";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_FILES["fileToUpload"]) && $_FILES["fileToUpload"]["error"] == 0) {
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        if ($imageFileType != "jpg") {
            $error = "Hanya file dengan format JPG yang diperbolehkan.";
        } else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                $file_name = basename($_FILES["fileToUpload"]["name"]);
                $sql = "INSERT INTO uploads (file_name) VALUES ('$file_name')";
                
                if ($conn->query($sql) === TRUE) {
                    $success = "File berhasil diunggah dan disimpan dalam database!";
                } else {
                    $error = "Terjadi kesalahan saat menyimpan data: " . $conn->error;
                }
            } else {
                $error = "Terjadi kesalahan saat mengunggah file.";
            }
        }
    } else {
        $error = "Silakan pilih file untuk diunggah.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Upload File</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">

    <div class="card shadow-lg p-4">
        <div class="card-header text-center bg-primary text-white">
            <h3>Upload File</h3>
        </div>
        <div class="card-body">
            <?php if (isset($error)): ?>
                <div class="alert alert-danger"><?php echo $error; ?></div>
            <?php endif; ?>
            <?php if (isset($success)): ?>
                <div class="alert alert-success"><?php echo $success; ?></div>
            <?php endif; ?>
            <form method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="fileToUpload" class="form-label">Pilih file JPG:</label>
                    <input type="file" name="fileToUpload" id="fileToUpload" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Upload</button>
            </form>
        </div>
        <div class="card-footer text-center">
            <a href="hasil.php" class="btn btn-success">Lihat Hasil Upload</a>
            <a href="user.php" class="btn btn-warning">Kelola Pengguna</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
