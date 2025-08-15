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

// CARREGAR IMAGEM

// function mostrar(imagem)
// {
//     if (imagem.files && imagem.files[0])
//     {
//         var reader = new FileReader();

//         reader.onload = function (e) {
//             $('#foto')//id <img>
//                     .attr('src', e.target.result)
//                     .width(170)
//         };
//         reader.readAsDataURL(imagem.files[0]);
//     }
// }
// CONSUMIR API CEP
// function getDadosEnderecoPorCEP(cep) {
//     let url = 'https://viacep.com.br/ws/' + cep + '/json/'

//     let xmlHttp = new XMLHttpRequest()
//     xmlHttp.open('GET', url)

//     xmlHttp.onreadystatechange = () => {
//         if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
//             let dadosJSONText = xmlHttp.responseText
//             let dadosJSONObj = JSON.parse(dadosJSONText)

//             document.getElementById('endereco').value = dadosJSONObj.logradouro
//             document.getElementById('bairro').value = dadosJSONObj.bairro
//             document.getElementById('cidade').value = dadosJSONObj.localidade
//             document.getElementById('uf').value = dadosJSONObj.uf
//         }
//     }

//     xmlHttp.send()
// }
// FORMATAR CAMPOS
// function formata_mascara(campo_passado, mascara) {
//     let campo = campo_passado.value.length;
//     let saida = mascara.substring(0, 1);
//     let texto = mascara.substring(campo);

//     if (texto.substring(0, 1) != saida) {
//         campo_passado.value += texto.substring(0, 1);
//     }
// }

// function exibirMensagem()
// {
//     let bloco = document.getElementById("blocoMensagens");
//     bloco.classList.toggle("mod-visivel");
// }