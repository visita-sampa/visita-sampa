var tooltipTriggerList = [].slice.call(
    document.querySelectorAll('[data-bs-toggle="tooltip"]')
);
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl);
});

function login(tipo) {
    if (tipo == 1) {
        document.getElementById("login").classList.add("d-none");
        document.getElementById("signup").classList.remove("d-none");
    } else {
        document.getElementById("login").classList.remove("d-none");
        document.getElementById("signup").classList.add("d-none");
    }
}

let btn = document.querySelector("#showPass");
btn.addEventListener("click", function () {
    let input = document.querySelector("#passwordSignup");
    let eye = document.querySelector("#eye");

    if (input.getAttribute("type") == "password") {
        input.setAttribute("type", "text");
        eye.classList.add("icon-eye");
        eye.classList.remove("icon-eye-off");
    } else {
        input.setAttribute("type", "password");
        eye.classList.remove("icon-eye");
        eye.classList.add("icon-eye-off");
    }
});
