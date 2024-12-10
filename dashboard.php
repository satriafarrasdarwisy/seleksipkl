<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Welcome, <?php echo htmlspecialchars($user['full_name']); ?>!</h1>
        <p>Email: <?php echo htmlspecialchars($user['email']); ?></p>
        <p>Alamat: <?php echo htmlspecialchars($user['alamat']); ?></p>
        <p>Nomor HP: <?php echo htmlspecialchars($user['no_hp']); ?></p>
        <p>Sekolah: <?php echo htmlspecialchars($user['sekolah']); ?></p>
        <p>Kelas: <?php echo htmlspecialchars($user['kelas']); ?></p>
        <a href="edit_profile.php">Edit Profile</a> | <a href="logout.php">Logout</a>
    </div>
</body>
</html>
