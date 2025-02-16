document.addEventListener("DOMContentLoaded", function () {
    const loginForm = document.getElementById("loginForm");
    const signupForm = document.getElementById("signupForm");
    const passwordInput = document.getElementById("signupPassword");
    const eyeIcon = document.getElementById("eye-icon");

    eyeIcon.addEventListener("click", function () {
        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            eyeIcon.textContent = "🙈"; 
        } else {
            passwordInput.type = "password";
            eyeIcon.textContent = "👁️"; 
        }
    });

    passwordInput.addEventListener("input", function (){
        const password = this.value;
        const strengthIndicator = document.getElementById("passwordStrength");
        const strongRegex = /(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[\W_]).{8,}/;
        
        if (strongRegex.test(password)) {
            strengthIndicator.textContent = "💪Fort";
            strengthIndicator.style.color = "green";
        } else if (password.length >= 6) {
            strengthIndicator.textContent = "⚠️ Moyen";
            strengthIndicator.style.color = "orange";
        } else {
            strengthIndicator.textContent = "❌Faible";
            strengthIndicator.style.color = "red";
        }
    });

    // Connexion utilisateur
    if (loginForm) {
        loginForm.addEventListener("submit", async function (event) {
            event.preventDefault();

            let email = document.getElementById("E-mail").value;
            let password = document.getElementById("Password").value;
            let rememberMe = document.getElementById("check").checked;

            let response = await fetch("../Controllers/AuthController.php", {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                credentials: "include",
                body: JSON.stringify({
                    object: "Joueur",
                    action: "READ",
                    params: { email: email, pwdHash: password ,rememberMe: rememberMe}
                })
            });

            let result = await response.json();

            if (response.ok) {
                window.location.href = "Index.php";
            } else {
                alert(result.error);
            }
        });
    }

    // Inscription utilisateur
    if (signupForm) {
        signupForm.addEventListener("submit", async function (event) {
            event.preventDefault();

            let email = document.getElementById("signupEmail").value;
            let username = document.getElementById("signupPseudo").value;
            let password = document.getElementById("signupPassword").value;

            let response = await fetch("../Controllers/AuthController.php", {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify({
                    object: "Joueur",
                    action: "CREATE",
                    params: { username: username, pwd: password, email: email }
                })
            });

            let result = await response.json();

            if (response.ok) {
                alert("Inscription réussie ! Redirection...");
                window.location.href = "Index.php";
            } else {
                alert(result.error);
            }
        });
    }
});
