document.addEventListener("DOMContentLoaded", () => {
    const inputs = document.querySelectorAll("form input.error-input");

    inputs.forEach((input) => {
        // Change the placeholder and clear the value if there's an error
        const originalPlaceholder = input.placeholder;
        input.placeholder = input.dataset.error;
        input.value = "";

        // Revert styles when user starts typing
        input.addEventListener("input", () => {
            input.placeholder = originalPlaceholder;
            input.classList.remove("error-input");
        });
    });
});

