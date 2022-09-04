// Menu Dropdown
document
    .querySelector(".for-dropdown-translate")
    .addEventListener("click", () => {
        if (!document.getElementById("translate").classList.contains("open")) {
            document.getElementById("translate").classList.add("open");
        } else {
            document.getElementById("translate").classList.remove("open");
        }

        if (
            !document
                .getElementById("for-dropdown-translate")
                .classList.contains("active")
        ) {
            document
                .getElementById("for-dropdown-translate")
                .classList.add("active");
        } else {
            document
                .getElementById("for-dropdown-translate")
                .classList.remove("active");
        }
    });

// Modal
function openModal(modal) {
    $(modal).appendTo("body").modal("show");
}

function closeModal() {
    const body = document.getElementsByTagName("body")[0];
    document.querySelectorAll(".modal-backdrop").forEach((e) => {
        body.removeChild(e);
    });
}

// TextArea resize
const textarea = document.querySelector("#floatingBio");

function autoResize() {
    if (textarea.scrollHeight == 0) {
        textarea.style.height = "auto";
    } else textarea.style.height = `${textarea.scrollHeight}px`;
}

textarea.addEventListener("input", autoResize, false);

autoResize();

//Verificaçao de input
const usernameContent = document.getElementById("usernameContent");
const usernameInput = document.getElementById("floatingUsername");
let usernameFlag = true;

function msgAlert(pai, text, key) {
    let message = document.createElement("span");
    message.textContent = text;
    message.className = "messageAlert";
    message.id = key;
    pai.appendChild(message);
}

usernameInput.addEventListener("focus", () => {
    usernameFlag = false;
});

//Verficando submit form
const formConfig = document.getElementById("formConfig");

formConfig.addEventListener("submit", (e) => {
    e.preventDefault();

    if (usernameFlag) formConfig.submit();
});
