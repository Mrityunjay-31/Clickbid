const slides = document.querySelectorAll('.carousel-slide');
const prevBtn = document.querySelector('.prev');
const nextBtn = document.querySelector('.next');
const playBtn = document.querySelector('.play');
let currentIndex = 0;
let intervalId;

function showSlide(index) {
    slides.forEach((slide, i) => {
        slide.classList.toggle('active', i === index);
    });
}

function nextSlide() {
    currentIndex = (currentIndex + 1) % slides.length;
    showSlide(currentIndex);
}

function prevSlide() {
    currentIndex = (currentIndex - 1 + slides.length) % slides.length;
    showSlide(currentIndex);
}

function playCarousel() {
    if (!intervalId) {
        intervalId = setInterval(nextSlide, 3000);
        playBtn.textContent = 'Pause';
    } else {
        clearInterval(intervalId);
        intervalId = null;
        playBtn.textContent = 'Play';
    }
}

nextBtn.addEventListener('click', nextSlide);
prevBtn.addEventListener('click', prevSlide);
playBtn.addEventListener('click', playCarousel);

// Initialize the first slide