let menu = document.querySelector('#menu-btn');
let navbar = document.querySelector('.header .navbar');

menu.onclick = () =>{
    menu.classList.toggle('fa-times');
    navbar.classList.toggle('active');
}

window.onscroll = () =>{
    menu.classList.remove('fa-times');
    navbar.classList.remove('active');
}

var swiper = new Swiper(".home-slider",{
    loop:true,
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    }
});


// Function to filter and display pets based on the selected category
function filterPets(category) {
    const allPets = document.querySelectorAll('.box');

    // Hide all pets initially
    allPets.forEach(pet => {
        pet.style.display = 'none';
    });

    // Show only the pets with the selected category
    const selectedPets = document.querySelectorAll(`.box[data-category="${category}"]`);
    selectedPets.forEach(pet => {
        pet.style.display = 'block';
    });
}

// Get the selected category from the query parameter (e.g., "?category=cats")
const urlParams = new URLSearchParams(window.location.search);
const selectedCategory = urlParams.get('category');

// If a category is selected, filter the pets accordingly
if (selectedCategory) {
    filterPets(selectedCategory);
}
