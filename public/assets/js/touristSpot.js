// crop publication midia
var $modalNewPost = $("#new-post-modal");
var $modalPost = $(".imagecrop");
var imagePost = document.getElementById("imagePost");
var cropperPost;
$("body").on("change", ".image-upload", function (e) {
    var files = e.target.files;
    var done = function (url) {
        imagePost.src = url;
        $modalPost.modal("show");
        $modalNewPost.modal("hide");
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
$modalPost
    .on("shown.bs.modal", function () {
        cropperPost = new Cropper(image, {
            aspectRatio: 7 / 5,
            viewMode: 1,
        });
    })
    .on("hidden.bs.modal", function () {
        cropperPost.destroy();
        cropperPost = null;
    });
$("body").on("click", "#cropPost", function () {
    canvasPost = cropperPost.getCroppedCanvas({
        width: 605,
        height: 450,
    });
    canvasPost.toBlob(function (blob) {
        url = URL.createObjectURL(blob);
        var reader = new FileReader();
        reader.readAsDataURL(blob);
        reader.onloadend = function () {
            var base64data = reader.result;
            $("#base64imagePost").val(base64data);
            document.getElementById("img-preview-post").style.backgroundImage =
                "url(" + base64data + ")";
            $modalPost.modal("hide");
            $modalNewPost.modal("show");
        };
    });
});
$("body").on("click", ".cancel-post", function () {
    $modalPost.modal("hide");
    $modalNewPost.modal("show");
});

// active toasts
var btnReportSuccess = document.getElementById("toastBtnReportSuccess");
var toastReportSuccess = document.getElementById("toastReportSuccess");
if (btnReportSuccess) {
    btnReportSuccess.addEventListener("click", function () {
        var toast = new bootstrap.Toast(toastReportSuccess);

        toast.show();
    });
}

var btnReportFail = document.getElementById("toastBtnReportFail");
var toastReportFail = document.getElementById("toastReportFail");
if (btnReportFail) {
    btnReportFail.addEventListener("click", function () {
        var toast = new bootstrap.Toast(toastReportFail);

        toast.show();
    });
}
