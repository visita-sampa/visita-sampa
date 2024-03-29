// select type search
touristSpot = document.getElementById("tourist-spot-search-tab");
profile = document.getElementById("profile-search-tab");

touristSpot.addEventListener("click", () => {
    // document.getElementById("touristSpotRadio").checked = true;
    document.getElementById("typeSearch").value = 1;
});

profile.addEventListener("click", () => {
    // document.getElementById("profileRadio").checked = true;
    document.getElementById("typeSearch").value = 2;
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
