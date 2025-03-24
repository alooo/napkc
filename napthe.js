document.getElementById("napthe-button").addEventListener("click", async function () {
    let cardType = document.getElementById("card_type").value;
    let cardCode = document.getElementById("card_code").value;
    let cardSerial = document.getElementById("card_serial").value;
    let amount = document.getElementById("amount").value;

    let formData = new FormData();
    formData.append("user_id", "1"); // Lấy từ session đăng nhập
    formData.append("card_type", cardType);
    formData.append("card_code", cardCode);
    formData.append("card_serial", cardSerial);
    formData.append("amount", amount);

    let response = await fetch("php/napthe.php", {
        method: "POST",
        body: formData
    });

    let data = await response.json();
    document.getElementById("result").innerHTML = data.message;
});
