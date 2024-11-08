document.addEventListener("DOMContentLoaded", function () {
    const rescues = [
        {
            name: "DORSET RESCUE KITTENS",
            location: "Kitchener",
            email: "dorsetrescuekittens@hotmail.com",
            imageUrl: "images/other logo/dorset.jpeg",
            link: "https://www.dorsetrescuekittens.ca/kitten-application"
        },
        {
            name: "GRAND RIVER ANIMAL RESCUE",
            location: "Kitchener",
            email: "grandriverrescue@hotmail.com",
            imageUrl: "images/other logo/grand.jpeg",
            link: "https://www.grandriverallbreedrescue.ca/"
        },
        {
            name: "HOBO HEAVEN RESCUE",
            location: "Cambridge",
            email: "hoboheavenrescue.ca",
            imageUrl: "images/other logo/hobo.jpeg",
            link: "https://hobohavenrescue.ca/current-dogs"
        },
        {
            name: "TORONTO CAT RESCUE",
            location: "Waterloo",
            email: "info@torontocatrescue.ca",
            imageUrl: "images/other logo/TCR.png",
            link: "https://www.torontocatrescue.ca/adopt-a-cat"
        },
        {
            name: "GOLDEN RESCUE",
            location: "Cambridge",
            email: "info@torontocatrescue.ca",
            imageUrl: "images/other logo/golden.png",
            link: "https://www.goldenrescue.ca/our-goldens/adopt-3/"
        },
        {
            name: "BOOSTEN RESCUE",
            location: "Waterloo",
            email: "1-833-287-2364",
            imageUrl: "images/other logo/boostan.jpeg",
            link: "https://bostonterrierrescuecanada.com/adoptable-dogs/"
        },
        {
            name: "DOG TALES",
            location: "Kitchener",
            email: "info@dogtales.ca",
            imageUrl: "images/other logo/dogtales.jpg",
            link: "https://www.dogtales.ca/"
        },
        {
            name: "FULL CIRCLE RESCUE",
            location: "Kitchener",
            email: "473-657-8999",
            imageUrl: "images/other logo/polish.png",
            link: "https://fullcirclerescue.ca/so-you-want-to-adopt/"
        }
    ];

    // Function to filter rescues and display results
    function searchRescues() {
        const locationInput = document.querySelector(".search-input[placeholder='Location']").value;
        const rescueNameInput = document.querySelector(".search-input[placeholder='Rescue Name']").value.toLowerCase();

        console.log("Location selected:", locationInput);  // Debugging log
        console.log("Rescue name entered:", rescueNameInput);  // Debugging log

        const filteredRescues = rescues.filter(rescue => {
            const matchesLocation = locationInput === "" || rescue.location === locationInput;
            const matchesRescueName = rescueNameInput === "" || rescue.name.toLowerCase().includes(rescueNameInput);
            return matchesLocation && matchesRescueName;
        });

        console.log("Filtered rescues:", filteredRescues);  // Debugging log

        displayRescues(filteredRescues);
    }

    // Function to display rescues
    function displayRescues(rescuesToShow) {
        const cardsWrapper = document.querySelector(".cards-wrapper");
        cardsWrapper.innerHTML = "";

        rescuesToShow.forEach(rescue => {
            const rescueCard = document.createElement("div");
            rescueCard.classList.add("rescue-card");

            rescueCard.innerHTML = `
                <div class="weblogo">
                    <img src="${rescue.imageUrl}" alt="${rescue.name}">
                </div>
                <div class="rescue-details">
                    <h3>${rescue.name}</h3>
                    <p><span class="icon"><i class="fas fa-home"></i></span>${rescue.location}</p>
                    <p><span class="icon"><i class="fas fa-envelope"></i></span>${rescue.email}</p>
                </div>
                <a href="${rescue.link}" target="_blank" class="view-pet">View Pet</a>
            `;

            cardsWrapper.appendChild(rescueCard);
        });
    }

    // Event listener for the Search button
    document.querySelector(".search-button").addEventListener("click", searchRescues);
});
