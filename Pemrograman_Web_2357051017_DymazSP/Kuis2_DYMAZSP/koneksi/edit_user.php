<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container d-flex justify-content-center align-items-center vh-100">

    <div class="card shadow-lg p-4" style="width: 400px;">
        <div class="card-header text-center bg-warning text-dark">
            <h3>Edit User</h3>
        </div>
        <div class="card-body">
            <?php
            session_start();
            $host = "localhost"; 
            $username = "root"; 
            $password = ""; 
            $database = "login_db";

            $conn = new mysqli($host, $username, $password, $database);

            if ($conn->connect_error) {
                die("Koneksi gagal: " . $conn->connect_error);
            }

            $id = $_GET["id"];
            $sql = "SELECT * FROM users WHERE id=$id";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $new_username = $_POST["username"];
                $new_password = password_hash($_POST["password"], PASSWORD_DEFAULT);

                $sql = "UPDATE users SET username='$new_username', password='$new_password' WHERE id=$id";
                if ($conn->query($sql) === TRUE) {
                    echo "<div class='alert alert-success text-center'>User berhasil diperbarui!</div>";
                    header("Location: user.php");
                    exit();
                } else {
                    echo "<div class='alert alert-danger text-center'>Terjadi kesalahan: " . $conn->error . "</div>";
                }
            }

            $conn->close();
            ?>
            <form method="post">
                <div class="mb-3">
                    <label for="username" class="form-label">Username:</label>
                    <input type="text" name="username" id="username" class="form-control" value="<?php echo $row['username']; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password:</label>
                    <input type="password" name="password" id="password" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-warning w-100">Update User</button>
            </form>
        </div>
        <div class="card-footer text-center">
            <a href="user.php" class="btn btn-link">Kembali ke Manajemen User</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
