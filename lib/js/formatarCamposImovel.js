document.addEventListener('DOMContentLoaded', function() {
    // Função para formatar valor como moeda (R$)
    function formatarValor(input) {
        let valor = input.value.replace(/\D/g, ''); // Remove tudo que não for número
        if (valor.length > 2) {
            valor = valor.replace(/(\d)(\d{2})$/, '$1,$2'); // Adiciona a vírgula antes dos dois últimos dígitos
            valor = valor.replace(/(\d)(\d{3}),/, '$1.$2,'); // Coloca o ponto a cada 3 números à esquerda da vírgula
            input.value = 'R$ ' + valor;
        } else {
            input.value = 'R$ ' + valor;
        }
    }

    // Função para formatar áreas com m²
    function formatarArea(input) {
        let area = input.value.replace(/\D/g, ''); // Remove tudo que não for número
        input.value = area ? area + ' m²' : ''; // Adiciona o "m²" ao final
    }

    // Função para garantir que valores como quartos, banheiros e garagem sempre mostrem "00"
    function formatarNumero(input) {
        let valor = input.value.replace(/\D/g, ''); // Remove tudo que não for número
        input.value = valor ? valor.padStart(2, '0') : '00'; // Preenche com "00" se vazio
    }

    // Formatação ao perder o foco do campo
    document.getElementById('valor').addEventListener('blur', function() {
        formatarValor(this);
    });

    document.getElementById('quartos').addEventListener('blur', function() {
        formatarNumero(this);
    });

    document.getElementById('banheiros').addEventListener('blur', function() {
        formatarNumero(this);
    });

    document.getElementById('garagem').addEventListener('blur', function() {
        formatarNumero(this);
    });

    document.getElementById('areatotal').addEventListener('blur', function() {
        formatarArea(this);
    });

    document.getElementById('areaconstruida').addEventListener('blur', function() {
        formatarArea(this);
    });

    // Formatação ao carregar a página para os valores já preenchidos (se houver)
    formatarValor(document.getElementById('valor'));
    formatarNumero(document.getElementById('quartos'));
    formatarNumero(document.getElementById('banheiros'));
    formatarNumero(document.getElementById('garagem'));
    formatarArea(document.getElementById('areatotal'));
    formatarArea(document.getElementById('areaconstruida'));
});
