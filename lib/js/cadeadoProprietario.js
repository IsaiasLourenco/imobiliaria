document.addEventListener('DOMContentLoaded', function() {
        $(function() {
            $('.ativo').click(function(e) {
                e.preventDefault();
                let ativo = $(this).data('status');
                let id = $(this).data('id');

                $.ajax({
                    type: "GET",
                    url:"index.php?controller=ProprietarioController&metodo=alterarCadeado&id=" + id + "&ativo=" + ativo,
                    success: function() {
                        location.reload();
                    }
                });
            });
        });
});