document.addEventListener("DOMContentLoaded", function() {
    const searchInput = document.querySelector(".search-bar input");
    const searchButton = document.querySelector(".search-bar button");
    const locationSelect = document.getElementById("locations");
    const hotelInfos = document.querySelectorAll(".hotel-info");

    function filterHotels() {
        const searchText = searchInput.value.toLowerCase();
        const selectedLocation = locationSelect.value;

        hotelInfos.forEach(hotelInfo => {
            const hotelName = hotelInfo.querySelector("h3").textContent.toLowerCase();
            const hotelArea = hotelInfo.querySelector("p").textContent.toLowerCase();

            const matchesSearchText = hotelName.includes(searchText);
            const matchesLocation = selectedLocation === "select a location" || hotelArea.includes(selectedLocation);

            if (matchesSearchText && matchesLocation) {
                hotelInfo.style.display = "";
            } else {
                hotelInfo.style.display = "none";
            }
        });
    }

    searchButton.addEventListener("click", filterHotels);
    searchInput.addEventListener("input", filterHotels);
    locationSelect.addEventListener("change", filterHotels);
});