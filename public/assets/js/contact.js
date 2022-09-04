//Verificando Inputs

const nameContent = document.getElementById("nameContent");
const nameInput = document.getElementById("name");
const emailContent = document.getElementById("emailContent");
const emailInput = document.getElementById("email");
const subjectContent = document.getElementById("subjectContent");
const subjectInput = document.getElementById("subject");
const commentsContent = document.getElementById("commentsContent");
const commentsInput = document.getElementById("comments");

let flagName = false;
let flagEmail = false;
let flagSubject = false;
let flagComments = false;

function msgAlert(pai, text, key) {
  let message = document.createElement('span');
  message.textContent = text;
  message.className = 'messageAlert';
  message.id = key;
  pai.appendChild(message);
}

nameInput.addEventListener("focusout", () => {
  let msg = document.getElementById('msgName');
  if (msg)
    nameContent.removeChild(msg);

  let nome = nameInput.value;
  let re = /^[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ ]+$/;

  if (nome === '') {
    msgAlert(nameContent, "Campo obrigatório", "msgName");
    flagName = false;
  }
  else if (!re.exec(nome)) {
    msgAlert(nameContent, "Nome inválido", "msgName");
    flagName = false;
  }
  else
    flagName = true;
})

emailInput.addEventListener('focusout', () => {
  let msg = document.getElementById('msgEmail');
  if (msg)
    emailContent.removeChild(msg);

  let email = emailInput.value;
  let re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

  if (email === '') {
    msgAlert(emailContent, "Campo obrigatório", "msgEmail");
    flagEmail = false;
  }
  else if (!re.exec(email)) {
    msgAlert(emailContent, "E-mail inválido", "msgEmail");
    flagEmail = false;
  }
  else
    flagEmail = true;
})

subjectInput.addEventListener('focusout', () => {
  let msg = document.getElementById('msgSubject');
  if (msg)
    subjectContent.removeChild(msg);

  let nome = subjectInput.value;
  if (nome === '') {
    msgAlert(subjectContent, "Campo obrigatório", "msgSubject");
    flagSubject = false;
  }
  else
    flagSubject = true;
})

commentsInput.addEventListener('focusout', () => {
  let msg = document.getElementById('msgComments');
  if (msg)
    commentsContent.removeChild(msg);

  let nome = commentsInput.value;
  if (nome === '') {
    msgAlert(commentsContent, "Campo obrigatório", "msgComments");
    flagComments = false;
  }
  else
    flagComments = true;
})


//Verificando submit

const form =  document.getElementById('form');

form.addEventListener('submit', (e) => {
  e.preventDefault();

  if(flagName && flagEmail && flagSubject && flagComments)
    form.submit();
})