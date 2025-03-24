<?php
session_start();
include "config.php";

if (!isset($_SESSION['user_id'])) {
    die("Bạn chưa đăng nhập!");
}

$user_id = $_SESSION['user_id'];
$card_type = $_POST['card_type'];
$amount = $_POST['amount'];
$card_code = $_POST['card_code'];
$card_seri = $_POST['card_seri'];
$api_key = "API_KEY_CUA_BAN";

$data = [
    "api_key" => $api_key,
    "type" => $card_type,
    "amount" => $amount,
    "code" => $card_code,
    "serial" => $card_seri
];

$curl = curl_init("https://thesieure.com/api/charge-card");
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_HTTPHEADER, ["Content-Type: application/json"]);

$response = curl_exec($curl);
curl_close($curl);
$result = json_decode($response, true);

$status = $result["status"] == "success" ? "Thành công" : "Thất bại";

$sql = "INSERT INTO transactions (user_id, card_type, amount, status) VALUES ('$user_id', '$card_type', '$amount', '$status')";
mysqli_query($conn, $sql);

echo json_encode(["status" => $status, "message" => $result["message"]]);
?>
