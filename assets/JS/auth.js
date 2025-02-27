import AuthManager  from "./AuthManager";
const auth = AuthManager.getInstance();

document.addEventListener("DOMContentLoaded", function () {
    const loginForm = document.getElementById("loginForm");
    const signupForm = document.getElementById("signupForm");
    const passwordInput = document.getElementById("signupPassword");
    const eyeIcon = document.getElementById("eye-icon");
    if (eyeIcon){
        eyeIcon.addEventListener("click", function () {
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                eyeIcon.classList.remove("fa-eye-slash");
                eyeIcon.classList.add("fa-eye");
            } else {
                passwordInput.type = "password";
                eyeIcon.classList.remove("fa-eye");
                eyeIcon.classList.add("fa-eye-slash");
            }
        });
    
    }


    // Connexion utilisateur
    if (loginForm) {
        loginForm.addEventListener("submit", async function (event) {
            event.preventDefault();

            let email = document.getElementById("E-mail").value;
            let password = document.getElementById("Password").value;
            let rememberMe = document.getElementById("check").checked;
            auth.ConnectExistingUser(email, password, rememberMe);
            });

    }

    // Inscription utilisateur
    if (signupForm) {
        signupForm.addEventListener("submit", async function (event) {
            event.preventDefault();

            let email = document.getElementById("signupEmail").value;
            let username = document.getElementById("signupPseudo").value;
            let password = document.getElementById("signupPassword").value;

            auth.SignUpNewUser(username,password,email);
        });
    }
});
