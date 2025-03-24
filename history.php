<?php
session_start();
include "config.php";

if (!isset($_SESSION['user_id'])) {
    die("Bạn chưa đăng nhập!");
}

$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM transactions WHERE user_id='$user_id' ORDER BY created_at DESC";
$result = mysqli_query($conn, $sql);

$history = [];
while ($row = mysqli_fetch_assoc($result)) {
    $history[] = $row;
}

echo json_encode($history);
?>
