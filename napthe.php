<?php
include "config.php"; // Kết nối database

// Nhận dữ liệu từ form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_POST["user_id"];
    $card_type = $_POST["card_type"];
    $card_code = $_POST["card_code"];
    $card_serial = $_POST["card_serial"];
    $amount = $_POST["amount"];

    // API key lấy từ nhà cung cấp
    $api_key = "YOUR_API_KEY_HERE";  
    $api_url = "https://example.com/api/napthe"; // Link API của nhà cung cấp

    // Tạo dữ liệu gửi lên API
    $data = [
        "api_key" => $api_key,
        "card_type" => $card_type,
        "card_code" => $card_code,
        "card_serial" => $card_serial,
        "amount" => $amount
    ];

    // Gửi yêu cầu đến API
    $ch = curl_init($api_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
    $response = curl_exec($ch);
    curl_close($ch);

    // Xử lý phản hồi từ API
    $result = json_decode($response, true);
    if ($result["status"] == "success") {
        // Lưu giao dịch vào database
        $sql = "INSERT INTO transactions (user_id, card_type, amount, status) 
                VALUES ('$user_id', '$card_type', '$amount', 'Thành công')";
        mysqli_query($conn, $sql);

        echo json_encode(["status" => "success", "message" => "Nạp thẻ thành công!"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Nạp thẻ thất bại!"]);
    }
}
?>
