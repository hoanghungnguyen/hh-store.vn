<?php
session_start();
ob_start();


if (empty($_SESSION['btn-login'])) {
    header("location: index.php");
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
</head>

<body>
    <h1>Xin chào admin</h1>
</body>

</html>