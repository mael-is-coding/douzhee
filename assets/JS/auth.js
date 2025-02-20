import AuthManager  from "./AuthManager";
const auth = AuthManager.getInstance();

document.addEventListener("DOMContentLoaded", function () {
    const loginForm = document.getElementById("loginForm");
    const signupForm = document.getElementById("signupForm");
    const passwordInput = document.getElementById("signupPassword");
    const eyeIcon = document.getElementById("eye-icon");
    const emailErrorText = document.getElementById("emailErrorText");
    const passwordErrorText = document.getElementById("passwordErrorText");

    if (eyeIcon){
        eyeIcon.addEventListener("click", function () {
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                eyeIcon.textContent = "🙈"; 
            } else {
                passwordInput.type = "password";
                eyeIcon.textContent = "👁️"; 
            }
        });
    
    }


    // Connexion utilisateur
    if (loginForm) {
        loginForm.addEventListener("submit", async function (event) {
            event.preventDefault();

            let email = document.getElementById("E-mail").value;
            let password = document.getElementById("Password").value;

            let emailMess = "Email invalide";
            let passMess  = "Mot de passe invalide";
            
            try {
                if (!TestRegex(email, /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/)) {
                    throw new Error(emailMess);
                } else {
                    emailErrorText.textContent = "";
                }
                
                if (!TestRegex(password, /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[\W_]).{8,}$/)) {
                    throw new Error(passMess);
                } else {
                    passwordErrorText.textContent = "";
                }

            } catch (error) {
                if (error.message == emailMess) {
                    emailErrorText.textContent = emailMess;
                } else {
                    passwordErrorText.textContent = passMess;
                }

                return; // termine le script pour éviter toute autre exécution (équivalent à PHP exit())
            }

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


/**
 * @param {string} stringToTest 
 * @param {regex} regex 
 */
function TestRegex(stringToTest, regex) {
    return regex.test(stringToTest)
}