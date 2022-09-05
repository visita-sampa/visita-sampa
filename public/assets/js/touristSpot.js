// crop publication midia
// edit profile
// crop profile pic
var $newPostModal = $("#new-post-modal");
var $modal = $(".imagecrop");
var image = document.getElementById("image");
var cropper;
$("body").on("change", ".image-upload", function (e) {
    var files = e.target.files;
    var done = function (url) {
        image.src = url;
        $modal.modal("show");
        $newPostModal.modal("hide");
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
            aspectRatio: 7 / 5,
            viewMode: 1,
        });
    })
    .on("hidden.bs.modal", function () {
        cropper.destroy();
        cropper = null;
    });
$("body").on("click", "#crop", function () {
    canvas = cropper.getCroppedCanvas({
        width: 605,
        height: 450,
    });
    canvas.toBlob(function (blob) {
        url = URL.createObjectURL(blob);
        var reader = new FileReader();
        reader.readAsDataURL(blob);
        reader.onloadend = function () {
            var base64data = reader.result;
            $("#base64imagePost").val(base64data);
            document.getElementById("img-preview").style.backgroundImage =
                "url(" + base64data + ")";
            $modal.modal("hide");
            $newPostModal.modal("show");
        };
    });
});
$("body").on("click", ".cancel-crop", function () {
    $newPostModal.modal("show");
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
