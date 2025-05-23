<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container d-flex justify-content-center align-items-center vh-100">

    <div class="card shadow-lg p-4" style="width: 400px;">
        <div class="card-header text-center bg-success text-white">
            <h3>Register</h3>
        </div>
        <div class="card-body">
            <?php
            $host = "localhost"; 
            $username = "root"; 
            $password = ""; 
            $database = "login_db";

            $conn = new mysqli($host, $username, $password, $database);

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $user = $_POST["username"];
                $pass = password_hash($_POST["password"], PASSWORD_DEFAULT);

                $sql = "INSERT INTO users (username, password) VALUES ('$user', '$pass')";

                if ($conn->query($sql) === TRUE) {
                    echo "<div class='alert alert-success text-center'>Pendaftaran berhasil! Silakan <a href='login.php'>login</a>.</div>";
                } else {
                    echo "<div class='alert alert-danger text-center'>Terjadi kesalahan: " . $conn->error . "</div>";
                }
            }

            $conn->close();
            ?>
            <form method="post">
                <div class="mb-3">
                    <label for="username" class="form-label">Username:</label>
                    <input type="text" name="username" id="username" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password:</label>
                    <input type="password" name="password" id="password" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-success w-100">Register</button>
            </form>
        </div>
        <div class="card-footer text-center">
            <a href="login.php" class="btn btn-link">Sudah punya akun? Login di sini</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
