document.getElementById("register-button").addEventListener("click", async function () {
    let username = document.getElementById("username").value;
    let password = document.getElementById("password").value;
    let confirmPassword = document.getElementById("confirm-password").value;

    if (password !== confirmPassword) {
        alert("Mật khẩu nhập lại không khớp!");
        return;
    }

    let formData = new FormData();
    formData.append("username", username);
    formData.append("password", password);

    let response = await fetch("php/register.php", {
        method: "POST",
        body: formData
    });

    let data = await response.json();
    alert(data.message);
    if (data.status === "success") {
        window.location.href = "login.html";
    }
});
