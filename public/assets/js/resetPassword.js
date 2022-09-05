const passwordContent = document.getElementById('passwordContent');
const passwordInput = document.getElementById('passwordLogin');

let flagPassword = false;

passwordInput.addEventListener("focusout", () => {
	let msg = document.getElementById("msgPassword");
	if (msg) passwordContent.removeChild(msg);

	let password = passwordInput.value;
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