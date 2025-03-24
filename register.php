<?php
include "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST["username"]);
    $password = password_hash($_POST["password"], PASSWORD_BCRYPT);

    // Kiểm tra tài khoản đã tồn tại chưa
    $check_user = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");
    if (mysqli_num_rows($check_user) > 0) {
        echo json_encode(["status" => "error", "message" => "Tên đăng nhập đã tồn tại!"]);
        exit();
    }

    // Thêm vào database
    $sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
    if (mysqli_query($conn, $sql)) {
        echo json_encode(["status" => "success", "message" => "Đăng ký thành công!"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Lỗi khi đăng ký!"]);
    }
}
?>
