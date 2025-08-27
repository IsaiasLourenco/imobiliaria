document.addEventListener("DOMContentLoaded", function () {
    console.log("mensagem.js carregado");

    const iconMsg = document.querySelector(".icon-msg");
    const mensagens = document.querySelectorAll(".mod");
    let visivel = false;

    iconMsg.addEventListener("click", function () {
        visivel = !visivel;

        mensagens.forEach(function (msg) {
            msg.style.visibility = visivel ? "visible" : "hidden";
            msg.style.opacity = visivel ? "1" : "0";
            msg.style.position = visivel ? "relative" : "absolute";
        });

        // Atualiza o title dinamicamente
        iconMsg.title = visivel ? "Esconder Mensagens" : "Mostrar Mensagens";
    });
});