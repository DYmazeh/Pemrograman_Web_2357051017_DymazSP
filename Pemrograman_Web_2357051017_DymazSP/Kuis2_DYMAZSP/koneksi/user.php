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

// Pastikan query SQL dijalankan dengan benar
$sql = "SELECT * FROM users";
$result = $conn->query($sql);

if (!$result) {
    die("Query gagal: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Manajemen User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">

    <h2 class="text-center mb-4">Daftar User</h2>

    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row["id"]; ?></td>
                    <td><?php echo $row["username"]; ?></td>
                    <td>
                        <a href="edit_user.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="user.php?delete=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus user ini?');">Hapus</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="3" class="text-center">Belum ada user yang terdaftar.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <h2 class="text-center mt-4">Tambah User</h2>
    <form method="post" class="border p-4 rounded shadow-sm">
        <div class="mb-3">
            <label for="new_username" class="form-label">Username:</label>
            <input type="text" name="new_username" id="new_username" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="new_password" class="form-label">Password:</label>
            <input type="password" name="new_password" id="new_password" class="form-control" required>
        </div>
        <button type="submit" name="add_user" class="btn btn-primary">Tambah User</button>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
$conn->close();
?>
