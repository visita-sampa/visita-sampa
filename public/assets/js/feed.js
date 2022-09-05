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
