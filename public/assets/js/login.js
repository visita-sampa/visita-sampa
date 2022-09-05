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
