document.addEventListener("DOMContentLoaded", function () {
    const posts = document.querySelectorAll(".post");

    posts.forEach(post => {
        const textElement = post.querySelector(".post__text");
        const button = post.querySelector(".post__toggle-button");

        if (!textElement || !button) {
            return;
        }

        const fullText = textElement.getAttribute("data-full").trim();
        const shortText = textElement.textContent.trim();

        function isClamped() {
            return textElement.scrollHeight > textElement.clientHeight;
        }
    
        if (isClamped()) {
            button.style.display = 'inline-block';
        } else {
            button.style.display = 'none';
        }

        button.addEventListener("click", function () {
            const isFull = textElement.classList.contains("full");

            if (isFull) {
                textElement.textContent = shortText;
                textElement.classList.remove("full");
                button.textContent = "ещё";
            } else {
                textElement.textContent = fullText;
                textElement.classList.add("full");
                button.textContent = "свернуть";
            }
        });
    });
});