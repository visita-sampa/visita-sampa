//Verificações de Input
const nameSignup = document.getElementById("nameSignup");
const nameSignupContent = document.getElementById("nameSignupContent");
const usernameSignup = document.getElementById("usernameSignup");
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

console.log(nameSignup);

let flagName = false;
let flagUsername = true;
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

nameSignup.addEventListener("focusout", () => {
    let msg = document.getElementById("msgName");
    if (msg) nameSignupContent.removeChild(msg);

    let nome = nameSignup.value;
    let re = /^[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ ]+$/;

    if (nome === "") {
        msgAlert(nameSignupContent, "Campo obrigatório", "msgName");
        flagName = false;
    } else if (!re.exec(nome)) {
        msgAlert(nameSignupContent, "Nome inválido", "msgName");
        flagName = false;
    } else flagName = true;
});

// usernameSignup.addEventListener("focusout", () => {
// 	var value = usernameSignup.value;

// 	let msg = document.getElementById("msgUsername");
// 	if (msg) usernameContent.removeChild(msg);
// 	if (value === "") {
// 		msgAlert(usernameContent, "Campo obrigatório", "msgUsername");
// 		flagUsername = false;
// 		return;
// 	}
// 	$.ajax({
// 		url: "{{ route('username.availability', app()->getLocale()) }}",
// 		type: 'GET',
// 		data: {
// 			'floatingUsername': value
// 		},
// 		beforeSend: () => {
// 			let msg = document.getElementById("msgUsername");
// 			if (msg)
// 				usernameContent.removeChild(msg);;
// 			$("#loading").css('display', 'block');
// 			flagUsername = false;
// 		},
// 		complete: () => {
// 			$("#loading").css('display', 'none');
// 		}
// 	})
// 		.done((response) => {
// 			if (response) {
// 				$('.btn-signup').removeClass("disabled");

// 				let msg = document.getElementById("msgUsername");
// 				flagUsername = true;
// 				if (msg)
// 					usernameContent.removeChild(msg);
// 			} else {
// 				msgAlert(usernameContent, 'Nome já utilizado', 'msgUsername');
// 				flagUsername = false;
// 			}
// 		})
// });

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
        flagPasswordConfirmation &&
        usernameFlag &&
        emailFlag
    )
        form.submit();
});
