<?php
session_start();
if (!isset($_SESSION["auth"])) {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="UTF-8">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <title>Panel</title>
</head>
<body class="bg-white">
  <div class="container mt-5">
    <h2 class="text-success">Hoş Geldiniz!</h2>
    <p>Panelde yapılacak fazla bir şey yok gibi görünüyor :)</p>
    <p>Belki sistem loglarında ilginç bir şeyler olabilir.</p>
  </div>
</body>
</html>
