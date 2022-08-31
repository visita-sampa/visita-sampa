var tooltipTriggerList = [].slice.call(
    document.querySelectorAll('[data-bs-toggle="tooltip"]')
);
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl);
});

const btnlogin = document.querySelector("#showPassLogin");
btnlogin.addEventListener("click", () => {
    const inputlogin = document.querySelector("#passwordLogin");
    const eyelogin = document.querySelector("#eyeLogin");

    if (inputlogin.getAttribute("type") === "password") {
        inputlogin.setAttribute("type", "text");
        eyelogin.classList.add("icon-eye");
        eyelogin.classList.remove("icon-eye-off");
    } else {
        inputlogin.setAttribute("type", "password");
        eyelogin.classList.remove("icon-eye");
        eyelogin.classList.add("icon-eye-off");
    }
});

//Verificações de Input
const nameContent = document.getElementById("nameContent");
const nameInput = document.getElementById("nameSignup");
const usernameContent = document.getElementById("usernameContent");
const usernameInput = document.getElementById("usernameSignup");
const emailContent = document.getElementById("emailContent");
const emailInput = document.getElementById("emailSignup");
const passwordContent = document.getElementById("passwordContent");
const passwordInput = document.getElementById("passwordSignup");
const passwordConfirmationContent = document.getElementById(
    "passwordConfirmationContent"
);
const passwordConfirmationInput = document.getElementById(
    "passwordConfirmation"
);

let password;

let flagName = false;
let flagUsername = false;
let flagEmail = false;
let flagPassword = false;
let flagPasswordConfirmation = false;

function msgAlert(pai, text, key) {
    let message = document.createElement("span");
    message.textContent = text;
    message.className = "messageAlert";
    message.id = key;
    pai.appendChild(message);
}

nameInput.addEventListener("focusout", () => {
    let msg = document.getElementById("msgName");
    if (msg) nameContent.removeChild(msg);

    let nome = nameInput.value;
    let re = /^[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ ]+$/;

    if (nome === "") {
        msgAlert(nameContent, "Campo obrigatório", "msgName");
        flagName = false;
    } else if (!re.exec(nome)) {
        msgAlert(nameContent, "Nome inválido", "msgName");
        flagName = false;
    } else flagName = true;
});

usernameInput.addEventListener("focusout", () => {
    let msg = document.getElementById("msgUsername");
    if (msg) usernameContent.removeChild(msg);

    let nome = usernameInput.value;
    if (nome === "") {
        msgAlert(usernameContent, "Campo obrigatório", "msgUsername");
        flagUsername = false;
    } else flagUsername = true;
});

emailInput.addEventListener("focusout", () => {
    let msg = document.getElementById("msgEmail");
    if (msg) emailContent.removeChild(msg);

    let email = emailInput.value;
    let re =
        /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

    if (email === "") {
        msgAlert(emailContent, "Campo obrigatório", "msgEmail");
        flagEmail = false;
    } else if (!re.exec(email)) {
        msgAlert(emailContent, "E-mail inválido", "msgEmail");
        flagEmail = false;
    } else flagEmail = true;
});

passwordInput.addEventListener("focusout", () => {
    let msg = document.getElementById("msgPassword");
    if (msg) passwordContent.removeChild(msg);

    password = passwordInput.value;
    let re =
        /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[$*&@#])[0-9a-zA-Z$*&@#]{6,12}$/;
    if (password === "") {
        msgAlert(passwordContent, "Campo obrigatório", "msgPassword");
        flagPassword = false;
    } else if (!re.exec(password)) {
        msgAlert(passwordContent, "Senha inválida", "msgPassword");
        flagPassword = false;
    } else flagPassword = true;
});

passwordConfirmationInput.addEventListener("focusout", () => {
    let msg = document.getElementById("msgPasswordConfirmation");

    if (msg) passwordConfirmationContent.removeChild(msg);

    let confPassword = passwordConfirmationInput.value;

    if (confPassword === "") {
        msgAlert(
            passwordConfirmationContent,
            "Campo obrigatório",
            "msgPasswordConfirmation"
        );
        flagPasswordConfirmation = false;
    } else if (confPassword !== password) {
        msgAlert(
            passwordConfirmationContent,
            "Senhas não correspondem",
            "msgPasswordConfirmation"
        );
        flagPasswordConfirmation = false;
    } else flagPasswordConfirmation = true;
});

//Verficando submit
const form = document.getElementById("form");

form.addEventListener("submit", (e) => {
    e.preventDefault();

    if (
        flagName &&
        flagUsername &&
        flagEmail &&
        flagPassword &&
        flagPasswordConfirmation
    )
        form.submit();
});
