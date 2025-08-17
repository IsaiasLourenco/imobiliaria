function mostrar(imagem)
{
    if (imagem.files && imagem.files[0])
    {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#foto')//id <img>
                    .attr('src', e.target.result)
                    .width(100)
        };
        reader.readAsDataURL(imagem.files[0]);
    }
}