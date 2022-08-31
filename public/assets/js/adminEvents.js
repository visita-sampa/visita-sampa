//Inserir foto
const inputFile = document.querySelector("#picture__input");
const inputFileAux = document.querySelector("#picture__input_aux");
const pictureImage = document.querySelector(".picture__image");
const pictureImageTxt = "Escolha uma imagem";
pictureImage.innerHTML = pictureImageTxt;

inputFile.addEventListener("change", function (e) {
    const inputTarget = e.target;
    const file = inputTarget.files[0];

    if (file) {
        const reader = new FileReader();

        reader.addEventListener("load", function (e) {
            const readerTarget = e.target;

            const img = document.createElement("img");
            img.src = readerTarget.result;
            img.classList.add("picture__img");

            inputFileAux.value = readerTarget.result;

            pictureImage.innerHTML = "";
            pictureImage.appendChild(img);
        });

        reader.readAsDataURL(file);
    } else {
        pictureImage.innerHTML = pictureImageTxt;
    }
});

//Mascaras
const inputCEP = document.querySelector('[name="event_cep"]');
const inputRoad = document.querySelector('[name="event_road"]');
const inputDistrict = document.querySelector('[name="event_district"]');

inputCEP.addEventListener("focusout", (event) => {
    let cep = inputCEP.value;
    fetch(`https://viacep.com.br/ws/${cep}/json/`)
        .then((resp) => resp.json())
        .then((dadosCEP) => {
            if (dadosCEP.logradouro && dadosCEP.bairro) {
                inputRoad.value = dadosCEP.logradouro;
                inputDistrict.value = dadosCEP.bairro;
            } else {
                inputRoad.value = "CEP inválido!";
                inputDistrict.value = "CEP inválido!";
            }
        })
        .catch((error) => {
            inputRoad.value = "CEP inválido!";
            inputDistrict.value = "CEP inválido!";
        });
});

const masks = {
    cep(value) {
        return value
            .replace(/\D/g, "")
            .replace(/(\d{5})(\d)/, "$1-$2")
            .replace(/(-\d{3})\d+?$/, "$1");
    },
};

document.querySelectorAll("input").forEach(($input) => {
    const field = $input.dataset.js;

    $input.addEventListener(
        "input",
        (e) => {
            e.target.value = masks[field](e.target.value);
        },
        false
    );
});
