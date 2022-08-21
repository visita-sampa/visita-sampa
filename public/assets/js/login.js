var tooltipTriggerList = [].slice.call(
    document.querySelectorAll('[data-bs-toggle="tooltip"]')
);
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl);
});

function login(tipo) {
    if (tipo === 1) {
        document.getElementById("logon").classList.add("d-none");
        document.getElementById("signup").classList.remove("d-none");
    } else {
        document.getElementById("logon").classList.remove("d-none");
        document.getElementById("signup").classList.add("d-none");
    }
}

const btn = document.querySelector("#showPass");
btn.addEventListener("click", () => {
    const input = document.querySelector("#passwordSignup");
    const eye = document.querySelector("#eye");

    if (input.getAttribute("type") === "password") {
        input.setAttribute("type", "text");
        eye.classList.add("icon-eye");
        eye.classList.remove("icon-eye-off");
    } else {
        input.setAttribute("type", "password");
        eye.classList.remove("icon-eye");
        eye.classList.add("icon-eye-off");
    }
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
