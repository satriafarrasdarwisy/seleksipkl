<?php
session_start();
include 'config.php';

// Cek apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Proses update data
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $full_name = $_POST['full_name'];
    $alamat = $_POST['alamat'];
    $no_hp = $_POST['no_hp'];
    $sekolah = $_POST['sekolah'];
    $kelas = $_POST['kelas'];

    // Update data di database
    $stmt = $pdo->prepare("UPDATE users SET email = ?, full_name = ?, alamat = ?, no_hp = ?, sekolah = ?, kelas = ? WHERE id = ?");
    $stmt->execute([$email, $full_name, $alamat, $no_hp, $sekolah, $kelas, $_SESSION['user_id']]);

    // Redirect ke dashboard setelah update berhasil
    header("Location: dashboard.php");
    exit;
}

// Ambil data pengguna untuk form
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Edit Profile</h1>
        <form method="POST">
            <input type="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
            <input type="text" name="full_name" value="<?php echo htmlspecialchars($user['full_name']); ?>" required>
            <input type="text" name="alamat" value="<?php echo htmlspecialchars($user['alamat']); ?>" required>
            <input type="text" name="no_hp" value="<?php echo htmlspecialchars($user['no_hp']); ?>" required>
            <input type="text" name="sekolah" value="<?php echo htmlspecialchars($user['sekolah']); ?>" required>
            <input type="text" name="kelas" value="<?php echo htmlspecialchars($user['kelas']); ?>" required>
            <button type="submit">Update</button>
        </form>
        <a href="dashboard.php">Cancel and Go Back to Dashboard</a>
    </div>
</body>
</html>
