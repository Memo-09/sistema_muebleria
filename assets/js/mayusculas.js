document.addEventListener("DOMContentLoaded", function () {
    const inputs = document.querySelectorAll("input[type='text']");
    
    inputs.forEach(input => {
        input.addEventListener("input", function () {
            this.value = this.value.toUpperCase();
        });
    });
});