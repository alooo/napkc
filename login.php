<?php
session_start();
include "config.php";

$username = $_POST['username'];
$password = md5($_POST['password']);

$sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    $_SESSION['username'] = $username;
    header("Location: ../napthe.html");
} else {
    echo "Sai tài khoản hoặc mật khẩu!";
}
?>
