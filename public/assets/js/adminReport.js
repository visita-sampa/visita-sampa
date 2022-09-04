// abrir denúncia
let cardDescription = document.getElementById("card-description");
let card = document.getElementById("card");
const btnReadMore = document.getElementById("btn-see-more");
let cardOpen = true;

function readMore() {
    if (!cardOpen) {
        btnReadMore.innerHTML =
            "Ver Mais <i class='icon-chevron-down p-1'></i>";
        cardDescription.classList.remove("card-open");
        card.style.marginBottom = "1rem";
        cardOpen = true;
    } else {
        cardDescription.classList.add("card-open");
        btnReadMore.innerHTML = "Ver Menos <i class='icon-chevron-up p-1'></i>";
        cardOpen = false;
    }
}
btnReadMore.addEventListener("click", readMore);

// Mudar cor e quantidade de denúncias
let badgeReportArray = document.querySelectorAll(".badge-report");

badgeReportArray.forEach((badgeReport) => {
    let numberOfReport = badgeReport.innerText;

    if (numberOfReport == "1") {
        badgeReport.style.backgroundColor = "#dffdee";
        badgeReport.style.color = "#548f74";
        badgeReport.innerHTML = numberOfReport + " " + "Denúncia";
    } else if (
        numberOfReport == "2" ||
        numberOfReport == "3" ||
        numberOfReport == "4" ||
        numberOfReport == "5" ||
        numberOfReport == "6" ||
        numberOfReport == "7" ||
        numberOfReport == "8" ||
        numberOfReport == "9" ||
        numberOfReport == "10"
    ) {
        badgeReport.style.backgroundColor = "#dffdee";
        badgeReport.style.color = "#548f74";
        badgeReport.innerHTML = numberOfReport + " " + "Denúncias";
    } else if (
        numberOfReport == "11" ||
        numberOfReport == "12" ||
        numberOfReport == "13" ||
        numberOfReport == "14" ||
        numberOfReport == "15" ||
        numberOfReport == "16" ||
        numberOfReport == "17" ||
        numberOfReport == "18" ||
        numberOfReport == "19" ||
        numberOfReport == "20"
    ) {
        badgeReport.style.backgroundColor = "#faedcf";
        badgeReport.style.color = "#b79d74";
        badgeReport.innerHTML = numberOfReport + " " + "Denúncias";
    } else {
        badgeReport.style.backgroundColor = "#f7d1c7";
        badgeReport.style.color = "#883d3b";
        badgeReport.innerHTML = numberOfReport + " " + "Denúncias";
    }
});
