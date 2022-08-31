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
