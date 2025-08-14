document.addEventListener("DOMContentLoaded", function () {
    var textInputs = document.querySelectorAll("input[type='text']");
    var radioInputs = document.querySelectorAll("input[name='sexo']");
    var focusables = [];

    textInputs.forEach(function (el) {
        focusables.push(el);
    });

    radioInputs.forEach(function (el) {
        focusables.push(el);
    });

    focusables.forEach(function (el, index) {
        el.addEventListener("keydown", function (e) {
            if (e.key === "Enter") {
                e.preventDefault();
                var next = focusables[index + 1];
                if (next) {
                    next.focus();
                }
            }
        });
    });
});