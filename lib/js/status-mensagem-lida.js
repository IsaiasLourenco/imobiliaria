document.addEventListener("DOMContentLoaded", function () {

    const checkboxes = document.querySelectorAll(".check-lida");

    checkboxes.forEach(function (checkbox) {
        checkbox.addEventListener("change", function () {
            const id = this.dataset.id;
            const ativo = this.checked ? 0 : 1;

            fetch(`index.php?controller=PainelController&metodo=marcarComoLida&id=${id}&ativo=${ativo}`)
                .then(() => location.reload());
        });
    });
});