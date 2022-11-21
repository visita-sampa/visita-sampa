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
function overlapModal(id_publicacao) {
	var id = document.getElementById(`post-modal-${id_publicacao}`);
	var id2 = document.getElementById(`editModal-${id_publicacao}`);

	document
		.querySelector("body")
		.addEventListener("keydown", function (event) {
			var tecla = event.keyCode;

			if (tecla == 27 && !id2.classList.contains("show")) {
				id.style.zIndex = 1055;
			}
		});
	id2.addEventListener("focus", function () {
		id.style.zIndex = 1050;
	});
	id2.addEventListener("blur", overlapModalClose(id_publicacao, 1));
}

function overlapModalClose(id_publicacao, type) {
	var id = document.getElementById(`post-modal-${id_publicacao}`);
	var id2 = document.getElementById(`editModal-${id_publicacao}`);
	if (type == 1) {
		id.style.zIndex = 1055;
	} else {
		id.style.zIndex = 1050;
	}
}
