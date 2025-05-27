document.addEventListener("DOMContentLoaded", function () {
    const modal = document.getElementById('imageModal');
    const modalImage = document.getElementById('modalImage');
    const modalCounter = document.getElementById('modalCounter');
    const modalPrev = document.getElementById('modalPrevButton');
    const modalNext = document.getElementById('modalNextButton');
    const modalClose = document.getElementById('modalCloseButton');

    let modalImages = [];
    let currentModalIndex = 0;

    const imageGroups = {};

    document.querySelectorAll('.slider__image, .post__image').forEach((img, index) => {
        const group = img.dataset.modalGroup || 'default';
        if (!imageGroups[group]) imageGroups[group] = [];
        imageGroups[group].push(img.src);
    });

    function openModal(group, index) {
        if (!imageGroups[group]) return;
        modalImages = imageGroups[group];
        currentModalIndex = index;
        modal.style.display = 'flex';
        updateModalImage();
        document.addEventListener("keydown", handleKeyDown);
    }

    function closeModal() {
        modal.style.display = 'none';
        document.removeEventListener("keydown", handleKeyDown);
    }

    function nextModalImage() {
        currentModalIndex = (currentModalIndex + 1) % modalImages.length;
        updateModalImage();
    }

    function prevModalImage() {
        currentModalIndex = (currentModalIndex - 1 + modalImages.length) % modalImages.length;
        updateModalImage();
    }

    function updateModalImage() {
        modalImage.src = modalImages[currentModalIndex];
        modalCounter.textContent = `${currentModalIndex + 1} из ${modalImages.length}`;
    }

    function handleKeyDown(event) {
        if (event.key === "Escape") {
            closeModal();
        }
    }

    document.querySelectorAll('.slider__image, .post__image').forEach(img => {
        img.addEventListener('click', function () {
            const group = this.dataset.modalGroup || 'default';
            const index = parseInt(this.dataset.index) || 0;
            openModal(group, index);
        });
    });

    modalPrev.addEventListener('click', prevModalImage);
    modalNext.addEventListener('click', nextModalImage);
    modalClose.addEventListener('click', closeModal);
});