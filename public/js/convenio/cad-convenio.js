var Convenio = {

    init: function () {
        var $context = this;
        $('.js-submit').click(function(e) {
            e.preventDefault();
            if ($context.validateForm() === true) {
                $('form').submit();
            }
        });

        $('.js-cancelar').click(function(e) {
            e.preventDefault();
            window.location.href = '/convenios';
        });
    },
    validateForm: function () {

        //Valida nome
        if($(".js-nome").val().length <= 0 ) {
            toastr.error("Preencha o campo Nome!");
            $(".js-nome").focus();
            return false;
        }

        //Valida status
        if($(".js-status").val() === '0' ) {
            toastr.error("Preencha o campo Status!");
            $(".js-status").focus();
            return false;
        }

        //Valida Imagem
        if(!$('input[name="id"]').val() && $(".js-image").val().length <= 0 ) {
            toastr.error("Preencha o campo Imagem");
            $(".js-image").focus();
            return false;
        }
        return true;
    }

};

$(document).ready(function () {
    Convenio.init();
});