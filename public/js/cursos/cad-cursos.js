var Cursos = {
    init: function () {
        var $context = this;
        $('.js-valor').maskMoney();
        var $acao = $('input[name="id"]').val();

        $('.js-submit').click(function(e) {
            e.preventDefault();
            if ($context.validateForm() === true) {
                $('form').submit();
            }
        });

        $('.js-cancelar').click(function(e) {
            e.preventDefault();
            window.location.href = '/cursos';
        });
    },
    validateForm: function () {

        //Valida Descrição
        var content = tinyMCE.activeEditor.getContent();
        if (content === "" || content === null) {
            toastr.error("Preencha o campo Descrição!");
            return false;
        }

        //Valida url video
        if($(".js-url-video").val().length <= 0 ) {
            toastr.error("Preencha o campo URL do vídeo!");
            $(".js-url-video").focus();
            return false;
        }

        //Valida nome
        if($(".js-nome").val().length <= 0 ) {
            toastr.error("Preencha o campo Nome!");
            $(".js-nome").focus();
            return false;
        }

        //Valida Tipo do curso
        if($(".js-tipo-curso").val() === '0' ) {
            toastr.error("Preencha o campo Tipo do Curso!");
            $(".js-tipo-curso").focus();
            return false;
        }

        //Valida Valor
        var money = $('.js-valor').val();
        if(money.length <= 0) {
            toastr.error("Preencha o campo Valor!");
            $('.js-valor').focus();
            return false;
        }

        //Valida status
        if($(".js-status").val() === '0' ) {
            toastr.error("Preencha o campo Status!");
            $(".js-status").focus();
            return false;
        }

        //Valida Imagem
        // console.log('sa', $('input[name="id"]').val());return false;
        if(!$('input[name="id"]').val() && $(".js-image").val().length <= 0 ) {
            toastr.error("Preencha o campo Imagem");
            $(".js-image").focus();
            return false;
        }

        //Valida Matérial do curso
        if(!$('input[name="id"]').val() && $(".js-file").val().length <= 0 ) {
            toastr.error("Preencha o campo Matérial do Curso");
            $(".js-file").focus();
            return false;
        }

        return true;
    }
};


$(document).ready(function () {
    Cursos.init();
});