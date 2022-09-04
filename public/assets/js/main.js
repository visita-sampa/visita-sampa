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
const nameContent = document.getElementById("nameContent");
const nameInput = document.getElementById("floatingName");

let usernameFlag = true;

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

function usernameEmpty() {
	let msg = document.getElementById("msgUsername");
	if (msg) usernameContent.removeChild(msg);

	let nome = usernameInput.value;
	if (nome === "") {
		msgAlert(usernameContent, "Campo obrigatório", "msgUsername");
		usernameFlag = false;
	} else usernameFlag = true;
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
