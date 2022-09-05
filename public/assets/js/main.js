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

function overlapModal(id_publicacao) {
	var id = document.getElementById(`post-modal-${id_publicacao}`);
	var id2 = document.getElementById(`report-post-modal-${id_publicacao}`);
	var id3 = document.getElementById(`report-post-modal-two-${id_publicacao}`);

	document
		.querySelector("body")
		.addEventListener("keydown", function (event) {
			var tecla = event.keyCode;

			if (
				tecla == 27 &&
				!id2.classList.contains("show") &&
				!id3.classList.contains("show")
			) {
				id.style.zIndex = 1055;
			}
		});
	id2.addEventListener("focus", (id.style.zIndex = 1050));
	id2.addEventListener("blur", (id.style.zIndex = 1055));
	id3.addEventListener("focus", (id2.style.zIndex = 1050));
	id3.addEventListener("blur", (id2.style.zIndex = 1055));
}

function overlapModalClose(id_publicacao) {
	var id = document.getElementById(`post-modal-${id_publicacao}`);
	var id2 = document.getElementById(`report-post-modal-${id_publicacao}`);
	id.style.zIndex = 1055;
}

// TextArea resize
const textarea = document.querySelector("#floatingBio");

function autoResize() {
	if (textarea.scrollHeight == 0) {
		textarea.style.height = "auto";
	} else textarea.style.height = `${textarea.scrollHeight}px`;
}

if (textarea) {
	textarea.addEventListener("input", autoResize, false);
	autoResize();
}

//Verificaçao de input
const usernameContentFloating = document.getElementById("usernameContent");
const usernameInputFloating = document.getElementById("floatingUsername");
const nameContentFloating = document.getElementById("nameContent");
const nameInputFloating = document.getElementById("floatingName");
const usernameContentConfig = document.getElementById(
	"usernameContentFloating"
);
let usernameFlag = true;

function msgAlert(pai, text, key) {
	let message = document.createElement("span");
	message.textContent = text;
	message.className = "messageAlert";
	message.id = key;
	pai.appendChild(message);
}

if (nameInputFloating) {
	nameInputFloating.addEventListener("focusout", () => {
		let msg = document.getElementById("msgName");
		if (msg) nameContentFloating.removeChild(msg);

		let nome = nameInputFloating.value;
		let re = /^[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ ]+$/;

		if (nome === "") {
			msgAlert(nameContentFloating, "Campo obrigatório", "msgName");
			flagName = false;
		} else if (!re.exec(nome)) {
			msgAlert(nameContentFloating, "Nome inválido", "msgName");
			flagName = false;
		} else flagName = true;
	});
}

function usernameEmpty() {
	let msg = document.getElementById("msgUsername");
	if (msg) usernameContentFloating.removeChild(msg);

	let nome = usernameInputFloating.value;
	if (nome === "") {
		msgAlert(usernameContentFloating, "Campo obrigatório", "msgUsername");
		usernameFlag = false;
	} else usernameFlag = true;
}

if (usernameInputFloating) {
	usernameInputFloating.addEventListener("focus", () => {
		usernameFlag = false;
	});
}

//Verficando submit form
const formConfig = document.getElementById("formConfig");

if (formConfig) {
	formConfig.addEventListener("submit", (e) => {
		e.preventDefault();

		if (usernameFlag) formConfig.submit();
	});
}
