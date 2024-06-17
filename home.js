document.addEventListener('DOMContentLoaded', function () {
    const dropdowns = document.querySelectorAll('.navbar .dropdown');
    dropdowns.forEach(dropdown => {
        dropdown.addEventListener('click', function (event) {
            event.preventDefault();
            this.classList.toggle('active');
        });
    });
});

// Full-screen video control
document.addEventListener('DOMContentLoaded', function () {
    const video = document.querySelector('#full-screen-video video');
    if (video) {
        video.play(); // Autoplay video
        video.addEventListener('click', function () {
            if (video.paused) {
                video.play();
            } else {
                video.pause();
            }
        });
    }
});

// Count-up animation for progress numbers
document.addEventListener('DOMContentLoaded', function () {
    const countBoxes = document.querySelectorAll('.count-box');
    countBoxes.forEach(box => {
        const targetCount = parseInt(box.textContent);
        let currentCount = 0;
        const updateCount = () => {
            currentCount++;
            box.textContent = currentCount;
            if (currentCount < targetCount) {
                setTimeout(updateCount, 100); // Adjust animation speed as needed
            }
        };
        updateCount();
    });
});

// Auto scrolling functionconst rootStyle = document.querySelector(":root");

// function handleWindowResize() {
//     const scrollSectionWidth = document.querySelector(".scroll-section").clientWidth;
//     rootStyle.style.setProperty("--scroll-section-width", `${scrollSectionWidth}px`);
// }

// handleWindowResize();
// window.addEventListener("resize", handleWindowResize);


// navbar of home page
document.addEventListener("DOMContentLoaded", function() {
    // Get all dropdown toggles
    const dropdownToggles = document.querySelectorAll(".navbar ul li");

    // Loop through each dropdown toggle
    dropdownToggles.forEach(function(toggle) {
        // Add click event listener to toggle dropdown
        toggle.addEventListener("click", function(event) {
            event.stopPropagation(); // Prevent event bubbling

            // Toggle the class 'active' to show/hide dropdown
            this.classList.toggle("active");

            // Get the dropdown menu associated with this toggle
            const dropdownMenu = this.querySelector(".dropdown");

            // Toggle the class 'show' to show/hide the dropdown menu
            dropdownMenu.classList.toggle("show");
        });
    });

    // Close dropdown menus when clicking outside or on the video overlay
    window.addEventListener("click", function(event) {
        const dropdownMenus = document.querySelectorAll(".dropdown");

        dropdownMenus.forEach(function(menu) {
            if (menu.classList.contains("show") && !menu.contains(event.target)) {
                menu.classList.remove("show");
                menu.parentElement.classList.remove("active");
            }
        });
    });

    // Prevent dropdown menu from closing when clicking inside it
    const dropdownMenuItems = document.querySelectorAll(".dropdown li a");

    dropdownMenuItems.forEach(function(item) {
        item.addEventListener("click", function(event) {
            event.stopPropagation(); // Prevent event bubbling
        });
    });
});

// commitee members

let backbtn=document.getElementById("backbtn");
let nextbtn=document.getElementById("nextbtn");
(document.querySelector(".gallery")).addEventListener("wheel",(evt)=>{
    evt.preventDefault();
    (document.querySelector(".gallery")).scrollLeft+=evt.deltaY;
    (document.querySelector(".gallery")).style.scrollBehavior="auto";

});
nextbtn.addEventListener("click",()=>{
    (document.querySelector(".gallery")).style.scrollBehavior="smooth";
    (document.querySelector(".gallery")).scrollLeft+=900;
});
backbtn.addEventListener("click",()=>{
    (document.querySelector(".gallery")).style.scrollBehavior="smooth";
    (document.querySelector(".gallery")).scrollLeft-=900;
});


// card logic

// const scrollContainer = document.getElementById('scrollContainer');

// function createCard(cardName, imageUrl) {
//     const card = document.createElement('div');
//     card.className = 'card';
//     card.onclick = function () {
//         cardClicked(cardName);
//     };
//     card.innerHTML = `<img src="${imageUrl}" alt="${cardName}">`;
//     return card;
// }

// function addNewCard() {
//     const newCardNumber = document.querySelectorAll('.card').length + 1;
//     const newCard = createCard(`Card ${newCardNumber}`, `image${newCardNumber}.jpg`);
//     (document.querySelector(".gallery")).appendChild(newCard);
// }

// function cardClicked(cardName) {
//     alert('Clicked ' + cardName);
//     // Add your click event handling code here
// }

// setInterval(addNewCard, 2000); 