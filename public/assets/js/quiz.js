// collect elements from HTML
const btn_submit_form = document.querySelector("#finish");
const form = document.querySelector(".quiz-form");

const map_questions = {
    "question-1": "Questão 1",
    "question-2": "Questão 2",
    "question-3": "Questão 3",
    "question-4": "Questão 4",
    "question-5": "Questão 5",
    "question-6": "Questão 6",
    "question-7": "Questão 7",
    "question-8": "Questão 8",
    "question-9": "Questão 9",
    "question-10": "Questão 10",
    "question-11": "Questão 11",
    "question-12": "Questão 12",
    "question-13": "Questão 13",
    "question-14": "Questão 14",
    "question-15": "Questão 15",
};

// verification if all fields of form is not empty
btn_submit_form.addEventListener("click", (event) => {
    event.preventDefault();
    const empty = [];
    $(":radio").each(function () {
        const name = $(this).attr("name");
        // if (submit && !$(':radio[name="' + name + '"]:checked').length) {
        if (!$(`:radio[name="${name}"]:checked`).length) {
            if (empty.indexOf(name) === -1) {
                empty.push(name);
            }
        }
    });

    if (empty.length) {
        let mensagem = "As questões: ";
        empty.map((element) => {
            mensagem += `${map_questions[element]}  `;
            return;
        });
        // console.log(mensagem + "estão incompletas, favor preencher");
    } else {
        form.submit();
    }
});

// QUIZ PAGINATION
// hide all questions
const questions = document.querySelectorAll(".question-container");

function hideQuestions() {
    for (let i = 0; i < questions.length; i++) {
        const element = questions[i];
        element.classList.add("question-disabled");
    }
}

// disable index button
const quiz_buttons = document.querySelectorAll(".quiz-button");

function disabledQuizButton() {
    for (let i = 0; i < quiz_buttons.length; i++) {
        const element = quiz_buttons[i];
        element.classList.remove("quiz-button-active");
    }
}

let last_question = 1;

function markAnswered(index) {
    const alternative = document.getElementsByName(`question-${index}`);
    const btn_question = document.getElementById(`btn-question-${index}`);
    let check = false;

    for (let i = 0; i < alternative.length; i++) {
        if (alternative[i].checked) {
            check = true;
        }
    }

    if (check) {
        btn_question.classList.add("check");
    } else {
        btn_question.classList.remove("check");
    }
}

// show selected question and updated index
function switchQuestion(index) {
    const question = document.getElementById(`question-${index}`);
    const btn_question = document.getElementById(`btn-question-${index}`);

    hideQuestions();
    disabledQuizButton();

    markAnswered(last_question);

    last_question = index;

    question.classList.remove("question-disabled");
    btn_question.classList.add("quiz-button-active");
}

hideQuestions();
disabledQuizButton();
switchQuestion(1);
