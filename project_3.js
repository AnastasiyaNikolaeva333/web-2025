document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("loginForm");
    const emailInput = document.getElementById("email-input");
    const passwordInput = document.getElementById("password-input");
    const errorMessage = document.getElementById("error-message");

    form.addEventListener("submit", function (e) {
        e.preventDefault();
        emailInput.classList.remove("error");
        passwordInput.classList.remove("error");
        errorMessage.classList.add("hidden");

        let isValid = true;

        const emailValue = emailInput.value.trim();
        if (!isValidEmail(emailValue)) {
            emailInput.classList.add("error");
            isValid = false;
        }

        const passwordValue = passwordInput.value.trim();
        if (!isValidPassword(passwordValue)) {
            passwordInput.classList.add("error");
            isValid = false;
        }

        if (!isValid) {
            errorMessage.classList.remove("hidden"); 
            console.log("Форма не прошла валидацию");
        } else {
            console.log("Форма прошла валидацию");
        }
    });

    function isValidEmail(email) {
        const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; 
        return re.test(email);
    }

    function isValidPassword(password) {
        return password.length >= 6;
    }
});