<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $email = $_POST['email'];
    $full_name = $_POST['full_name'];
    $alamat = $_POST['alamat'];
    $no_hp = $_POST['no_hp'];
    $sekolah = $_POST['sekolah'];
    $kelas = $_POST['kelas'];

    $stmt = $pdo->prepare("INSERT INTO users (username, password, email, full_name, alamat, no_hp, sekolah, kelas) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    if ($stmt->execute([$username, $password, $email, $full_name, $alamat, $no_hp, $sekolah, $kelas])) {
        header("Location: login.php");
        exit;
    } else {
        echo "Registration failed.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Register</h1>
        <form method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="email" name="email" placeholder="Email">
            <input type="text" name="full_name" placeholder="Full Name">
            <input type="text" name="alamat" placeholder="Alamat">
            <input type="text" name="no_hp" placeholder="Nomor HP">
            <input type="text" name="sekolah" placeholder="Sekolah">
            <input type="text" name="kelas" placeholder="Kelas">
            <button type="submit">Register</button>
        </form>
    </div>
</body>
</html>
