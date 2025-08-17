// ANIMAÇÃO DO CARROSSEL
document.addEventListener('DOMContentLoaded', function() {
    const carrossel = document.querySelector('.carrossel');
    const slides = document.querySelectorAll('.carrossel .slide');
    const prevButton = document.querySelector('.carrossel .prev');
    const nextButton = document.querySelector('.carrossel .next');
    const slidesContainer = document.querySelector('.slides');

    if (carrossel && slides.length > 0 && slidesContainer) {
        let currentIndex = 0;
        const totalSlides = slides.length;

        function showSlide(index) {
            if (index < 0) index = totalSlides - 1;
            if (index >= totalSlides) index = 0;

            // Protegendo o acesso ao slidesContainer
            if (slidesContainer) {
                slidesContainer.style.transform = `translateX(-${index * 100}%)`;
            }

            slides.forEach((slide, i) => {
                if (slide) {
                    slide.style.opacity = (i === index) ? '1' : '0';
                }
            });

            currentIndex = index;
        }

        setInterval(() => {
            showSlide(currentIndex + 1);
        }, 6000);

        if (prevButton) {
            prevButton.addEventListener('click', () => {
                showSlide(currentIndex - 1);
            });
        }

        if (nextButton) {
            nextButton.addEventListener('click', () => {
                showSlide(currentIndex + 1);
            });
        }

        showSlide(currentIndex);
    }
});

// ANIMANDO O SCROLL SUAVE
document.addEventListener('DOMContentLoaded', function() {
    const navLinks = document.querySelectorAll('nav a[href^="#"]');
    if (navLinks.length > 0) {
        navLinks.forEach(link => {
            link.addEventListener('click', function(event) {
                event.preventDefault();

                const targetId = this.getAttribute('href');
                const targetElement = document.querySelector(targetId);

                if (targetElement) {
                    window.scrollTo({
                        top: targetElement.offsetTop,
                        behavior: 'smooth'
                    });
                }
            });
        });
    }
});