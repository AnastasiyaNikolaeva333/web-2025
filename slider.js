document.addEventListener("DOMContentLoaded", function () {
    const sliders = document.querySelectorAll(".slider");

    sliders.forEach(slider => {
        const images = slider.querySelectorAll(".slider__image"); 
        const counter = slider.querySelector(".slider__counter");
        let currentIndex = 0;

        function showImage(index) {
            images.forEach(img => img.classList.remove("active"));
            images[index].classList.add("active");
            if (counter) {
                counter.textContent = `${index + 1}/${images.length}`;
            }
        }

        function nextImage() {
            currentIndex = (currentIndex + 1) % images.length;
            showImage(currentIndex);
        }

        function prevImage() {
            currentIndex = (currentIndex - 1 + images.length) % images.length;
            showImage(currentIndex);
        }

        const prevBtn = slider.querySelector(".slider__arrow_prev"); 
        const nextBtn = slider.querySelector(".slider__arrow_next"); 

        if (prevBtn && nextBtn) {
            prevBtn.addEventListener("click", prevImage);
            nextBtn.addEventListener("click", nextImage);
        }

        if (images.length > 0) {
            showImage(currentIndex);
        }
    });
});