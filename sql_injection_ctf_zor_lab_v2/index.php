<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $conn = new mysqli("localhost", "root", "", "ctf_zor");


    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);
    
    if ($result && $result->num_rows > 0) {
        $_SESSION["auth"] = true;
        header("Location: panel.php");
        exit();
    } else {
        $error = "Geçersiz kullanıcı adı veya şifre.";
    }
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="UTF-8">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <title>Giriş</title>
</head>
<body class="bg-light">
  <div class="container mt-5">
    <h2 class="text-center mb-4">CTF Giriş</h2>
    <form method="POST" class="mx-auto" style="max-width:400px;">
      <input type="text" name="username" class="form-control mb-2" placeholder="Kullanıcı Adı" required>
      <input type="password" name="password" class="form-control mb-2" placeholder="Şifre" required>
      <button class="btn btn-primary w-100">Giriş Yap</button>
      <?php if (isset($error)) echo "<div class='alert alert-danger mt-2'>$error</div>"; ?>
    </form>
  </div>
</body>
</html>
