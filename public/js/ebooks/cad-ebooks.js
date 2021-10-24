var Ebook = {
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
            window.location.href = '/list-ebooks';
        });
    },
    validateForm: function () {

        //Valida Descrição
        var content = tinyMCE.activeEditor.getContent();
        if (content === "" || content === null) {
            toastr.error("Preencha o campo Descrição!");
            return false;
        }

        //Valida nome
        if($(".js-titulo").val().length <= 0 ) {
            toastr.error("Preencha o campo Titulo!");
            $(".js-titulo").focus();
            return false;
        }

        //Valida url video
        if($(".js-url-video").val().length <= 0 ) {
            toastr.error("Preencha o campo URL do vídeo!");
            $(".js-url-video").focus();
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

        //Valida Imagem
        if(!$('input[name="id"]').val() && $(".js-file").val().length <= 0 ) {
            toastr.error("Preencha o campo Matérial do Curso");
            $(".js-file").focus();
            return false;
        }

        return true;
    }
};


$(document).ready(function () {
    Ebook.init();
});