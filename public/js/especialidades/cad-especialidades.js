var especialidades = {
    init: function () {
        var $context = this;

        $('.save_continue').click(function(e) {
            e.preventDefault();

            if ($context.validateForm() === true) {
                $('form').submit();
            }
        });

        //Limit para o campo Conteúdo, se não passar nada o padrão e 200.
        $('.js-conteudo').limit();

        $('.js-cancelar').click(function(e) {
            e.preventDefault();
            window.location.href = '/especialidades';
        });
    },
    validateForm: function () {

        if($(".js-nome").val().length <= 0 ) {
            toastr.error("Preencha o campo Nome!");
            $(".js-nome").focus();
            return false;
        }

        if($(".js-conteudo").val().length <= 0 ) {
            toastr.error("Preencha o campo Conteudo!");
            $(".js-conteudo").focus();
            return false;
        }

        if(!$('input[name="id"]').val() && $(".js-image").val().length <= 0 ) {
            toastr.error("Preencha o campo Imagem");
            $(".js-image").focus();
            return false;
        }

        return true;
    }
};

$(document).ready(function () {
    especialidades.init();
});