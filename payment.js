document.getElementById("submit-payment").addEventListener("click", async function () {
    let formData = new FormData();
    formData.append("card_type", document.getElementById("card-type").value);
    formData.append("amount", document.getElementById("amount").value);
    formData.append("card_code", document.getElementById("card-code").value);
    formData.append("card_seri", document.getElementById("card-seri").value);

    let response = await fetch("php/napthe.php", {
        method: "POST",
        body: formData
    });

    let data = await response.json();
    alert(data.message);
});

