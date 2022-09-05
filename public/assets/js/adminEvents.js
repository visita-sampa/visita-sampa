// crop publication midia
var $modalNewEvent = $("#modalCreateEvent");
var $modal = $(".imagecrop");
var image = document.getElementById("image");
var cropper;
$("body").on("change", ".image-upload-event", function (e) {
    var files = e.target.files;
    var done = function (url) {
        image.src = url;
        $modal.modal("show");
        $modalNewEvent.modal("hide");
    };
    var reader;
    var file;
    var url;
    if (files && files.length > 0) {
        file = files[0];
        if (URL) {
            done(URL.createObjectURL(file));
        } else if (FileReader) {
            reader = new FileReader();
            reader.onload = function (e) {
                done(reader.result);
            };
            reader.readAsDataURL(file);
        }
    }
});
$modal
    .on("shown.bs.modal", function () {
        cropper = new Cropper(image, {
            aspectRatio: 16 / 9,
            viewMode: 1,
        });
    })
    .on("hidden.bs.modal", function () {
        cropper.destroy();
        cropper = null;
    });
$("body").on("click", "#crop", function () {
    canvas = cropper.getCroppedCanvas({
        width: 460,
        height: 260,
    });
    canvas.toBlob(function (blob) {
        url = URL.createObjectURL(blob);
        var reader = new FileReader();
        reader.readAsDataURL(blob);
        reader.onloadend = function () {
            var base64data = reader.result;
            $("#base64data").val(base64data);
            document.getElementById("img-preview").style.backgroundImage =
                "url(" + base64data + ")";
            $modal.modal("hide");
            $modalNewEvent.modal("show");
        };
    });
});
$("body").on("click", ".cancel-crop", function () {
    $modal.modal("hide");
    $modalNewEvent.modal("show");
});
//Inserir foto
const inputFile = document.querySelector("#picture__input");
const inputFileAux = document.querySelector("#picture__input_aux");
const pictureImage = document.querySelector(".picture__image");
const pictureImageTxt = "Escolha uma imagem";
pictureImage.innerHTML = pictureImageTxt;

// inputFile.addEventListener("change", function (e) {
//     const inputTarget = e.target;
//     const file = inputTarget.files[0];

//     if (file) {
//         const reader = new FileReader();

//         reader.addEventListener("load", function (e) {
//             const readerTarget = e.target;

//             const img = document.createElement("img");
//             img.src = readerTarget.result;
//             img.classList.add("picture__img");

//             inputFileAux.value = readerTarget.result;

//             pictureImage.innerHTML = "";
//             pictureImage.appendChild(img);
//         });

//         reader.readAsDataURL(file);
//     } else {
//         pictureImage.innerHTML = pictureImageTxt;
//     }
// });

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

// active toasts
var toastBtnDeleteEventSuccess = document.getElementById(
    "toastBtnDeleteEventSuccess"
);
var toastDeleteEventSuccess = document.getElementById(
    "toastDeleteEventSuccess"
);
if (toastBtnDeleteEventSuccess) {
    toastBtnDeleteEventSuccess.addEventListener("click", function () {
        var toast = new bootstrap.Toast(toastDeleteEventSuccess);

        toast.show();
    });
}

var toastBtnDeleteEventFail = document.getElementById(
    "toastBtnDeleteEventFail"
);
var toastDeleteEventFail = document.getElementById("toastDeleteEventFail");
if (toastBtnDeleteEventFail) {
    toastBtnDeleteEventFail.addEventListener("click", function () {
        var toast = new bootstrap.Toast(toastDeleteEventFail);

        toast.show();
    });
}
