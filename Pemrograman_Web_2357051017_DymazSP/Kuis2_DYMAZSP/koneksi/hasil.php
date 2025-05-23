<?php
session_start();
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}

// Koneksi ke database
$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "hasil_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$sql = "SELECT file_name FROM uploads";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar File yang Diunggah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">

    <div class="card shadow-lg">
        <div class="card-header text-center bg-primary text-white">
            <h3>Daftar Nama File yang Telah Diunggah</h3>
        </div>
        <div class="card-body">
            <?php if ($result->num_rows > 0): ?>
                <ul class="list-group">
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <li class="list-group-item"><?php echo $row['file_name']; ?></li>
                    <?php endwhile; ?>
                </ul>
            <?php else: ?>
                <div class="alert alert-warning text-center">Belum ada file yang diunggah.</div>
            <?php endif; ?>
        </div>
        <div class="card-footer text-center">
            <a href="upload.php" class="btn btn-success">Kembali ke Upload</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
$conn->close();
?>
