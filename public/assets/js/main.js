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
const textarea = document.querySelector("#floating-bio");

function autoResize() {
    if (textarea.scrollHeight == 0) {
        textarea.style.height = "auto";
    } else textarea.style.height = `${textarea.scrollHeight}px`;
}

textarea.addEventListener("input", autoResize, false);

autoResize();
