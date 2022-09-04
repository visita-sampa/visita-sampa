// edit profile
// crop profile pic
var $modalConfiguration = $("#modalConfiguration");
var $modal = $(".imagecrop");
var image = document.getElementById("image");
var cropper;
$("body").on("change", ".image-upload", function (e) {
    var files = e.target.files;
    var done = function (url) {
        image.src = url;
        $modal.modal("show");
        $modalConfiguration.modal("hide");
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
            aspectRatio: 1,
            viewMode: 1,
        });
    })
    .on("hidden.bs.modal", function () {
        cropper.destroy();
        cropper = null;
    });
$("body").on("click", "#crop", function () {
    canvas = cropper.getCroppedCanvas({
        width: 200,
        height: 200,
    });
    canvas.toBlob(function (blob) {
        url = URL.createObjectURL(blob);
        var reader = new FileReader();
        reader.readAsDataURL(blob);
        reader.onloadend = function () {
            var base64data = reader.result;
            $("#base64image").val(base64data);
            document.getElementById("image-preview").style.backgroundImage =
                "url(" + base64data + ")";
            $modal.modal("hide");
            $modalConfiguration.modal("show");
        };
    });
});
$("body").on("click", "#cancelCrop", function () {
    $modalConfiguration.modal("show");
});

// load publications
function loadMoreData(page) {
    $.ajax({
        url: "?page=" + page,
        type: "get",
        beforeSend: function () {
            $(".ajax-load").show();
        },
    })
        .done(function (userPublication) {
            if (userPublication.html == "") {
                $(".ajax-load").html("Nenhuma outra publicação encontrada");
                return;
            }
            $(".ajax-load").hide();
            $("#post-container").append(userPublication.html);
        })
        .fail(function (jqXHR, ajaxOptions, thrownError) {
            alert("Servidor não está respondendo...");
        });
}

var page = 1;
$(window).scroll(function () {
    if ($(window).scrollTop() + $(window).height() >= $(document).height()) {
        page++;
        loadMoreData(page);
    }
});

// active toasts
var toastTrigger = document.getElementById("liveToastBtn");
var toastLiveExample = document.getElementById("liveToast");
if (toastTrigger) {
    toastTrigger.addEventListener("click", function () {
        var toast = new bootstrap.Toast(toastLiveExample);

        toast.show();
    });
}

var btnDeletePostSuccess = document.getElementById("toastBtnDeletePostSuccess");
var toastDeletePostSuccess = document.getElementById("toastDeletePostSuccess");
if (btnDeletePostSuccess) {
    btnDeletePostSuccess.addEventListener("click", function () {
        var toast = new bootstrap.Toast(toastDeletePostSuccess);

        toast.show();
    });
}

var btnDeletePostFail = document.getElementById("toastBtnDeletePostFail");
var toastDeletePostFail = document.getElementById("toastDeletePostFail");
if (btnDeletePostFail) {
    btnDeletePostFail.addEventListener("click", function () {
        var toast = new bootstrap.Toast(toastDeletePostFail);

        toast.show();
    });
}
